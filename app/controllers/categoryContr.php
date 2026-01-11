<?php
namespace personalWallet\app\controllers;

use personalWallet\app\models\Category;

class CategoryContr
{
    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function dashboardCategories(): array
    {
        return $this->category->getAll();
    }

    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['category_name'] ?? '');
            if ($name !== '') {
                $this->category->add($name);
            }
            header('Location: index.php?action=dashboard');
            exit;
        }
    }

  
}
