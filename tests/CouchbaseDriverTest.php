<?php

namespace CommonsPhp\CouchbaseDriver\Tests;

use PHPUnit\Framework\TestCase;
use CommonsPhp\CouchbaseDriver\CouchbaseDriver;
use CommonsPhp\CouchbaseDriver\Cluster;

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
     * Set up method.
     *
     * @return void
     */
    public function setUp()
    {
        $this->cluster = $this->createMock(Cluster::class);
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

        CouchbaseDriver::setCluster($this->cluster->init('url'));
        $this->assertSame($this->cluster, CouchbaseDriver::getCluster());
    }
}
