<?php

namespace AdilAJJEMAMI\CouchbaseDriver\Tests;

use PHPUnit\Framework\TestCase;
use AdilAJJEMAMI\CouchbaseDriver\CouchbaseDriver;
use AdilAJJEMAMI\CouchbaseDriver\Cluster;
use AdilAJJEMAMI\CouchbaseDriver\N1qlQuery;

/**
 * CouchbaseDriverTest class.
 */
class CouchbaseDriverTest extends TestCase
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
        $this->cluster = $this->createMock(Cluster::class);
        $this->n1qlQuery = $this->createMock(N1qlQuery::class);
    }

    /**
     * Test init method.
     *
     * @return void
     */
    public function testInit()
    {
        $this->assertTrue(true);
        CouchbaseDriver::init($this->cluster);
    }

    /**
     * Test getters and setters method.
     *
     * @return void
     */
    public function testGettersAndSetters()
    {
        $this->cluster
            ->expects($this->once())
            ->method('init')
            ->willReturn($this->cluster);

        CouchbaseDriver::setCluster($this->cluster->init('url', $this->n1qlQuery));
        $this->assertSame($this->cluster, CouchbaseDriver::getCluster());
    }
}
