<?php
// Assurez-vous que session_start() est appelé uniquement une fois, généralement dans un fichier de configuration ou dans header.php
 session_start(); // À retirer si déjà inclus dans un autre fichier

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit();
}

// Inclure le fichier de configuration avec un chemin correct
require_once '../config.php';
require_once '../controllers/AjouterLivreController.php';

// Initialiser les messages de succès et d'erreur
$message_succes = isset($_SESSION['message_succes']) ? $_SESSION['message_succes'] : '';
$message_erreur = isset($_SESSION['message_erreur']) ? $_SESSION['message_erreur'] : '';

unset($_SESSION['message_succes']);
unset($_SESSION['message_erreur']);

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
    header('Location: ajouter_livre.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="/ProjetBibliothequePHP/public/css/styles.css">
</head>

<body>
<?php include '../header.php'; ?>

<main>
    <div class="container card">
        <h1>Ajouter un livre</h1>

        <?php if ($message_succes) : ?>
            <div class="alert success" id="success-message">
                <?php echo htmlspecialchars($message_succes); ?>
            </div>
        <?php endif; ?>
        <?php if ($message_erreur) : ?>
            <div class="alert error" id="error-message">
                <?php echo htmlspecialchars($message_erreur); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="ajouter_livre.php">
            <div class="form-group">
                <label for="titre">Titre:</label>
                <input type="text" name="titre" required>
            </div>

            <div class="form-group">
                <label for="nomAuteur">Nom de l'auteur:</label>
                <input type="text" name="nomAuteur" required>
            </div>

            <div class="form-group">
                <label for="prenomAuteur">Prénom de l'auteur:</label>
                <input type="text" name="prenomAuteur" required>
            </div>

            <div class="form-group">
                <label for="annee_publication">Année de publication:</label>
                <input type="number" name="annee_publication" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="categorie_id">Catégorie:</label>
                <select name="categorie_id" required>
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?php echo htmlspecialchars($categorie['id']); ?>">
                            <?php echo htmlspecialchars($categorie['libelle']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <button type="submit">Ajouter le livre</button>
            </div>
        </form>

        <div class="button-group">
            <a href="../index.php" class="button">Retour</a>
        </div>
    </div>
</main>

<footer>
    <?php include 'footer.php'; ?>
</footer>
</body>

</html>
