<?php
session_start();
require_once 'config.php';
require_once 'controllers/RechercheLivresController.php';

// Création de l'instance du contrôleur
$controller = new RechercheLivresController($connection);

// Gestion de la requête de recherche
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recherche = $_POST['recherche'];
    $resultats = $controller->rechercherLivres($recherche);
} else {
    // Aucune recherche effectuée
    $resultats = [];
}

// Affichage de la vue
include 'views/recherche_livres.php';
?>
