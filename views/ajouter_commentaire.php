<form action="gestion_commentaire.php?action=ajouter" method="post">
    <input type="hidden" name="livre_id" value="<?php echo htmlspecialchars($livre_id); ?>">
    <input type="hidden" name="utilisateur_id" value="<?php echo htmlspecialchars($_SESSION['utilisateur_id']); ?>">
    <textarea name="contenu" required></textarea>
    <button type="submit">Ajouter Commentaire</button>
</form>
