<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Détails du Livre</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
<?php if (isset($livre)) : ?>
    <h1>Détails du Livre</h1>
    <h2><?php echo $livre['titre']; ?></h2>
    <p>Auteur: <?php echo $livre['nom'] . ' ' . $livre['prenom']; ?></p>
    <p>Description: <?php echo $livre['description']; ?></p>

    <!-- Formulaire pour ajouter un commentaire -->
    <h2>Ajouter un commentaire</h2>
    <form method="POST" action="details_livre.php?livreId=<?php echo $livre['id']; ?>">
        <input type="hidden" name="livreId" value="<?php echo $livre['id']; ?>">
        <label for="contenu">Contenu:</label>
        <textarea name="contenu" required></textarea>
        <button type="submit">Ajouter</button>
    </form>


    <!-- Affichage des commentaires existants -->
    <h2>Commentaires</h2>
    <?php foreach ($commentaires as $commentaire) : ?>
        <p><?php echo $commentaire['nom_utilisateur']; ?> : </p>
        <p><?php echo $commentaire['contenu']; ?></p>
    <?php endforeach; ?>
<?php else : ?>
    <p>Aucun livre trouvé.</p>
<?php endif; ?>

<a href="/ProjetBibliothequePHP" class="button">Retour</a>

</body>
</html>
