<?php

namespace Prooofzizoo\CouchbaseDriver;

/**
 * QueryBuilderTrait trait.
 */
trait QueryBuilderTrait
{
    /**
     * @var string
     */
    private $queryString;

    /**
     * @var \Couchbase\Query
     */
    private $query;

    /**
     * @var array
     */
    private $select = [];

    /**
     * @var array
     */
    private $wheres = [];

    /**
     * @var array
     */
    private $Orwheres = [];

    /**
     * @var array
     */
    private $orderBy = ['meta().id', 'DESC'];

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var integer
     */
    private $limit = -1;

    /**
     * @var integer
     */
    private $offset = 0;

    /**
     * @var array
     */
    private $options = [];

    /**
     * Select method.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function select(array $attributes)
    {
        $this->select = $attributes;

        return $this;
    }

    /**
     * Where condition method.
     *
     * @param string $attribut
     * @param string $operator
     * @param mixed  $value
     *
     * @return mixed
     */
    public function where(string $attribut, string $operator, $value)
    {
        $this->wheres[] = [
            $attribut,
            $operator,
            $value,
        ];

        return $this;
    }

    /**
     * Or where condition method.
     *
     * @param string $attribut
     * @param string $operator
     * @param mixed  $value
     *
     * @return mixed
     */
    public function orWhere(string $attribut, string $operator, $value)
    {
        $this->orWheres[] = [
            $attribut,
            $operator,
            $value,
        ];

        return $this;
    }

    /**
     * Order by method.
     *
     * @param string $attribut
     * @param string $order
     *
     * @return mixed
     */
    public function orderBy(string $attribut, string $order = 'ASC')
    {
        $this->orderBy = [$attribut, strtoupper($order)];

        return $this;
    }

    /**
     * Limit method.
     *
     * @param integer $limit
     *
     * @return mixed
     */
    public function limit(int $limit = -1)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Offset method.
     *
     * @param integer $offset
     *
     * @return mixed
     */
    public function offset(int $offset = 0)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * With param method.
     *
     * @param string $paramName
     * @param mixed  $paramValue
     *
     * @return mixed
     */
    public function withParam(string $paramName, $paramValue)
    {
        $this->params[$paramName] = $paramValue;

        return $this;
    }

    /**
     * Params method.
     *
     * @param array $params
     *
     * @return mixed
     */
    public function params(array $params = [])
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Options method.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function options(array $options = [])
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Raw query string method.
     *
     * @param string $queryString
     *
     * @return mixed
     */
    public function raw(string $queryString)
    {
        $this->queryString = $queryString;

        return $this;
    }

    /**
     * Find method.
     *
     * @param string $identifier
     *
     * @return array
     *
     * @throws \Exception|\CouchbaseException
     */
    public function find(string $identifier)
    {
        return $this->bucket
            ->getCouchbaseBucket()
            ->get(
                $this->name.self::KEY_SEP.$identifier
            )->value;
    }

    /**
     * All method.
     *
     * @return array
     *
     * @throws \Exception|\CouchbaseException
     */
    public function all()
    {
        $this->queryString = 'SELECT';
        $this->generateAttributesString();
        $this->queryString .= ' FROM '.$this->bucket->getName().' AS data';
        $this->queryString .= ' WHERE meta().id LIKE \''.$this->name.self::KEY_SEP.'%\'';
        $this->generateOrderBy();
        $this->generateLimitString();

        return array_map(
            [$this, 'getData'],
            $this->executeQuery()
        );
    }

    /**
     * First method.
     *
     * @return array
     *
     * @throws \Exception|\CouchbaseException
     */
    public function first()
    {
        $this->limit = 1;
        $this->queryString = 'SELECT';
        $this->generateAttributesString();
        $this->queryString .= ' FROM '.$this->bucket->getName().' AS data';
        $this->queryString .= ' WHERE meta().id LIKE \''.$this->name.self::KEY_SEP.'%\'';
        $this->generateConditionsString();
        $this->generateOrderBy();
        $this->generateLimitString();

        return array_map(
            [$this, 'getData'],
            $this->executeQuery()
        );
    }

    /**
     * Get method.
     *
     * @return array
     *
     * @throws \Exception|\CouchbaseException
     */
    public function get()
    {
        $this->queryString = 'SELECT';
        $this->generateAttributesString();
        $this->queryString .= ' FROM '.$this->bucket->getName().' AS data';
        $this->queryString .= ' WHERE meta().id LIKE \''.$this->name.self::KEY_SEP.'%\'';
        $this->generateConditionsString();
        $this->generateOrderBy();
        $this->generateLimitString();

        return array_map(
            [$this, 'getData'],
            $this->executeQuery()
        );
    }

    /**
     * Count documents method.
     *
     * @return integer
     *
     * @throws \Exception|\CouchbaseException
     */
    public function count()
    {
        $this->queryString = 'SELECT COUNT(*) AS nbRows FROM '.$this->bucket->getName();
        $this->queryString .= ' WHERE meta().id LIKE \''.$this->name.self::KEY_SEP.'%\'';
        $this->generateConditionsString();
        $this->generateLimitString();

        return $this->executeQuery()[0]['nbRows'];
    }

