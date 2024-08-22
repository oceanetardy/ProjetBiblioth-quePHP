<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Livre</title>
    <link rel="stylesheet" href="/ProjetBibliothequePHP/public/css/styles.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Détails du Livre</h1>

    <?php if (isset($livre)) : ?>
        <section class="book-details">
            <h2><?php echo htmlspecialchars($livre['titre']); ?></h2>
            <p><strong>Auteur:</strong> <?php echo htmlspecialchars($livre['nom'] . ' ' . $livre['prenom']); ?></p>
            <p><strong>Catégorie:</strong> <?php echo htmlspecialchars($livre['categorie_libelle']); ?></p> <!-- Affichage de la catégorie -->
            <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($livre['description'])); ?></p>
        </section>

        <section class="comment-section">
            <h2>Ajouter un commentaire</h2>
            <form method="POST" action="details_livre.php?livreId=<?php echo htmlspecialchars($livre['id']); ?>">
                <input type="hidden" name="livreId" value="<?php echo htmlspecialchars($livre['id']); ?>">
                <label for="contenu">Commentaire:</label>
                <br>
                <textarea name="contenu" id="contenu" required></textarea>
                <br>
                <button type="submit">Ajouter</button>
            </form>

            <h2>Commentaires</h2>
            <?php if (!empty($commentaires)) : ?>
                <?php foreach ($commentaires as $commentaire) : ?>
                    <div class="comment">
                        <p><strong><?php echo htmlspecialchars($commentaire['nom_utilisateur']); ?> :</strong></p>
                        <p><?php echo nl2br(htmlspecialchars($commentaire['contenu'])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucun commentaire pour ce livre.</p>
            <?php endif; ?>
        </section>
    <?php else : ?>
        <p>Aucun livre trouvé.</p>
    <?php endif; ?>
    <br>
    <a href="/ProjetBibliothequePHP" class="button">Retour</a>
</main>
</body>
</html>
