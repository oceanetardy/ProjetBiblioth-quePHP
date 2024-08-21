<?php
session_start();
require_once 'config.php';
require_once 'controllers/LoginController.php';

$controller = new LoginController($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleLogin($_POST['email'], $_POST['mot_de_passe']);
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login - BOOKNET</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <?php if ($message): ?>
            <div class="message <?php echo htmlspecialchars($message['type']); ?>">
                <?php echo htmlspecialchars($message['text']); ?>
            </div>
        <?php endif; ?>

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

    <?php include 'views/footer.php'; ?>
</body>
</html>