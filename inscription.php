<?php
session_start();
require_once 'config.php';

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['utilisateur_id'])) {
    header('Location: index.php');
    exit();
}

// Gestion de l'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifier si l'email existe déjà
    $query = "SELECT id FROM utilisateurs WHERE email = :email";
    $statement = $connection->prepare($query);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $utilisateur_exist = $statement->fetch();

    if ($utilisateur_exist) {
        $message_erreur = 'Cet email est déjà utilisé.';
    } else {
        // Ajouter l'utilisateur à la base de données
        $query = "INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe) VALUES (:nom_utilisateur, :email, :mot_de_passe)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':mot_de_passe', password_hash($mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $statement->execute();

        $_SESSION['utilisateur_id'] = $connection->lastInsertId();
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<h1>Inscription</h1>

<form method="POST" action="inscription.php">
    <label for="nom_utilisateur">Nom d'utilisateur:</label>
    <input type="text" name="nom_utilisateur" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" name="mot_de_passe" required>
    <button type="submit">S'inscrire</button>
</form>

<?php if (isset($message_erreur)) : ?>
    <p><?php echo $message_erreur; ?></p>
<?php endif; ?>
</body>

</html>