<?php

namespace CommonsPhp\CouchbaseDriver;

/**
 * CouchbaseDriver class.
 */
class CouchbaseDriver
{
    /**
     * @var Cluster
     */
    private static $cluster;

    /**
     * Init method.
     *
     * @param Cluster $cluster
     *
     * @return void
     */
    public static function init(Cluster $cluster)
    {
        self::$cluster = $cluster;
    }

    /**
     * Get cluster method.
     *
     * @return Cluster
     */
    public static function getCluster()
    {
        return self::$cluster;
    }

    /**
     * Set cluster method.
     *
     * @param Cluster $cluster
     *
     * @return void
     */
    public static function setCluster(Cluster $cluster)
    {
        self::$cluster = $cluster;
    }
}
