<?php
session_start();
require_once 'config.php';
require_once 'controllers/AjouterLivreController.php';

// Création de l'instance du contrôleur
$controller = new AjouterLivreController($connection);

// Gestion de la requête d'ajout de livre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $nomAuteur = $_POST['nomAuteur'];
    $prenomAuteur = $_POST['prenomAuteur'];
    $description = $_POST['description'];
    $annee_publication = $_POST['annee_publication'];
    $utilisateurId = $_SESSION['utilisateur_id'];
    $categorie_libelle = $_SESSION['categorie_libelle'];

    $controller->handleAjouterLivre($titre, $nomAuteur, $prenomAuteur, $annee_publication, $description, $utilisateurId, $categorie_libelle);
}

// Affichage de la vue
include 'views/ajouter_livre.php';
?>
