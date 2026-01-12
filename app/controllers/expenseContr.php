<?php
namespace personalWallet\app\controllers;

use personalWallet\app\models\Expense;
use personalWallet\app\models\Wallet;

class ExpenseContr
{
    private $expense;
    private $wallet;

    public function __construct()
    {
        $this->expense = new Expense();
        $this->wallet  = new Wallet();
    }

    public function addExpense(int $user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title       = trim($_POST['title'] ?? '');
            $amount      = (float)($_POST['amount'] ?? 0);
            $date        = $_POST['date'] ?? date('Y-m-d');
            $category_id = (int)($_POST['category_id'] ?? 0);

            if ($title && $amount > 0 && $category_id) {

                $wallet_id = $this->wallet->getWalletId($user_id);

                $this->expense->add(
                    $wallet_id,
                    $category_id,
                    $title,
                    $amount,
                    $date
                );

           
                $this->wallet->subtractMoney($user_id, $amount);
            }

            header('Location: index.php?action=dashboard');
            exit;
        }
    }

    public function deleteExpense()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['expense_id'] ?? 0);
            if ($id) {
                $this->expense->delete($id);
            }
            header('Location: index.php?action=dashboard');
            exit;
        }
    }

    public function getExpenses(int $user_id): array
    {
        return $this->expense->getByUser($user_id);
    }
}
