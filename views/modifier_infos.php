<?php
session_start();
require_once '../models/Utilisateur.php'; // Assurez-vous d'inclure le fichier de la classe Utilisateur
require_once '../config.php'; // Inclure votre configuration de connexion

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit();
}

$utilisateur = new Utilisateur($connection);

// Récupérez les informations de l'utilisateur connecté
$user = $utilisateur->getUtilisateurById($_SESSION['utilisateur_id']);

// Initialiser les messages de succès et d'erreur
$message_succes = isset($_GET['success']) ? 'Vos informations ont été mises à jour avec succès.' : '';
$message_erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Validation des données
    $errors = [];

    if (empty($nom_utilisateur) || empty($email)) {
        $errors[] = "Le nom d'utilisateur et l'email sont requis.";
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = "L'email fourni n'est pas valide.";
    }

    if (empty($errors)) {
        // Appel de la méthode pour mettre à jour les informations de l'utilisateur
        $updated = $utilisateur->updateUtilisateur($_SESSION['utilisateur_id'], $nom_utilisateur, $email, $mot_de_passe);
        if ($updated) {
            header('Location: modifier_infos.php?success=1');
            exit();
        } else {
            $message_erreur = "Une erreur est survenue lors de la mise à jour.";
        }
    } else {
        $message_erreur = implode('<br>', $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Mes Infos</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
<?php include '../header.php'; ?>

<main>
    <div class="container card">
        <h1>Modifier Mes Infos</h1>

        <?php if ($message_succes): ?>
            <div class="alert success">
                <?php echo htmlspecialchars($message_succes); ?>
            </div>
        <?php endif; ?>

        <?php if ($message_erreur): ?>
            <div class="alert error">
                <?php echo htmlspecialchars($message_erreur); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="modifier_infos.php">
            <div class="form-group">
                <label for="nom_utilisateur">Nom d'utilisateur :</label>
                <input type="text" id="nom_utilisateur" name="nom_utilisateur"
                       value="<?php echo htmlspecialchars($user['nom_utilisateur']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe (laissez vide pour ne pas modifier) :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe">
            </div>

            <div class="form-group">
                <button type="submit">Mettre à jour</button>
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
