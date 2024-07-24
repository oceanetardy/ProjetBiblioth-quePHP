<?php
session_start();

// Déconnexion de l'utilisateur
session_unset();
session_destroy();

// Redirection vers la page d'accueil
header('Location: ../index.php');
exit();
?>
