<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Ajouter un livre</h1>
<form method="POST" action="ajouter_livre.php">
    <label for="titre">Titre:</label>
    <input type="text" name="titre" required><br>

    <label for="nomAuteur">Nom de l'auteur:</label>
    <input type="text" name="nomAuteur" required><br>

    <label for="prenomAuteur">Prénom de l'auteur:</label>
    <input type="text" name="prenomAuteur" required><br>

    <label for="annee_publication">Année de publication:</label>
    <input type="text" name="annee_publication" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br>

    <button type="submit">Ajouter</button>
</form>
</body>
</html>


<a href="/gestionlivre" class="button">Retour</a>
</body>
</html>
