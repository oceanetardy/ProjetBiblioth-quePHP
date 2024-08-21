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
            $contenu = isset($_POST['contenu']) ? $_POST['contenu'] : '';
            $livre_id = isset($_POST['livre_id']) ? intval($_POST['livre_id']) : null;

            if (empty($contenu)) {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => 'Le contenu du commentaire ne peut pas être vide.'
                ];
                header("Location: gestion_commentaire.php?action=modifier&id=$id");
                exit();
            }

            $commentaireObj = new Commentaire($this->connection, $id, null, null, $contenu);
            $commentaireObj->update();

            if ($livre_id) {
                header("Location: details_livre.php?id=$livre_id");
            } else {
                header("Location: gestion_commentaire.php?action=liste");
            }
            exit();
        } else {
            // Pour les requêtes GET, récupérez les détails du commentaire pour les afficher
            $commentaire = Commentaire::fetchById($this->connection, $id);
            require 'views/modifier_commentaire.php';
        }
    }



    public function supprimer($id) {
        if ($id) {
            $commentaireObj = new Commentaire($this->connection, $id);
            $commentaireObj->delete();
            // Redirigez vers la page de liste des commentaires ou une autre page pertinente
            header("Location: gestion_commentaire.php?action=liste");
            exit(); // Assurez-vous que le script se termine après la redirection
        } else {
            // Gérer le cas où l'ID est manquant
            echo "Erreur : L'ID du commentaire est manquant.";
        }
    }


}
?>
