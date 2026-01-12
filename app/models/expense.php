<?php
namespace personalWallet\app\models;

use personalWallet\app\core\Database;
use PDO;

class Expense
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function add(int $wallet_id, int $category_id, string $title, float $amount, string $date): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO expense (wallet_id, category_id, title, amount, expense_date) 
             VALUES (:wallet_id, :category_id, :title, :amount, :expense_date)"
        );

        return $stmt->execute([
            ':wallet_id'   => $wallet_id,
            ':category_id' => $category_id,
            ':title'       => $title,
            ':amount'      => $amount,
            ':expense_date'=> $date
        ]);
    }

    public function getByUser(int $user_id): array
    {

        $walletStmt = $this->db->prepare(
            "SELECT id FROM wallet WHERE user_id = :user_id AND month = MONTH(CURDATE()) AND year = YEAR(CURDATE())"
        );
        $walletStmt->execute([':user_id' => $user_id]);
        $wallet = $walletStmt->fetch(PDO::FETCH_ASSOC);
        if (!$wallet) return [];

        $stmt = $this->db->prepare(
            "SELECT e.id, e.title, e.amount, e.expense_date, c.name AS category
             FROM expense e
             JOIN category c ON e.category_id = c.id
             WHERE e.wallet_id = :wallet_id
             ORDER BY e.expense_date DESC"
        );
        $stmt->execute([':wallet_id' => $wallet['id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM expense WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getTotal(int $user_id): float
    {
        $walletStmt = $this->db->prepare(
            "SELECT id FROM wallet WHERE user_id = :user_id AND month = MONTH(CURDATE()) AND year = YEAR(CURDATE())"
        );
        $walletStmt->execute([':user_id' => $user_id]);
        $wallet = $walletStmt->fetch(PDO::FETCH_ASSOC);
        if (!$wallet) return 0;

        $stmt = $this->db->prepare(
            "SELECT SUM(amount) AS total FROM expense WHERE wallet_id = :wallet_id"
        );
        $stmt->execute([':wallet_id' => $wallet['id']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ? (float)$row['total'] : 0;
    }
}
