<?php
session_start();
require_once 'config.php';
require_once 'controllers/LivreController.php';

$livreController = new LivreController($connection);

$action = isset($_GET['action']) ? $_GET['action'] : 'liste';
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($action) {
    case 'modifier':
        if ($id) {
            $livreController->modifier($id);
        }
        break;
    case 'supprimer':
        if ($id) {
            $livreController->supprimer($id);
        }
        break;
    case 'details':
        if ($id) {
            $livreController->details($id);
        }
        break;
    case 'liste':
    default:
        $livreController->liste();
        break;
}
?>
