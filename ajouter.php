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

    public function ajouterLivre($titre, $auteur, $annee_publication, $utilisateur_id)
    {
        $query = "INSERT INTO livres (titre, auteur, annee_publication, utilisateur_id) VALUES (:titre, :auteur, :annee_publication, :utilisateur_id)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':titre', $titre, PDO::PARAM_STR);
        $statement->bindParam(':auteur', $auteur, PDO::PARAM_STR);
        $statement->bindParam(':annee_publication', $annee_publication, PDO::PARAM_INT);
        $statement->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $statement->execute();
    }
}

$livre = new Livre($connection);

// Récupérer l'ID de l'utilisateur connecté
$utilisateur_id = $_SESSION['utilisateur_id'];

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $annee_publication = $_POST['annee_publication'];

    // Ajouter le nouveau livre dans la base de données avec l'ID de l'utilisateur connecté
    $livre->ajouterLivre($titre, $auteur, $annee_publication, $utilisateur_id);

    // Rediriger vers la page principale après l'ajout du livre
    header('Location: index.php');
    exit();
}

?>

<h1>Ajouter un livre</h1>

<form method="post" action="ajouter.php">
    <label for="titre">Titre :</label>
    <input type="text" name="titre" id="titre" required>

    <label for="auteur">Auteur :</label>
    <input type="text" name="auteur" id="auteur" required>

    <label for="annee_publication">Année de publication :</label>
    <input type="number" name="annee_publication" id="annee_publication" required>

    <button type="submit">Ajouter</button>
</form>
<a href="index.php" class="button">Retour à l'accueil</a>