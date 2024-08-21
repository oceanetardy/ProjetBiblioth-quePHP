<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
    <link rel="stylesheet" href="/ProjetBibliothequePHP/public/css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

<main>
    <!-- Formulaire de recherche -->
    <h1>Rechercher un livre ou un auteur</h1>
    <section class="search-section card">
        <form method="POST" action="recherche_livres.php">
            <input type="text" name="recherche" placeholder="Rechercher par titre ou auteur" required>
            <button type="submit">Rechercher</button>
        </form>
    </section>

    <!-- Résultats de recherche -->
    <section class="results-section">
        <?php if (!empty($resultats)) : ?>
            <h2>Résultats</h2>
            <table>
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($resultats as $livre) : ?>
                    <tr>
                        <td><a href="details_livre.php?livreId=<?php echo $livre['id']; ?>"><?php echo $livre['titre']; ?></a></td>
                        <td><?php echo $livre['nom'] . ' ' . $livre['prenom']; ?></td>
                        <td><?php echo $livre['description']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Aucun résultat trouvé.</p>
        <?php endif; ?>
        <a href="/ProjetBibliothequePHP" class="button">Retour</a>
    </section>
</main>
</body>
</html>
