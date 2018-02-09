<?php

namespace Prooofzizoo\CouchbaseDriver\Tests;

use PHPUnit\Framework\TestCase;
use Prooofzizoo\CouchbaseDriver\Cluster;
use Prooofzizoo\CouchbaseDriver\Bucket;

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
     * Set up method.
     *
     * @return void
     */
    public function setUp()
    {
        $this->cluster = new Cluster();
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
        $this->cluster->setBuckets($buckets);
        $this->assertSame(null, $this->cluster->getCouchbaseCluster());
        $this->assertSame($buckets, $this->cluster->getBuckets());
        $this->assertInstanceOf(Bucket::class, $this->cluster->bucket('bucket1'));
        $this->assertSame($buckets['bucket1'], $this->cluster->bucket('bucket1'));
    }
}
