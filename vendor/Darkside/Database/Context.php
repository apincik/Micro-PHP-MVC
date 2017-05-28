<?php

namespace Darkside\Database;


class Context
{
    /**
     * @var Connection
     */
    private $connection;


    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->connection->connect();
    }


    public function getConnection()
    {
        return $this->connection;
    }


}
