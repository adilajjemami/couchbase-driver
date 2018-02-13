<?php

namespace Prooofzizoo\CouchbaseDriver\Tests;

/**
 * CouchbaseBucketMock class.
 */
class CouchbaseBucketMock
{
    /**
     * Get mocked method.
     *
     * @param string $identifier
     *
     * @return \Stdclass
     */
    public function get(string $identifier)
    {
        $data = new \Stdclass();
        $data->value = [];

        return $data;
    }

    /**
     * Remove mocked method.
     *
     * @param string $identifier
     * @param array  $options
     *
     * @return array
     */
    public function remove(string $identifier, array $options = [])
    {
        return [$identifier, $options];
    }

    /**
     * Insert mocked method.
     *
     * @param string $identifier
     * @param array  $value
     * @param array  $options
     *
     * @return array
     */
    public function insert(string $identifier, array $value, array $options = [])
    {
        return [$identifier, $value, $options];
    }

    /**
     * Upsert mocked method.
     *
     * @param string $identifier
     * @param array  $value
     * @param array  $options
     *
     * @return array
     */
    public function upsert(string $identifier, array $value, array $options = [])
    {
        return [$identifier, $value, $options];
    }

    /**
     * Replace mocked method.
     *
     * @param string $identifier
     * @param array  $value
     *
     * @return array
     */
    public function replace(string $identifier, array $value)
    {
        return [$identifier, $value];
    }

    /**
     * Query mocked method.
     *
     * @param mixed $couchbaseQuery
     * @param mixed $boolean
     *
     * @return \Stdclass
     */
    public function query($couchbaseQuery, $boolean)
    {
        $result = new \Stdclass();
        $result->rows = ['data' => ['nbRows' => 0]];

        return $result;
    }
}
