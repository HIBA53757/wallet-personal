<?php

namespace personalWallet\app\models;

use personalWallet\app\core\Database;
use PDO;

class Wallet
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    private function currentMonth(): int
    {
        return (int) date('n');
    }

    private function currentYear(): int
    {
        return (int) date('Y');
    }

    public function getBalance($user_id): float
    {
        $stmt = $this->db->prepare(
            "SELECT budget
             FROM wallet
             WHERE user_id = :user_id
               AND month = :month
               AND year = :year"
        );

        $stmt->execute([
            ':user_id' => $user_id,
            ':month'   => $this->currentMonth(),
            ':year'    => $this->currentYear()
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? (float)$row['budget'] : 0.0;
    }

    public function updateWallet($user_id, $amount): bool
    {
        $month = $this->currentMonth();
        $year  = $this->currentYear();

        $stmt = $this->db->prepare(
            "SELECT id, budget
             FROM wallet
             WHERE user_id = :user_id
               AND month = :month
               AND year = :year"
        );

        $stmt->execute([
            ':user_id' => $user_id,
            ':month'   => $month,
            ':year'    => $year
        ]);

        $wallet = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($wallet) {
            $update = $this->db->prepare(
                "UPDATE wallet
                 SET budget = :budget
                 WHERE id = :id"
            );

            return $update->execute([
                ':budget' => $wallet['budget'] + $amount,
                ':id'     => $wallet['id']
            ]);
        }

        $insert = $this->db->prepare(
            "INSERT INTO wallet (user_id, month, year, budget)
             VALUES (:user_id, :month, :year, :budget)"
        );

        return $insert->execute([
            ':user_id' => $user_id,
            ':month'   => $month,
            ':year'    => $year,
            ':budget'  => $amount
        ]);
    }

    public function subtractMoney($user_id, $amount): bool
    {
        $month = $this->currentMonth();
        $year  = $this->currentYear();

        $stmt = $this->db->prepare(
            "SELECT id, budget
         FROM wallet
         WHERE user_id = :user_id
           AND month = :month
           AND year = :year"
        );

        $stmt->execute([
            ':user_id' => $user_id,
            ':month'   => $month,
            ':year'    => $year
        ]);

        $wallet = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$wallet || $wallet['budget'] < $amount) {
            return false;
        }

        $update = $this->db->prepare(
            "UPDATE wallet
         SET budget = :budget
         WHERE id = :id"
        );

        return $update->execute([
            ':budget' => $wallet['budget'] - $amount,
            ':id'     => $wallet['id']
        ]);
    }
    public function getTotalExpenses($user_id): float
    {
        $month = (int) date('n');
        $year  = (int) date('Y');

        $stmt = $this->db->prepare(
            "SELECT SUM(e.amount) AS total
         FROM expense e
         JOIN wallet w ON w.id = e.wallet_id
         WHERE w.user_id = :user_id
           AND w.month = :month
           AND w.year = :year"
        );

        $stmt->execute([
            ':user_id' => $user_id,
            ':month'   => $month,
            ':year'    => $year
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ? (float)$row['total'] : 0.0;
    }

    public function updateMonthlyBudget($user_id, $amount = null)
{
    $month = $this->currentMonth();
    $year  = $this->currentYear();

    $stmt = $this->db->prepare(
        "SELECT id, monthly_budget FROM wallet
         WHERE user_id = :user_id AND month = :month AND year = :year"
    );

    $stmt->execute([
        ':user_id' => $user_id,
        ':month'   => $month,
        ':year'    => $year
    ]);

    $wallet = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($amount === null) {
        return $wallet ? (float)$wallet['monthly_budget'] : 0;
    }

    if ($wallet) {
        $update = $this->db->prepare(
            "UPDATE wallet SET monthly_budget = :budget WHERE id = :id"
        );
        return $update->execute([
            ':budget' => $amount,
            ':id'     => $wallet['id']
        ]);
    } else {
        $insert = $this->db->prepare(
            "INSERT INTO wallet (user_id, month, year, budget, monthly_budget)
             VALUES (:user_id, :month, :year, 0, :budget)"
        );
        return $insert->execute([
            ':user_id' => $user_id,
            ':month'   => $month,
            ':year'    => $year,
            ':budget'  => $amount
        ]);
    }
}

}
