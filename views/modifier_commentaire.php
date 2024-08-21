<form action="gestion_commentaire.php?action=modifier&id=<?php echo htmlspecialchars($commentaire->id); ?>" method="post">
    <textarea name="contenu" required><?php echo htmlspecialchars($commentaire->contenu); ?></textarea>
    <input type="hidden" name="livre_id" value="<?php echo htmlspecialchars($livre_id); ?>">
    <button type="submit">Modifier Commentaire</button>
</form>
