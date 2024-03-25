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

    public function getLivresByUtilisateur($utilisateurId)
    {
        $query = "SELECT titre, auteur, annee_publication 
                  FROM livres 
                  WHERE utilisateur_id = :utilisateurId";

        $statement = $this->connection->prepare($query);
        $statement->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

$livre = new Livre($connection);

// Récupérer l'ID de l'utilisateur connecté
$utilisateur_id = $_SESSION['utilisateur_id'];

// Récupérer les livres de l'utilisateur connecté
$livres = $livre->getLivresByUtilisateur($utilisateur_id);

?>

<h1>Mes livres</h1>

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
<a href="logout.php" class="button">Déconnexion</a>

<!-- Reste du contenu de la page -->