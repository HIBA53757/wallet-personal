<?php
namespace personalWallet\app\core;

use PDO;

class Database
{
    private static $instance = null;
    private $db;

    private function __construct()
    {
        $this->db = new PDO(
            "mysql:host=localhost;dbname=wallet;charset=utf8",
            "root",
            "",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->db;
    }
}
