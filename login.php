<?php
session_start();
require_once 'config.php';
require_once 'controllers/LoginController.php';

$controller = new LoginController($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleLogin($_POST['email'], $_POST['mot_de_passe']);
}

// Récupérer et supprimer le message de la session
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login - BOOKNET</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <!-- Afficher le message -->
        <?php if ($message): ?>
            <div class="message <?php echo htmlspecialchars($message['type']); ?>">
                <?php echo htmlspecialchars($message['text']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <section class="welcome-section">
            <h2>Connexion</h2>
            <form action="login.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                <button type="submit" class="button">Se connecter</button>
            </form>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>