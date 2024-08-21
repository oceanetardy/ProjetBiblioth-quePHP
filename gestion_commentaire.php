<?php
session_start();
require_once 'config.php';
require_once 'controllers/CommentaireController.php';


// Récupération des paramètres de la requête
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Déterminer quel contrôleur utiliser
$controller = new CommentaireController($connection);

switch ($action) {
    case 'ajouter':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->ajouter();
        } else {
            include 'views/ajouter_commentaire.php';
        }
        break;

    case 'modifier':
        if ($id) {
            $controller->modifier($id);
        }
        break;
    case 'supprimer':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $id) {
            $controller->supprimer($id);
        }
        break;

    case 'liste':
        // Afficher tous les commentaires
        $controller->liste();
        break;

    default:
        include 'views/index.php';
        break;
}
?>
