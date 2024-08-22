<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des livres</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<main>
        <h1>Liste des livres</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert <?php echo $_SESSION['message']['type']; ?>">
                <?php echo htmlspecialchars($_SESSION['message']['text']); ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <table>
            <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($livres as $livre): ?>
                <tr>
                    <td><a href="gestion_livre.php?action=details&id=<?php echo $livre['id']; ?>"><?php echo htmlspecialchars($livre['titre']); ?></a></td>
                    <td><?php echo htmlspecialchars($livre['nom_auteur']) . ' ' . htmlspecialchars($livre['prenom_auteur']); ?></td>
                    <td><?php echo htmlspecialchars($livre['annee_publication']); ?></td>
                    <td><?php echo htmlspecialchars($livre['description']); ?></td>
                    <td><?php echo htmlspecialchars($livre['categorie_libelle']); ?></td>
                    <td>
                        <a href="gestion_livre.php?action=modifier&id=<?php echo $livre['id']; ?>">Modifier</a>
                        <a href="gestion_livre.php?action=supprimer&id=<?php echo $livre['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</main>

<footer>
    <?php include 'footer.php'; ?>
</footer>
</body>
</html>
