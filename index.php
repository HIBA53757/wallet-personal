<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

use personalWallet\app\controllers\AuthContr;
use personalWallet\app\controllers\WalletContr;
use personalWallet\app\controllers\CategoryContr;
use personalWallet\app\controllers\ExpenseContr;

$action = $_GET['action'] ?? 'dashboard';

$auth = new AuthContr();
$walletContr = new WalletContr();
$categoryContr = new CategoryContr();
$expenseContr = new ExpenseContr();

switch ($action) {

    case 'register':
        $auth->showRegister();
        break;

    case 'submit-register':
        $auth->register();
        break;

    case 'login':
        $auth->showLogin();
        break;

    case 'submit-login':
        $auth->login();
        break;

    case 'dashboard':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $walletContr->dashboard($_SESSION['user_id']);
        break;

    case 'updateWallet':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $walletContr->updateWallet($_SESSION['user_id']);
        break;

        case 'setBudget':
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
    $walletContr->setBudget($_SESSION['user_id']);
      break;
     case 'addCategory':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $categoryContr->addCategory();
        break;

        case 'addExpense':
    if (!isset($_SESSION['user_id']))
         { header('Location: index.php?action=login'); exit; }
    $expenseContr->addExpense($_SESSION['user_id']);
    break;

case 'deleteExpense':
    if (!isset($_SESSION['user_id']))
         { header('Location: index.php?action=login'); exit; }
    $expenseContr->deleteExpense();
    break;

    default:
        header('Location: index.php?action=dashboard');
        exit;
}
