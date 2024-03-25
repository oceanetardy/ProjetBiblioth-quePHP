*<?php
session_start();
require_once 'config.php';

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['utilisateur_id'])) {
    header('Location: index.php');
    exit();
}

// Gestion de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifier les identifiants de connexion
    $query = "SELECT id, mot_de_passe FROM utilisateurs WHERE email = :email";
    $statement = $connection->prepare($query);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $utilisateur = $statement->fetch();

    // Vérifier le mot de passe
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        $_SESSION['utilisateur_id'] = $utilisateur['id'];
        header('Location: index.php');
        exit();
    } else {
        $message_erreur = 'Identifiants de connexion invalides.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<h1>Connexion</h1>

<form method="POST" action="login.php">
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" name="mot_de_passe" required>
    <button type="submit">Se connecter</button>
</form>

<?php if (isset($message_erreur)) : ?>
    <p><?php echo $message_erreur; ?></p>
<?php endif; ?>

<p>Pas encore inscrit? <a href="inscription.php">S'inscrire</a></p>
</body>

</html>