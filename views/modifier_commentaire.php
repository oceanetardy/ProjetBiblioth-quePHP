<?php
// Initialisation des variables avec des valeurs par défaut pour éviter les erreurs
$id = isset($commentaire['id']) ? htmlspecialchars($commentaire['id']) : '';
$contenu = isset($commentaire['contenu']) ? htmlspecialchars($commentaire['contenu']) : '';
$livre_id = isset($livre_id) ? htmlspecialchars($livre_id) : '';
?>

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
<h1> Modifier le commentaire </h1>
<section class="card">
    <form action="gestion_commentaire.php?action=modifier&id=<?php echo $id; ?>" method="post">
        <textarea name="contenu" required><?php echo $contenu; ?></textarea>
        <input type="hidden" name="livre_id" value="<?php echo $livre_id; ?>">
        <button type="submit">Modifier Commentaire</button>
    </form>
</section>

</main>
</body>