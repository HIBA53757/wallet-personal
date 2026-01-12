<?php

namespace personalWallet\app\controllers;

use personalWallet\app\models\Wallet;

class WalletContr
{
    private $wallet;

    public function __construct()
    {
        $this->wallet = new Wallet();
    }

    public function dashboard($user_id)
    {
        $walletBalance = $this->wallet->getBalance($user_id);
        $totalExpenses  = $this->wallet->getTotalExpenses($user_id);
        $remaining      = $walletBalance - $totalExpenses;
        $monthlyBudget = $this->wallet->updateMonthlyBudget($user_id);
        $categoryContr = new CategoryContr();
        $categories = $categoryContr->dashboardCategories();
        $expenseContr = new ExpenseContr();
        $expenses = $expenseContr->getExpenses($user_id);
        require __DIR__ . '/../views/pages/dashboard.php';
    }

    public function updateWallet($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = (float) ($_POST['amount'] ?? 0);

            if ($amount > 0) {
                $this->wallet->updateWallet($user_id, $amount);
            }

            header('Location: index.php?action=dashboard');
            exit;
        }
    }

    public function setBudget($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = (float) ($_POST['budget'] ?? 0);
            if ($amount >= 0) {
                $this->wallet->updateMonthlyBudget($user_id, $amount);
            }
            header('Location: index.php?action=dashboard');
            exit;
        }
    }


    public function addExpense($user_id, $amount)
    {
        return $this->wallet->subtractMoney($user_id, $amount);
    }
}
