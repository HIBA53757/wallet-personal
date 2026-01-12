<?php
namespace personalWallet\app\models;

use personalWallet\app\core\Database;
use PDO;

abstract class Transaction
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($user_id, $type, $amount, $description = null)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO transactions (user_id, type, amount, description)
             VALUES (:user_id, :type, :amount, :description)"
        );

        return $stmt->execute([
            ':user_id'     => $user_id,
            ':type'        => $type, 
            ':amount'      => $amount,
            ':description' => $description
        ]);
    }

    public function getAll($user_id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM transactions
             WHERE user_id = :user_id
             ORDER BY created_at DESC"
        );
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
