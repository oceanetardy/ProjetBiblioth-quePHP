<?php
session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../models/Livre.php';

$livre = new Livre($connection);
$listeLivres = $livre->getLivresUtilisateur($_SESSION['utilisateur_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Livres</title>
    <link rel="stylesheet" href="../public/css/styles.css">

</head>
<body>
    <?php include '../header.php'; ?>

    <main>
        <div class="container">
            <h1>Mes Livres</h1>

            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Description</th>
                        <th>Année de Publication</th> <!-- Nouvelle colonne -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listeLivres as $livre) : ?>
                        <tr>
                            <td><a href="../details_livre.php?livreId=<?php echo htmlspecialchars($livre['id']); ?>"><?php echo htmlspecialchars($livre['titre']); ?></a></td>
                            <td><?php echo htmlspecialchars($livre['nom_auteur']) . ' ' . htmlspecialchars($livre['prenom_auteur']); ?></td>
                            <td><?php echo htmlspecialchars($livre['description']); ?></td>
                            <td><?php echo htmlspecialchars($livre['annee_publication']); ?></td> <!-- Nouvelle donnée -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="button-group">
                <a href="ajouter_livre.php" class="button">Ajouter un livre</a>
                <a href="../index.php" class="button">Retour</a>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>