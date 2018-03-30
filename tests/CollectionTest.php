<?php

namespace AdilAJJEMAMI\CouchbaseDriver\Tests;

use PHPUnit\Framework\TestCase;
use AdilAJJEMAMI\CouchbaseDriver\Collection;
use AdilAJJEMAMI\CouchbaseDriver\Bucket;
use AdilAJJEMAMI\CouchbaseDriver\Cluster;
use AdilAJJEMAMI\CouchbaseDriver\N1qlQuery;

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
     * @var Cluster
     */
    private $cluster;

    /**
     * @var CouchbaseBucketMock
     */
    private $couchbaseBucketMock;

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
        $this->bucket = $this->createMock(Bucket::class);
        $this->cluster = $this->createMock(Cluster::class);
        $this->n1qlQuery = $this->createMock(N1qlQuery::class);
        $this->couchbaseBucketMock = new CouchbaseBucketMock();

        $fakeQuery = new \Stdclass();
        $fakeQuery->options = [];

        $this->n1qlQuery
            ->expects($this->any())
            ->method('fromString')
            ->willReturn($fakeQuery);

        $this->cluster
            ->expects($this->any())
            ->method('getN1qlQuery')
            ->willReturn($this->n1qlQuery);

        $this->bucket
            ->expects($this->any())
            ->method('getCluster')
            ->willReturn($this->cluster);
        $this->bucket
            ->expects($this->any())
            ->method('getName')
            ->willReturn('myTestBucket');
        $this->bucket
            ->expects($this->any())
            ->method('getCouchbaseBucket')
            ->willReturn($this->couchbaseBucketMock);

        $this->collection = new Collection('myTestCollection', $this->bucket);
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

    /**
     * Test setters method.
     *
     * @return void
     */
    public function testSetters()
    {
        $this->collection->generateAttributesString();

        $this->assertInstanceOf(
            Collection::class,
            $this->collection
                ->select(['item'])
                ->where('item', '=', '$itemValue')
                ->orWhere('item', '=', '$itemValue2')
                ->orderBy('item', 'DESC')
                ->limit(1)
                ->offset(1)
                ->params(
                    [
                        '$itemValue' => 'itemValue',
                    ]
                )
                ->withParam('$itemValue2', 'itemValue2')
                ->options(
                    [
                        'expiry' => 5,
                    ]
                )
                ->raw('select * from bucket as data where meta().id like \'collection:%\'')
        );

        $this->collection->generateAttributesString();
        $this->collection->generateConditionsString();
        $this->collection->generateOrderBy();
        $this->collection->generateLimitString();
    }

    /**
     * Test get data method.
     *
     * @return void
     */
    public function testGetData()
    {
        $array1 = ['data' => 'myData'];
        $array2 = ['myData'];

        $this->assertSame('myData', $this->collection->getData($array1));
        $this->assertSame('myData', $this->collection->getData($array2)[0]);
    }

    /**
     * Test uuid method.
     *
     * @return void
     */
    public function testUuid()
    {
        $this->collection->uuid();

        $this->assertTrue(true);
    }

    /**
     * Test find method.
     *
     * @return void
     */
    public function testFind()
    {
        $this->assertSame([], $this->collection->find('fakeId'));
    }

    /**
     * Test all method.
     *
     * @return void
     */
    public function testAll()
    {
        $this->collection->all();
        $this->assertTrue(true);
    }

    /**
     * Test get method.
     *
     * @return void
     */
    public function testGet()
    {
        $this->collection->where('item', '=', 1)->get();
        $this->assertTrue(true);
    }

    /**
     * Test first method.
     *
     * @return void
     */
    public function testFirst()
    {
        $this->collection->where('item', '=', 1)->first();
        $this->assertTrue(true);
    }

    /**
     * Test count method.
     *
     * @return void
     */
    public function testCount()
    {
        $this->collection->count();
        $this->assertTrue(true);
    }

    /**
     * Test delete method.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->collection->delete('fakeId', []);
        $this->collection->delete(null, []);
        $this->assertTrue(true);
    }

    /**
     * Test insert method.
     *
     * @return void
     */
    public function testInsert()
    {
        $this->collection->insert([], []);
        $this->assertTrue(true);
    }

    /**
     * Test upsert method.
     *
     * @return void
     */
    public function testUpsert()
    {
        $this->collection->upsert('fakeId', [], []);
        $this->assertTrue(true);
    }

    /**
     * Test replace method.
     *
     * @return void
     */
    public function testReplace()
    {
        $this->collection->replace('fakeId', []);
        $this->assertTrue(true);
    }

    /**
     * Test health check method.
     *
     * @return void
     */
    public function testHealthCheck()
    {
        $this->collection->healthCheck();
        $this->assertTrue(true);
    }
}
