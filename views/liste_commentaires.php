<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Commentaires</title>
    <link rel="stylesheet" href="/ProjetBibliothequePHP/public/css/styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>

    <h1>Liste des Commentaires</h1>
    <table>
        <thead>
        <tr>
            <th>Titre livre</th>
            <th>Utilisateur</th>
            <th>Commentaire</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($commentaires as $commentaire) : ?>
            <tr>
                <td><?php echo htmlspecialchars($commentaire['titre']); ?></td>
                <td><?php echo htmlspecialchars($commentaire['nom_utilisateur']); ?></td>
                <td><?php echo htmlspecialchars($commentaire['contenu']); ?></td>
                <td>
                    <a href="gestion_commentaire.php?action=modifier&id=<?php echo htmlspecialchars($commentaire['id']); ?>">Modifier</a>
                    <a href="gestion_commentaire.php?action=supprimer&id=<?php echo htmlspecialchars($commentaire['id']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="button-group">
        <a href="index.php" class="button">Retour</a>
    </div>
</main>
</body>
</html>
