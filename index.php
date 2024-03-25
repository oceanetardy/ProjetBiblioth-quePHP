<?php
session_start();
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

class Utilisateur
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getUtilisateur($utilisateurId)
    {
        $query = "SELECT nom_utilisateur, email FROM utilisateurs WHERE id = :utilisateurId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}

class Livre
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function rechercherLivres($searchTerm)
    {
        $query = "SELECT titre, auteur, annee_publication FROM livres WHERE titre LIKE :searchTerm OR auteur LIKE :searchTerm";
        $statement = $this->connection->prepare($query);
        $searchTerm = '%' . $searchTerm . '%';
        $statement->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
}

$utilisateur = new Utilisateur($connection);

// Récupérer l'ID de l'utilisateur connecté
$utilisateur_id = $_SESSION['utilisateur_id'];

// Récupérer les informations de l'utilisateur connecté
$infos_utilisateur = $utilisateur->getUtilisateur($utilisateur_id);

// Message de bienvenue
$message_bienvenue = 'Bienvenue, ' . $infos_utilisateur['nom_utilisateur'] . '!';

// Traitement du formulaire de recherche
$livres = [];
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $livre = new Livre($connection);
    $livres = $livre->rechercherLivres($searchTerm);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<h1>Accueil</h1>
<p><?php echo $message_bienvenue; ?></p>

<form method="GET" action="index.php">
    <input type="text" name="search" placeholder="Rechercher par titre ou auteur...">
    <button type="submit">Rechercher</button>
</form>

<?php if (count($livres) > 0) : ?>
    <h2>Résultats de la recherche :</h2>
    <ul>
        <?php foreach ($livres as $livre) : ?>
            <li><?php echo $livre['titre']; ?> par <?php echo $livre['auteur']; ?> (<?php echo $livre['annee_publication']; ?>)</li>
        <?php endforeach; ?>
    </ul>
<?php elseif (isset($_GET['search'])) : ?>
    <p>Aucun livre trouvé pour cette recherche.</p>
<?php endif; ?>

<a href="ajouter.php" class="button">Ajouter un livre</a>
<a href="liste_livres_utilisateur.php" class="button">Voir mes livres</a>
<a href="liste_livres.php" class="button">Voir tous les livres</a>
<a href="logout.php" class="button">Déconnexion</a>

<!-- Reste du contenu de la page -->
</body>

</html>