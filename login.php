<?php
session_start();
require_once 'config.php';
require_once 'controllers/LoginController.php';

$controller = new LoginController($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleLogin($_POST['email'], $_POST['mot_de_passe']);
}

$viewData = $controller->getViewData();
include 'views/login.php';
?>
