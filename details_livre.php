<?php
session_start();
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

class Livre
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getDetailsLivre($livreId)
    {
        $query = "SELECT titre, auteur, annee_publication, description FROM livres WHERE id = :livreId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':livreId', $livreId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function ajouterCommentaire($livreId, $utilisateurId, $commentaire)
    {
        $query = "INSERT INTO commentaires (livre_id, utilisateur_id, commentaire) VALUES (:livreId, :utilisateurId, :commentaire)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':livreId', $livreId, PDO::PARAM_INT);
        $statement->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $statement->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $statement->execute();
    }

    public function getCommentaires($livreId)
    {
        $query = "SELECT utilisateurs.nom_utilisateur, commentaires.commentaire FROM commentaires INNER JOIN utilisateurs ON commentaires.utilisateur_id = utilisateurs.id WHERE commentaires.livre_id = :livreId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':livreId', $livreId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: liste_livres.php');
    exit();
}

$livreId = $_GET['id'];
$livre = new Livre($connection);
$details_livre = $livre->getDetailsLivre($livreId);

if (!$details_livre) {
    header('Location: liste_livres.php');
    exit();
}

// Gestion de l'ajout de commentaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentaire = $_POST['commentaire'];
    $utilisateurId = $_SESSION['utilisateur_id'];

    $livre->ajouterCommentaire($livreId, $utilisateurId, $commentaire);
    header("Refresh: 0");
}

$commentaires = $livre->getCommentaires($livreId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Livre</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<h1>Détails du Livre</h1>

<h2><?php echo $details_livre['titre']; ?></h2>
<p><strong>Auteur:</strong> <?php echo $details_livre['auteur']; ?></p>
<p><strong>Année de publication:</strong> <?php echo $details_livre['annee_publication']; ?></p>
<p><strong>Description:</strong> <?php echo $details_livre['description']; ?></p>

<h2>Commentaires</h2>
<?php foreach ($commentaires as $commentaire) : ?>
    <p><strong><?php echo $commentaire['nom_utilisateur']; ?>:</strong> <?php echo $commentaire['commentaire']; ?></p>
<?php endforeach; ?>

<h3>Ajouter un commentaire</h3>
<form method="POST" action="details_livre.php?id=<?php echo $livreId; ?>">
    <textarea name="commentaire" rows="4" cols="50" required></textarea><br>
    <button type="submit">Ajouter</button>
</form>

<a href="liste_livres.php" class="button">Retour à la liste des livres</a>

</body>

</html>