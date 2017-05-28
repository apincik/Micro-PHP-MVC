<?php

namespace Darkside\Database;


class Connection
{
    private $connection;

    private $config;


    public function __construct($dsn, $user, $password, $host, $driver)
    {
        $this->config = new \Doctrine\DBAL\Configuration();
        $connectionParams = array(
            "dbname" => $dsn,
            "user" => $user,
            "password" => $password,
            "host" => $host,
            "driver" => $driver,
        );

        $this->connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $this->config);
    }


    public function getConnection()
    {
        return $this->connection;
    }


    public function connect()
    {
        $this->connection->connect();
    }


}
