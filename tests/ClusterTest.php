<?php

namespace AdilAJJEMAMI\CouchbaseDriver\Tests;

use PHPUnit\Framework\TestCase;
use AdilAJJEMAMI\CouchbaseDriver\Cluster;
use AdilAJJEMAMI\CouchbaseDriver\N1qlQuery;
use AdilAJJEMAMI\CouchbaseDriver\Bucket;

/**
 * ClusterTest class.
 */
class ClusterTest extends TestCase
{
    /**
     * @var Cluster
     */
    private $cluster;

    /**
     * @var N1qlQuery
     */
    private $n1qlQuery;

    /**
     * Set up method.
     *
     * @return void
     */
    public function setUp()
    {
        $this->cluster = new Cluster();
        $this->n1qlQuery = new N1qlQuery();
    }

    /**
     * Test construct method.
     *
     * @return void
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(Cluster::class, $this->cluster);
    }

    /**
     * Test getters and setters method.
     *
     * @return void
     */
    public function testGettersAndSetters()
    {
        $buckets = ['bucket1' => new Bucket('bucket1', $this->cluster)];
        $this->cluster->setCouchbaseCluster(null);
        $this->cluster->setN1qlQuery($this->n1qlQuery);
        $this->cluster->setBuckets($buckets);
        $this->assertSame($this->n1qlQuery, $this->cluster->getN1qlQuery());
        $this->assertSame(null, $this->cluster->getCouchbaseCluster());
        $this->assertSame($buckets, $this->cluster->getBuckets());
        $this->assertInstanceOf(Bucket::class, $this->cluster->bucket('bucket1'));
        $this->assertSame($buckets['bucket1'], $this->cluster->bucket('bucket1'));
    }
}
