<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Résultats de recherche</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Résultats de recherche</h1>

<!-- Formulaire de recherche -->
<form method="POST" action="recherche_livres.php">
    <input type="text" name="recherche" placeholder="Rechercher par titre ou auteur">
    <button type="submit">Rechercher</button>
</form>

<?php if (!empty($resultats)) : ?>
    <h2>Résultats</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Description</th>
        </tr>
        <?php foreach ($resultats as $livre) :?>
            <tr>

                <td><a href="details_livre.php?livreId=<?php echo $livre['id']; ?>"><?php echo $livre['titre']; ?></a></td>
                <td><?php echo $livre['nom'] . ' ' . $livre['prenom']; ?></td>
                <td><?php echo $livre['description']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>Aucun résultat trouvé.</p>
<?php endif; ?>
<a href="/gestionlivre" class="button">Retour</a>

</body>
</html>
