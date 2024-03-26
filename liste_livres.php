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

    public function getListeLivres()
    {
        $query = "SELECT id, titre, auteur, annee_publication FROM livres";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }
}

$livre = new Livre($connection);
$liste_livres = $livre->getListeLivres();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Livres</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<h1>Liste des Livres</h1>

<table>
    <thead>
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Année de publication</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($liste_livres as $livre) : ?>
        <tr>
            <td><a href="details_livre.php?id=<?php echo $livre['id']; ?>"><?php echo $livre['titre']; ?></a></td>
            <td><?php echo $livre['auteur']; ?></td>
            <td><?php echo $livre['annee_publication']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php" class="button">Retour</a>

<!-- Reste du contenu de la page -->
</body>

</html>