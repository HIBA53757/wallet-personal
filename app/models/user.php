<?php

namespace personalWallet\app\models;

use personalWallet\app\core\Database;
use PDO;

class user
{
    private $db;

    
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($name, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare(
            "INSERT INTO `user` (name, email, password) VALUES (?, ?, ?)"
        );

        return $stmt->execute([$name, $email, $hash]);
    }

    public function checkEmail($email)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM `user` WHERE email = ?"
        );
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
