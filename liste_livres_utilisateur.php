<?php
session_start();
require_once 'config.php';
require_once 'controllers/ListeLivresUtilisateurController.php';


// Création de l'instance du contrôleur
$controller = new ListeLivresUtilisateurController($connection);

// Récupération des données de l'utilisateur connecté
$utilisateurId = $_SESSION['utilisateur_id'];

// Récupération des livres de l'utilisateur
$listeLivres = $controller->getLivresUtilisateur($utilisateurId);

// Affichage de la vue
$viewData = $controller->getViewData();
include 'views/liste_livres_utilisateur.php';
?>
