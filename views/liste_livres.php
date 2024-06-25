<?php
session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../models/Livre.php';

$livre = new Livre($connection);
$listeLivres = $livre->getAllLivres();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tous les Livres</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<h1>Tous les livres</h1>
<table>
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Description</th>
    </tr>
    <?php foreach ($listeLivres as $livre) : ?>
        <tr>
            <td><a href="../details_livre.php?livreId=<?php echo $livre['id']; ?>"><?php echo $livre['titre']; ?></a></td>
            <td><?php echo $livre['nom'] . ' ' . $livre['prenom']; ?></td>
            <td><?php echo $livre['description']; ?></td>
        </tr>
    <?php endforeach; ?>

</table>
<a href="/gestionlivre" class="button">Retour</a>

</body>
</html>
