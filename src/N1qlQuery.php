<?php

namespace AdilAJJEMAMI\CouchbaseDriver;

/**
 * N1qlQuery class.
 */
class N1qlQuery
{
    /**
     * Create query from string
     *
     * @param string $query
     *
     * @return \Couchbase\N1qlQuery
     */
    public function fromString(string $query)
    {
        return \CouchbaseN1qlQuery::fromString($query);
    }
}
