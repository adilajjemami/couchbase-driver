<?php

namespace CommonsPhp\CouchbaseDriver;

/**
 * QueryBuilderTrait trait.
 */
trait QueryBuilderTrait
{
    /**
     * @var array
     */
    private $select = ['*'];

    /**
     * @var array
     */
    private $conditions = [];

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
     * Limit method.
     *
     * @param integer $limit
     *
     * @return mixed
     */
    public function limit(int $limit)
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
    public function offset(int $offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Select method.
     *
     * @param array $attr
     *
     * @return mixed
     */
    public function select(array $attr)
    {
        $this->select = $attr;

        return $this;
    }

    /**
     * Where condition method.
     *
     * @param string $attr
     * @param string $operator
     * @param mixed  $value
     *
     * @return mixed
     */
    public function where(string $attr, string $operator, $value)
    {
        return $this;
    }

    /**
     * Find method.
     *
     * @param string $id
     * @param array  $options
     *
     * @return array
     */
    public function find(string $id, array $options = [])
    {
        return [];
    }

    /**
     * All method.
     *
     * @return array
     */
    public function all()
    {
        return [];
    }

    /**
     * First method.
     *
     * @return array
     */
    public function first()
    {
        return [];
    }

    /**
     * Get method.
     *
     * @return array
     */
    public function get()
    {
        return [];
    }

    /**
     * Remove method.
     *
     * @param string $id
     * @param array  $options
     *
     * @return array
     */
    public function remove(string $id, array $options = [])
    {
        return [];
    }

    /**
     * Insert method.
     *
     * @param string $id
     * @param array  $value
     * @param array  $options
     *
     * @return array
     */
    public function insert(string $id, array $value, array $options = [])
    {
        return [];
    }

    /**
     * Upsert method.
     *
     * @param string $id
     * @param array  $value
     * @param array  $options
     *
     * @return array
     */
    public function upsert(string $id, array $value, array $options = [])
    {
        return [];
    }

    /**
     * Replace method.
     *
     * @param string $id
     * @param array  $value
     * @param array  $options
     *
     * @return array
     */
    public function replace(string $id, array $value, array $options = [])
    {
        return [];
    }
}
