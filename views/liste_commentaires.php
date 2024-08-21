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
            <th>ID</th>
            <th>Livres ID</th>
            <th>Utilisateur ID</th>
            <th>Contenu</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($commentaires as $commentaire) : ?>
            <tr>
                <td><?php echo htmlspecialchars($commentaire['id']); ?></td>
                <td><?php echo htmlspecialchars($commentaire['livre_id']); ?></td>
                <td><?php echo htmlspecialchars($commentaire['utilisateur_id']); ?></td>
                <td><?php echo htmlspecialchars($commentaire['contenu']); ?></td>
                <td>
                    <a href="gestion_commentaire.php?action=modifier&id=<?php echo htmlspecialchars($commentaire['id']); ?>">Modifier</a>
                    <a href="gestion_commentaire.php?action=supprimer&id=<?php echo htmlspecialchars($commentaire['id']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
</html>
