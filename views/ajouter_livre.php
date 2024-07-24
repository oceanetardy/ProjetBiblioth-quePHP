<?php
session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../models/Livre.php';
require_once '../models/Auteur.php';
require_once '../controllers/AjouterLivreController.php';

$message_succes = isset($_SESSION['message_succes']) ? $_SESSION['message_succes'] : '';
$message_erreur = isset($_SESSION['message_erreur']) ? $_SESSION['message_erreur'] : '';

unset($_SESSION['message_succes']);
unset($_SESSION['message_erreur']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $nomAuteur = $_POST['nomAuteur'];
    $prenomAuteur = $_POST['prenomAuteur'];
    $annee_publication = $_POST['annee_publication'];
    $description = $_POST['description'];
    $utilisateurId = $_SESSION['utilisateur_id'];

    $controller = new AjouterLivreController($connection);
    $controller->handleAjouterLivre($titre, $nomAuteur, $prenomAuteur, $annee_publication, $description, $utilisateurId);

    // Redirection pour éviter la soumission multiple du formulaire
    header('Location: ajouter_livre.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="styles_tableau.css">
    <style>
        /* Styles pour les alertes */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 1em;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <?php include '../header.php'; ?>

    <main>
        <div class="container card">
            <h1>Ajouter un livre</h1>

            <?php if ($message_succes) : ?>
                <div class="alert success" id="success-message">
                    <?php echo htmlspecialchars($message_succes); ?>
                </div>
            <?php endif; ?>
            <?php if ($message_erreur) : ?>
                <div class="alert error" id="error-message">
                    <?php echo htmlspecialchars($message_erreur); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="ajouter_livre.php">
                <div class="form-group">
                    <label for="titre">Titre:</label>
                    <input type="text" name="titre" required>
                </div>

                <div class="form-group">
                    <label for="nomAuteur">Nom de l'auteur:</label>
                    <input type="text" name="nomAuteur" required>
                </div>

                <div class="form-group">
                    <label for="prenomAuteur">Prénom de l'auteur:</label>
                    <input type="text" name="prenomAuteur" required>
                </div>

                <div class="form-group">
                    <label for="annee_publication">Année de publication:</label>
                    <input type="text" name="annee_publication" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" required></textarea>
                </div>

                <button type="submit" class="button">Ajouter</button>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.getElementById('success-message');
            var errorMessage = document.getElementById('error-message');

            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.opacity = '0';
                    setTimeout(function() {
                        successMessage.remove();
                    }, 500); // Correspond au délai de transition
                }, 5000); // Message disparaît après 5 secondes
            }

            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.opacity = '0';
                    setTimeout(function() {
                        errorMessage.remove();
                    }, 500); // Correspond au délai de transition
                }, 5000); // Message disparaît après 5 secondes
            }
        });
    </script>

    <?php include '../footer.php'; ?>
</body>

</html>
