<?php

namespace AdilAJJEMAMI\CouchbaseDriver;

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
     * @var N1qlQuery;
     */
    protected $n1qlQuery;

    /**
     * @var array
     */
    public $buckets = [];

    /**
     * Init cluster mthod.
     *
     * @param string    $url
     * @param N1qlQuery $n1qlQuery
     *
     * @return Cluster
     */
    public function init(string $url, N1qlQuery $n1qlQuery)
    {
        $this->couchbaseCluster = new \Couchbase\Cluster($url);
        $this->n1qlQuery = $n1qlQuery;

        return $this;
    }

    /**
     * Open bucket method.
     *
     * @param string $bucketName
     *
     * @return \Couchbase\Bucket
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
     * Get n1qlQuery method.
     *
     * @return N1qlQuery
     */
    public function getN1qlQuery()
    {
        return $this->n1qlQuery;
    }

    /**
     * Set n1qlQuery method.
     *
     * @param N1qlQuery $n1qlQuery
     *
     * @return Cluster
     */
    public function setN1qlQuery(N1qlQuery $n1qlQuery)
    {
        $this->n1qlQuery = $n1qlQuery;

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
