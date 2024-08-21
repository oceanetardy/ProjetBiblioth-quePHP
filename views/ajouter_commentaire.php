<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Livre</title>
    <link rel="stylesheet" href="/ProjetBibliothequePHP/public/css/styles.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>


<form action="gestion_commentaire.php?action=ajouter" method="post">
    <input type="hidden" name="livre_id" value="<?php echo htmlspecialchars($livre_id); ?>">
    <input type="hidden" name="utilisateur_id" value="<?php echo htmlspecialchars($_SESSION['utilisateur_id']); ?>">
    <textarea name="contenu" required></textarea>
    <button type="submit">Ajouter Commentaire</button>
</form>
</main>
</body>