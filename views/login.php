<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
<h1>Connexion</h1>
<form method="POST" action="login.php">
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" name="mot_de_passe" required>
    <button class="button" type="submit">Se connecter</button>
</form>
<p>Pas encore inscrit?</p> <a href="inscription.php">S'inscrire</a>
</body>
</html>
