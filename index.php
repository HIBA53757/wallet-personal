<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

use personalWallet\app\controllers\AuthContr;
use personalWallet\app\controllers\WalletContr;
use personalWallet\app\controllers\CategoryContr;

$action = $_GET['action'] ?? 'dashboard';

$auth = new AuthContr();
$walletContr = new WalletContr();
$categoryContr = new CategoryContr();

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

    default:
        header('Location: index.php?action=dashboard');
        exit;
}
