<?php

namespace AdilAJJEMAMI\CouchbaseDriver;

/**
 * Bucket class.
 */
class Bucket
{
    /**
     * @var \Couchbase\Bucket
     */
    private $couchbaseBucket;

    /**
     * @var array
     */
    private $collections = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @var Cluster
     */
    private $cluster;

    /**
     * Construct method.
     *
     * @param string  $name
     * @param Cluster $cluster
     */
    public function __construct(string $name, Cluster $cluster)
    {
        $this->name = $name;
        $this->cluster = $cluster;
    }

    /**
     * Open method.
     *
     * @return Bucket
     */
    public function open()
    {
        $this->couchbaseBucket = $this->cluster->open($this->name);

        return $this;
    }

    /**
     * Get collection method.
     *
     * @param string $name
     *
     * @return Collection
     */
    public function collection(string $name)
    {
        return $this->collections[$name];
    }

    /**
     * Get colelctions method.
     *
     * @return array
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * Set collection method.
     *
     * @param array $collections
     *
     * @return Bucket
     */
    public function setCollections(array $collections)
    {
        $this->collections = $collections;

        return $this;
    }

    /**
     * Get name method.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name method.
     *
     * @param string $name
     *
     * @return Bucket
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get cluster method.
     *
     * @return string
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    /**
     * Set cluster method.
     *
     * @param Cluster $cluster
     *
     * @return Bucket
     */
    public function setCluster(Cluster $cluster)
    {
        $this->cluster = $cluster;

        return $this;
    }

    /**
     * Get couchbase bucket method.
     *
     * @return \Couchbase\Bucket
     */
    public function getCouchbaseBucket()
    {
        return $this->couchbaseBucket;
    }

    /**
     * Set couchbase bucket method.
     *
     * @param \Couchbase\Bucket $couchbaseBucket
     *
     * @return Bucket
     */
    public function setCouchbaseBucket($couchbaseBucket)
    {
        $this->couchbaseBucket = $couchbaseBucket;

        return $this;
    }
}
