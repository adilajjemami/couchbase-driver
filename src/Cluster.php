<?php

namespace Prooofzizoo\CouchbaseDriver;

/**
 * Cluster class.
 */
class Cluster
{
    /**
     * @var \Couchbase\Cluster
     */
    private $couchbaseCluster;

    /**
     * @var array
     */
    public $buckets = [];

    /**
     * Init cluster mthod.
     *
     * @param string $url
     *
     * @return Cluster
     *
     * @codeCoverageIgnore
     */
    public function init(string $url)
    {
        $this->$couchbaseCluster = new \Couchbase\Cluster($url);

        return $this;
    }

    /**
     * Open bucket method.
     *
     * @param string $bucketName
     *
     * @return \Couchbase\Bucket
     *
     * @codeCoverageIgnore
     */
    public function open(string $bucketName)
    {
        return  $this->couchbaseCluster->open($bucketName);
    }

    /**
     * Get bucket method.
     *
     * @param string $name
     *
     * @return Bucket
     */
    public function bucket(string $name)
    {
        return $this->buckets[$name];
    }

    /**
     * Get buckets method.
     *
     * @return array
     */
    public function getBuckets()
    {
        return $this->buckets;
    }

    /**
     * Set buckets method.
     *
     * @param array $buckets
     *
     * @return Cluster
     */
    public function setBuckets(array $buckets)
    {
        $this->buckets = $buckets;

        return $this;
    }

    /**
     * Get couchbase cluster method.
     *
     * @return \Couchbase\Cluster
     */
    public function getCouchbaseCluster()
    {
        return $this->couchbaseCluster;
    }

    /**
     * Set couchbase cluster method.
     *
     * @param \Couchbase\Cluster $couchbaseCluster
     *
     * @return Cluster
     */
    public function setCouchbaseCluster($couchbaseCluster)
    {
        $this->couchbaseCluster = $couchbaseCluster;

        return $this;
    }
}
