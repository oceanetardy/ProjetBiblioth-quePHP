<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../public/css/styles.css">
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
    <button class="button" type="submit">S'inscrire</button>
</form>
<p>Déjà un compte?</p>
<a href="login.php">Se connecter</a>

</body>
</html>
