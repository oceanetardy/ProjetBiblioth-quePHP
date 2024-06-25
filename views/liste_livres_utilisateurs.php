<?php
session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../models/Livre.php';
require_once '../models/Auteur.php';


$livre = new Livre($connection);
$listeLivres = $livre->getLivresUtilisateur($_SESSION['utilisateur_id']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mes Livres</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<h1>Mes Livres</h1>
<table>
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Description</th>
    </tr>
    <?php foreach ($listeLivres as $livre) : ?>
        <tr>
            <td><a href="../details_livre.php?livreId=<?php echo $livre['id']; ?>"><?php echo $livre['titre']; ?></a></td>
            <td><?php echo $livre['nom_auteur'] . ' ' . $livre['prenom_auteur']; ?></td>
            <td><?php echo $livre['description']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!--<h2>Ajouter un Livre</h2>-->
<!--<form method="POST" action="ajouter_livre.php">-->
<!--    <label for="titre">Titre:</label>-->
<!--    <input type="text" name="titre" required>-->
<!--    <label for="auteur">Auteur:</label>-->
<!--    <input type="text" name="auteur" required>-->
<!--    <label for="description">Description:</label>-->
<!--    <textarea name="description" required></textarea>-->
<!--    <button type="submit">Ajouter</button>-->
<!--</form>-->
<a href="../ajouter_livre.php" class="button">Ajouter un livre</a>

<a href="/gestionlivre" class="button">Retour</a>
</body>
</html>
