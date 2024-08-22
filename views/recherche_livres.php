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
    <section class="search-section card">
        <h1>Rechercher un livre ou un auteur</h1>
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
                    <th>Année de Publication</th>
                    <th>Catégorie</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($resultats as $livre) : ?>
                    <tr>
                        <td>
                            <a href="details_livre.php?livreId=<?php echo isset($livre['id']) ? htmlspecialchars($livre['id']) : '#'; ?>">
                                <?php echo isset($livre['titre']) ? htmlspecialchars($livre['titre']) : 'Titre non disponible'; ?>
                            </a>
                        </td>
                        <td>
                            <?php
                            $nomAuteur = isset($livre['nom']) ? htmlspecialchars($livre['nom']) : 'Nom inconnu';
                            $prenomAuteur = isset($livre['prenom']) ? htmlspecialchars($livre['prenom']) : 'Prénom inconnu';
                            echo $nomAuteur . ' ' . $prenomAuteur;
                            ?>
                        </td>
                        <td>
                            <?php echo isset($livre['description']) ? htmlspecialchars($livre['description']) : 'Description non disponible'; ?>
                        </td>
                        <td>
                            <?php echo isset($livre['annee_publication']) ? htmlspecialchars($livre['annee_publication']) : 'Année non définie'; ?>
                        </td>
                        <td>
                            <?php echo isset($livre['categorie_libelle']) ? htmlspecialchars($livre['categorie_libelle']) : 'Catégorie non définie'; ?>
                        </td>
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
