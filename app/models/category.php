<?php
namespace personalWallet\app\models;

use personalWallet\app\core\Database;
use PDO;

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM category ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(string $name): bool
    {
        $stmt = $this->db->prepare("INSERT INTO category (name) VALUES (:name)");
        return $stmt->execute([':name' => $name]);
    }

}
