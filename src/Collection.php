<?php

namespace CommonsPhp\CouchbaseDriver;

/**
 * Collection class.
 */
class Collection
{
    use QueryBuilderTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Bucket
     */
    private $bucket;

    /**
     * Construct method.
     *
     * @param string $name
     * @param Bucket $bucket
     */
    public function __construct(string $name, Bucket $bucket)
    {
        $this->name = $name;
        $this->bucket = $bucket;
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
     * @return Collection
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get bucket method.
     *
     * @return Bucket
     */
    public function getBucket()
    {
        return $this->bucket;
    }

    /**
     * Set bucket method.
     *
     * @param Bucket $bucket
     *
     * @return Collection
     */
    public function setBucket(Bucket $bucket)
    {
        $this->bucket = $bucket;

        return $this;
    }
}
