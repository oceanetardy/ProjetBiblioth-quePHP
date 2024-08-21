<?php
session_start();
require_once 'config.php';
require_once 'controllers/InscriptionController.php';

$controller = new InscriptionController($connection);

// Gestion de la requête d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleInscription($_POST['nom_utilisateur'], $_POST['email'], $_POST['mot_de_passe']);
}

// Récupérer et supprimer le message de la session
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - BOOKNET</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <?php if ($message) : ?>
            <div class="message <?php echo htmlspecialchars($message['type']); ?>">
                <?php echo htmlspecialchars($message['text']); ?>
            </div>
        <?php endif; ?>

        <section class="welcome-section">
            <h2>Inscription</h2>
            <form action="inscription.php" method="post">
                <label for="nom_utilisateur">Nom d'utilisateur:</label>
                <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                
                <button type="submit" class="button">S'inscrire</button>
            </form>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var messageElement = document.querySelector('.message');
            if (messageElement) {
                setTimeout(function() {
                    messageElement.style.display = 'none';
                }, 5000); // Le message disparaît après 5 secondes
            }
        });
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>