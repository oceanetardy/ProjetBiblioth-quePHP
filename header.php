<?php
// Vérifiez si l'utilisateur est connecté
$utilisateurConnecte = isset($_SESSION['utilisateur_id']);
$estAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Déterminez si nous sommes sur la page "Mes Livres" ou "Ajouter un Livre"
$pageActuelle = basename($_SERVER['PHP_SELF']);
$estSurPageMesLivres = ($pageActuelle === 'liste_livres_utilisateurs.php');
$estSurPageAddLivres = ($pageActuelle === 'ajouter_livre.php');
?>

<header>
    <h1>BOOKNET</h1>
    <div class="auth-buttons">
        <?php if ($utilisateurConnecte) : ?>
            <a href="logout.php" class="button">Déconnexion</a>

            <!-- Affichez le lien "Tous les Commentaires" si l'utilisateur est administrateur -->
            <?php if ($estAdmin) : ?>
                <a href="gestion_commentaire.php?action=liste" class="button">Tous les Commentaires</a>
            <?php endif; ?>

            <!-- Affichez le lien "Mes Livres" ou "Ajouter un Livre" selon la page actuelle -->
            <?php if ($estSurPageAddLivres) : ?>
                <a href="views/liste_livres_utilisateurs.php" class="button">Mes livres</a>
            <?php else : ?>
                <a href="views/liste_livres_utilisateurs.php" class="button" <?php if ($estSurPageMesLivres) echo 'style="display:none;"'; ?>>Mes Livres</a>
            <?php endif; ?>

        <?php else : ?>
            <a href="login.php" class="button">Se connecter</a>
            <a href="inscription.php" class="button">S'inscrire</a>
        <?php endif; ?>
    </div>
</header>
