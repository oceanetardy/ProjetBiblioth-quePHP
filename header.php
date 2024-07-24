<?php

// Vérifiez si l'utilisateur est connecté
$utilisateurConnecte = isset($_SESSION['utilisateur_id']);

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
            
            <!-- Affichez le lien "Mes Livres" ou "Ajouter un Livre" selon la page actuelle -->
            <?php if ($estSurPageAddLivres) : ?>
                <!-- Si vous êtes sur la page d'ajout de livre, le lien "Mes Livres" est affiché avec un autre texte ou une autre URL -->
                <a href="liste_livres_utilisateurs.php" class="button">Mes livres</a>
            <?php else : ?>
                <!-- Sinon, afficher le lien habituel vers "Mes Livres" -->
                <a href="views/liste_livres_utilisateurs.php" class="button" <?php if ($estSurPageMesLivres) echo 'style="display:none;"'; ?>>Mes Livres</a>
            <?php endif; ?>

        <?php else : ?>
            <a href="login.php" class="button">Se connecter</a>
            <a href="inscription.php" class="button">S'inscrire</a>
        <?php endif; ?>
    </div>
</header>