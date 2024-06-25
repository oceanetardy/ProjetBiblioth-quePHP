<?php
session_start();

require_once 'config.php';
require_once 'controllers/DetailsLivreController.php';

$controller = new DetailsLivreController($connection);

if (!isset($_GET['livreId'])) {
    header('Location: index.php');
    exit();
}

$livreId = $_GET['livreId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livreId = $_POST['livreId'];
    $utilisateurId = $_SESSION['utilisateur_id'];
    $contenu = $_POST['contenu'];

    $controller->handleAjouterCommentaire($livreId, $utilisateurId, $contenu);
}

$controller->afficherDetailsLivre($livreId);
?>
