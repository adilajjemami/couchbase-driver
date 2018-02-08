<?php

namespace CommonsPhp\CouchbaseDriver\Tests;

use PHPUnit\Framework\TestCase;
use CommonsPhp\CouchbaseDriver\Collection;
use CommonsPhp\CouchbaseDriver\Bucket;

/**
 * CollectionTest class.
 */
class CollectionTest extends TestCase
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * @var Bucket
     */
    private $bucket;

    /**
     * Set up method.
     *
     * @return void
     */
    public function setUp()
    {
        $this->bucket = $this->createMock(Bucket::class);
        $this->collection = new Collection('myCollection', $this->bucket);
    }

    /**
     * Test construct method.
     *
     * @return void
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(Collection::class, $this->collection);
    }

    /**
     * Test getters and setters method.
     *
     * @return void
     */
    public function testGettersAndSetters()
    {
        $this->collection->setName('collection');
        $this->collection->setBucket($this->bucket);
        $this->assertSame('collection', $this->collection->getName());
        $this->assertSame($this->bucket, $this->collection->getBucket());
    }
}
