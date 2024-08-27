<?php
session_start();
require_once 'config.php';
require_once 'controllers/RechercheLivresController.php';

// Création de l'instance du contrôleur
$controller = new RechercheLivresController($connection);

// Gestion de la requête de recherche
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recherche = $_POST['recherche'];
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : null;
    $resultats = $controller->rechercherLivres($recherche, $categorie);
} else {
    // Aucune recherche effectuée
    $resultats = [];
}

// Récupération des catégories pour le filtre
require_once 'models/Categorie.php';
$categorieModel = new Categorie($connection);
$categories = $categorieModel->getAllCategories();

// Affichage de la vue
include 'views/recherche_livres.php';

