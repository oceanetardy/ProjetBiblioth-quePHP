<?php
session_start();
require_once 'config.php';
require_once 'controllers/InscriptionController.php';

// Création de l'instance du contrôleur
$controller = new InscriptionController($connection);

// Gestion de la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleInscription($_POST['nom_utilisateur'], $_POST['email'], $_POST['mot_de_passe']);
}

// Affichage de la vue
$viewData = $controller->getViewData();
include 'views/inscription.php';
?>
