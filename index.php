<?php
session_start();

if (isset($_SESSION['utilisateur_id'])) {
    require_once 'config.php';
    require_once 'models/Utilisateur.php';

    $utilisateur = new Utilisateur($connection);
    $utilisateurConnecte = $utilisateur->getUtilisateurById($_SESSION['utilisateur_id']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BOOKNET</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <?php if (isset($utilisateurConnecte)) : ?>
            <section class="user-info">
                <p>Bienvenue, <?php echo htmlspecialchars($utilisateurConnecte['nom_utilisateur']); ?>!</p>
                <p>Email: <?php echo htmlspecialchars($utilisateurConnecte['email']); ?></p>
                <div class="button-group">
                    <a href="views/liste_livres.php" class="button">Tous les livres</a>
                    <a href="recherche_livres.php" class="button">Chercher un livre</a>
                </div>
            </section>
        <?php else : ?>
            <section class="welcome-section">
                <p>Bienvenue sur BOOKNET</p>
                <p>Connectez-vous ou inscrivez-vous pour avoir accès à toutes les fonctionnalités.</p>
                <p>Ajoutez vos livres dans votre bibliothèque et parcourez les livres des autres utilisateurs.</p>
                <p>Donnez votre avis sur les livres que vous avez lus!</p>
                <img src="medias/LogoPHPV2.png" alt="Image de bibliothèque" width="250" height="150">
            </section>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>