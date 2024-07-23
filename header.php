<?php
// Vérifiez si l'utilisateur est connecté
$utilisateurConnecte = isset($_SESSION['utilisateur_id']);
?>

<header>
    <h1>BOOKNET</h1>
    <div class="auth-buttons">
        <?php if ($utilisateurConnecte) : ?>
            <a href="logout.php" class="button">Déconnexion</a>
            <a href="views/liste_livres_utilisateurs.php" class="button">Mes Livres</a>
        <?php else : ?>
            <a href="login.php" class="button">Se connecter</a>
            <a href="inscription.php" class="button">S'inscrire</a>
        <?php endif; ?>
    </div>
</header>