<?php

namespace Eshop\Repository;

class DBA
{
    private ?\PDO $PDOInstance = null;

    const DEFAULT_SQL_USER = ENV['database']['user'];
    const DEFAULT_SQL_HOST = ENV['database']['host'];
    const DEFAULT_SQL_PASS = ENV['database']['password'];
    const DEFAULT_SQL_DTB = ENV['database']['dbName'];

    public function __construct()
    {
        if (!$this->PDOInstance) {
            $this->PDOInstance = new \PDO(
                'mysql:dbname=' . self::DEFAULT_SQL_DTB . ';host=' . self::DEFAULT_SQL_HOST,
                self::DEFAULT_SQL_USER,
                self::DEFAULT_SQL_PASS
            );
        }
    }

    public function getPDO(): ?\PDO
    {
        return $this->PDOInstance;
    }
}
