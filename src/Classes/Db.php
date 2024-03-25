<?php

require_once __DIR__ . "/../config.php";
class Db
{
    private $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME, DATABASE_USERNAME, DATABASE_PASSWORD);
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb(\PDO $db)
    {
        $this->db = $db;
    }
}
