<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un livre</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<main>
    <div class="container card">
        <h1>Modifier un livre</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert <?php echo $_SESSION['message']['type']; ?>">
                <?php echo htmlspecialchars($_SESSION['message']['text']); ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <form method="POST" action="gestion_livre.php?action=modifier&id=<?php echo $livre['id']; ?>">
            <div class="form-group">
                <label for="titre">Titre:</label>
                <input type="text" name="titre" value="<?php echo htmlspecialchars($livre['titre']); ?>" required>
            </div>

            <div class="form-group">
                <label for="nomAuteur">Nom de l'auteur:</label>
                <input type="text" name="nomAuteur" value="<?php echo htmlspecialchars($livre['nom']); ?>" required>
            </div>

            <div class="form-group">
                <label for="prenomAuteur">Prénom de l'auteur:</label>
                <input type="text" name="prenomAuteur" value="<?php echo htmlspecialchars($livre['prenom']); ?>" required>
            </div>

            <div class="form-group">
                <label for="annee_publication">Année de publication:</label>
                <input type="number" name="annee_publication" value="<?php echo htmlspecialchars($livre['annee_publication']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" required><?php echo htmlspecialchars($livre['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="categorie_id">Catégorie:</label>
                <select name="categorie_id" required>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie['id']; ?>" <?php echo ($categorie['id'] == $livre['categorie_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($categorie['libelle']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Modifier</button>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
