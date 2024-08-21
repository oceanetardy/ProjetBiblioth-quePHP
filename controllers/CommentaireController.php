<?php
require_once 'models/Commentaire.php';
require_once 'config.php'; // Assurez-vous que cette ligne inclut la connexion PDO

class CommentaireController {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function liste() {
        // Récupère tous les commentaires
        $query = "SELECT * FROM commentaires";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $commentaires = $statement->fetchAll(PDO::FETCH_ASSOC);
        require 'views/liste_commentaires.php'; // Passez les commentaires à la vue
    }

    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $livre_id = $_POST['livre_id'];
            $utilisateur_id = $_POST['utilisateur_id'];
            $contenu = $_POST['contenu'];

            $commentaireObj = new Commentaire($this->connection, null, $livre_id, $utilisateur_id, $contenu);
            $commentaireObj->add();
            header("Location: details_livre.php?id=$livre_id");
            exit(); // Assurez-vous que le script se termine après la redirection
        }
    }

    public function modifier($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contenu = $_POST['contenu'];
            $livre_id = $_POST['livre_id'];

            $commentaireObj = new Commentaire($this->connection, $id, null, null, $contenu);
            $commentaireObj->update();
            header("Location: details_livre.php?id=$livre_id");
            exit(); // Assurez-vous que le script se termine après la redirection
        }
    }

    public function supprimer($id) {
        if (isset($_GET['livre_id'])) {
            $livre_id = $_GET['livre_id'];

            $commentaireObj = new Commentaire($this->connection, $id);
            $commentaireObj->delete();
            header("Location: details_livre.php?id=$livre_id");
            exit(); // Assurez-vous que le script se termine après la redirection
        }
    }
}
?>
