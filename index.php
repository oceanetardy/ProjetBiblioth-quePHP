<?php
session_start();

if (isset($_SESSION['utilisateur_id'])) {
    // L'utilisateur est connecté
    require_once 'config.php';
    require_once 'models/Utilisateur.php';

    $utilisateur = new Utilisateur($connection);
    $utilisateurConnecte = $utilisateur->getUtilisateurById($_SESSION['utilisateur_id']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bibliothèque</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<h1>Bibliothèque 2.0</h1>
<div>
    <p>Bienvenue sur cette bibliothèque 2.0</p>
    <p>Connectez-vous ou inscrivez vous pour avoir accès à toutes les fonctionnalités.</p>
    <p>Ajouter vos livres dans votre bibliothèque et parcourez les livres des autres utilisateurs.</p>
    <p>Donnez votre avis sur les livres que vous avez lus!</p>
    <img src="medias/img.png" width="300" height="200">
</div>


<?php if (isset($utilisateurConnecte)) : ?>
    <div>
        <p>Bienvenue, <?php echo $utilisateurConnecte['nom_utilisateur']; ?>!</p>
        <p>Email: <?php echo $utilisateurConnecte['email']; ?></p>
        <a href="logout.php" class="button">Déconnexion</a>
        <a href="views/liste_livres_utilisateurs.php" class="button">Mes Livres</a>
        <a href="views/liste_livres.php" class="button">Tous les livres</a>
        <a href="recherche_livres.php" class="button">Chercher un livre</a>


    </div>
<?php else : ?>
<div>
    <a href="login.php" class="button">Se connecter</a>
    <a href="inscription.php" class="button">S'inscrire</a>
</div>

<?php endif; ?>
</body>
</html>
