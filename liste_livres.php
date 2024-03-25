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

    public function getAllLivres()
    {
        $query = "SELECT titre, auteur, annee_publication FROM livres";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }
}

$livre = new Livre($connection);

// Récupérer tous les livres de la base de données
$livres = $livre->getAllLivres();

?>

<h1>Liste de tous les livres</h1>

<?php if (count($livres) > 0) : ?>
    <ul>
        <?php foreach ($livres as $livre) : ?>
            <li><?php echo $livre['titre']; ?> par <?php echo $livre['auteur']; ?> (<?php echo $livre['annee_publication']; ?>)</li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun livre trouvé.</p>
<?php endif; ?>

<a href="ajouter.php" class="button">Ajouter un livre</a>
<a href="index.php" class="button">Retour à l'accueil</a>
<a href="login.php?action=logout" class="button">Déconnexion</a>

<!-- Reste du contenu de la page -->