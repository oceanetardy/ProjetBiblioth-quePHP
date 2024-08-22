<?php

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit();
}

// Inclure le fichier de configuration qui initialise la connexion
require_once 'config.php';  // Assurez-vous que le chemin est correct

require_once 'controllers/AjouterLivreController.php';
require_once 'models/Livre.php';  // Assurez-vous que le modèle est inclus

$livreId = $_GET['id'];

if (!$livreId) {
    $_SESSION['message_erreur'] = "ID du livre manquant.";
    header('Location: gestion_livres.php');
    exit();
}

// Charger les données du livre à modifier
$livre = (new Livre($connection))->getDetailsLivre($livreId);

if (!$livre) {
    $_SESSION['message_erreur'] = "Livre introuvable.";
    header('Location: gestion_livres.php');
    exit();
}

// Charger les catégories disponibles
$controller = new AjouterLivreController($connection);
$viewData = $controller->getViewData();
$categories = $viewData['categories'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $nomAuteur = $_POST['nomAuteur'];
    $prenomAuteur = $_POST['prenomAuteur'];
    $annee_publication = $_POST['annee_publication'];
    $description = $_POST['description'];
    $categorieId = $_POST['categorie_id'];
    $utilisateurId = $_SESSION['utilisateur_id'];

    $controller->handleAjouterLivre($titre, $nomAuteur, $prenomAuteur, $annee_publication, $description, $utilisateurId, $categorieId);

    // Redirection pour éviter la soumission multiple du formulaire
    header('Location: modifier_livre.php?id=' . $livreId);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le livre</title>
    <link rel="stylesheet" href="/ProjetBibliothequePHP/public/css/styles.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Modifier le livre</h1>
    <section class="card">
        <form method="POST" action="modifier_livre.php?id=<?= htmlspecialchars($livreId) ?>">
            <div class="form-group">
                <label for="titre">Titre:</label>
                <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>
            </div>

            <div class="form-group">
                <label for="nomAuteur">Nom de l'auteur:</label>
                <input type="text" name="nomAuteur" value="<?= htmlspecialchars($livre['nom']) ?>" required>
            </div>

            <div class="form-group">
                <label for="prenomAuteur">Prénom de l'auteur:</label>
                <input type="text" name="prenomAuteur" value="<?= htmlspecialchars($livre['prenom']) ?>" required>
            </div>

            <div class="form-group">
                <label for="annee_publication">Année de publication:</label>
                <input type="number" name="annee_publication" value="<?= htmlspecialchars($livre['annee_publication']) ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" required><?= htmlspecialchars($livre['description']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="categorie_id">Catégorie:</label>
                <select name="categorie_id" required>
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= htmlspecialchars($categorie['id']); ?>" <?= $livre['categorie_id'] == $categorie['id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($categorie['libelle']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <button type="submit">Modifier Livre</button>
            </div>
        </form>
    </section>
</main>
<footer>
    <?php include 'footer.php'; ?>
</footer>
</body>
</html>
