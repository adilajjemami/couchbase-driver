<?php

namespace CommonsPhp\CouchbaseDriver\Tests;

use PHPUnit\Framework\TestCase;
use CommonsPhp\CouchbaseDriver\Bucket;
use CommonsPhp\CouchbaseDriver\Collection;
use CommonsPhp\CouchbaseDriver\Cluster;

/**
 * BucketTest class.
 */
class BucketTest extends TestCase
{
    /**
     * @var Bucket
     */
    private $bucket;

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
        $this->bucket = new Bucket('myBucket', $this->cluster);
    }

    /**
     * Test construct method.
     *
     * @return void
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(Bucket::class, $this->bucket);
    }

    /**
     * Test open method.
     *
     * @return void
     */
    public function testOpen()
    {
        $this->cluster
            ->expects($this->once())
            ->method('open')
            ->willReturn(null);

        $this->bucket->open();

        $this->assertSame(null, $this->bucket->getCouchbaseBucket());
    }

    /**
     * Test getters and setters method.
     *
     * @return void
     */
    public function testGettersAndSetters()
    {
        $collections = ['collection1' => new Collection('collection1', $this->bucket)];
        $this->bucket->setCouchbaseBucket(null);
        $this->bucket->setName('bucket');
        $this->bucket->setCollections($collections);
        $this->assertSame(null, $this->bucket->getCouchbaseBucket());
        $this->assertSame('bucket', $this->bucket->getName());
        $this->assertSame($collections, $this->bucket->getCollections());
        $this->assertInstanceOf(Collection::class, $this->bucket->collection('collection1'));
        $this->assertSame($collections['collection1'], $this->bucket->collection('collection1'));
    }
}