    /**
     * Delete method.
     *
     * @param string $identifier
     * @param array  $options
     *
     * @return array
     *
     * @throws \Exception|\CouchbaseException
     */
    public function delete(string $identifier = null, array $options = [])
    {
        if (null !== $identifier) {
            return $this->bucket
                ->getCouchbaseBucket()
                ->remove(
                    $this->name.self::KEY_SEP.$identifier,
                    $options
                );
        } else {
            $this->queryString = 'DELETE FROM '.$this->bucket->getName().' AS data';
            $this->queryString .= ' WHERE meta().id LIKE \''.$this->name.self::KEY_SEP.'%\'';
            $this->generateConditionsString();

            return $this->executeQuery();
        }
    }

    /**
     * Insert method.
     *
     * @param array $value
     * @param array $options
     *
     * @return array@throws \CouchbaseException
     *
     * @throws \Exception|\CouchbaseException
     */
    public function insert(array $value, array $options = [])
    {
        if (false === array_key_exists('id', $value)) {
            $value['id'] = $this->uuid();
        }

        $this->bucket->getCouchbaseBucket()->insert(
            $this->name.self::KEY_SEP.$value['id'],
            $value,
            $options
        );

        return $value;
    }

    /**
     * Upsert method.
     *
     * @param string $identifier
     * @param array  $value
     * @param array  $options
     *
     * @return array
     *
     * @throws \Exception|\CouchbaseException
     */
    public function upsert(string $identifier, array $value, array $options = [])
    {
        $this->bucket->getCouchbaseBucket()->upsert(
            $this->name.self::KEY_SEP.$identifier,
            $value,
            $options
        );

        return $value;
    }

    /**
     * Replace method.
     *
     * @param string $identifier
     * @param array  $value
     *
     * @return array
     *
     * @throws \Exception|\CouchbaseException
     */
    public function replace(string $identifier, array $value)
    {
        $this->bucket->getCouchbaseBucket()->replace(
            $this->name.self::KEY_SEP.$identifier,
            $value
        );

        return $value;
    }

    /**
     * Check couchbase health.
     *
     * @return mixed
     *
     * @throws \Exception|\CouchbaseException
     */
    public function healthCheck()
    {
        $this->checkBucket();

        $queryString = 'SELECT 1';
        $query = $this->bucket
            ->getCluster()
            ->getN1qlQuery()
            ->fromString($queryString);

        return $this->bucket->getCouchbaseBucket()->query($query, true);
    }

    /**
     * Generates and adds attributes to query string method..
     *
     * @return void
     */
    public function generateAttributesString()
    {
        if (0 < count($this->select)) {
            $this->queryString .= ' '.implode(', ', $this->select).' ';
        } else {
            $this->queryString .= ' * ';
        }
    }

    /**
     * Generates and adds conditions to query string method.
     *
     * @return void
     */
    public function generateConditionsString()
    {
        foreach ($this->wheres as $condition) {
            $this->queryString .= ' AND '.$condition[0].' '.$condition[1].' '.$condition[2];
        }

        foreach ($this->orWheres as $condition) {
            $this->queryString .= ' OR '.$condition[0].' '.$condition[1].' '.$condition[2];
        }
    }

    /**
     * Generates and adds order by to query string method..
     *
     * @return void
     */
    public function generateOrderBy()
    {
        $this->queryString .= ' ORDER BY '.$this->orderBy[0].' '.$this->orderBy[1];
    }

    /**
     * Generates and adds limit / offset to query string method.
     *
     * @return void
     */
    public function generateLimitString()
    {
        if (-1 < $this->limit) {
            $this->queryString .= ' LIMIT $limit';
            $this->params['$limit'] = (int) $this->limit;

            if (0 < $this->offset) {
                $this->queryString .= ' OFFSET $offset';
                $this->params['$offset'] = (int) $this->offset;
            }
        }
    }

    /**
     * Get data from query result method.
     *
     * @param array $result Result
     *
     * @return array
     */
    public function getData(array $result)
    {
        if (array_key_exists('data', $result)) {
            return $result['data'];
        } else {
            return $result;
        }
    }

    /**
     * Execute query.
     *
     * @return mixed
     *
     * @throws \Exception|\CouchbaseException
     */
    public function executeQuery()
    {
        $this->checkBucket();
        $this->query = $this->data['n1qlQuery']->fromString($this->data['queryString']);
        $this->query->options = array_merge($this->query->options, $this->params);
        $result = $this->bucket->getCouchbaseBucket()->query($this->query, true);

        return $result->rows;
    }

    /**
     * Generate unique v4 UUID method.
     *
     * @return string
     */
    public function uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0C2f) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0x2Aff),
            mt_rand(0, 0xffD3),
            mt_rand(0, 0xff4B)
        );
    }
}
