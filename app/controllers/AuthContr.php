<?php

namespace personalWallet\app\controllers;

use personalWallet\app\models\user;

class AuthContr
{

    public function showRegister()
    {
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /personalwallet/app/views/auth/login.php');
            exit();
        }

        $name = trim($_POST['nom']); 
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $confirm = $_POST['confirm_password'];

        if (!$email || $password !== $confirm) {
            die("Données invalides.");
        }

        $userModel = new user();

        if ($userModel->checkEmail($email)) {
            die("Cet email est déjà utilisé.");
        }

        if ($userModel->create($name, $email, $password)) {
            header('Location: index.php?action=login');
            exit();
        }

        die("Erreur lors de l'inscription.");
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $userModel = new user();
            $userData = $userModel->checkEmail($email);
            if ($userData && password_verify($password, $userData['password'])) {

                session_start();
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['user_name'] = $userData['nom'];

                header('Location: /personalwallet/app/views/pages/dashboard.php');
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
                require_once __DIR__ . '/../views/auth/login.php';
            }
        }
    }

    public function showLogin()
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }
}
