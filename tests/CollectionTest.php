<?php

namespace Prooofzizoo\CouchbaseDriver\Tests;

use PHPUnit\Framework\TestCase;
use Prooofzizoo\CouchbaseDriver\Collection;
use Prooofzizoo\CouchbaseDriver\Bucket;

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

    /**
     * Test select method.
     *
     * @return void
     */
    public function testSelection()
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
}
