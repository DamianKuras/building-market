<?php

namespace app\base\db;

use PDOException;

class Database
{
    public \PDO $pdo;
    public function __construct()
    {
        $db = parse_url(getenv("DATABASE_URL"));
        
        $this->pdo = new \PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));


        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}
