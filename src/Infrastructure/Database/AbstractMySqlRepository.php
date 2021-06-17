<?php

namespace IESLaCierva\Infrastructure\Database;

class AbstractMySqlRepository
{
    protected \PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::create();
    }
}
