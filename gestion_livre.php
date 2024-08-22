<?php
session_start();
require_once 'config.php';
require_once 'controllers/LivreController.php';

// Récupération des paramètres de la requête
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Déterminer quel contrôleur utiliser
$controller = new LivreController($connection);

switch ($action) {
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
    case 'details':
        if ($id) {
            $controller->details($id);
        }
        break;
    case 'liste':
    default:
        // Afficher tous les livres
        $controller->liste();
        break;
}
?>
