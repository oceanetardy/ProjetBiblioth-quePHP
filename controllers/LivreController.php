<?php
require_once 'models/Livre.php';
require_once 'models/Auteur.php';
require_once 'models/Categorie.php';

require_once 'models/Livre.php';
require_once 'models/Auteur.php';
require_once 'models/Categorie.php';

class LivreController {
    private $connection;
    private $livre;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->livre = new Livre($connection);
    }

    public function liste() {
        // Récupère tous les livres
        $livres = $this->livre->getAllLivres();
        require 'views/liste_livres_admin.php'; // Passez les livres à la vue
    }

    public function modifier($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $nomAuteur = $_POST['nomAuteur'];
            $prenomAuteur = $_POST['prenomAuteur'];
            $annee_publication = $_POST['annee_publication'];
            $description = $_POST['description'];
            $categorieId = $_POST['categorie_id'];

            if (empty($titre) || empty($nomAuteur) || empty($prenomAuteur)) {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => 'Veuillez remplir tous les champs.'
                ];
                header("Location: gestion_livre.php?action=modifier&id=$id");
                exit();
            }

            $auteur = new Auteur($this->connection);
            $auteurExiste = $auteur->getAuteurByNomPrenom($nomAuteur, $prenomAuteur);
            $auteurId = $auteurExiste ? $auteurExiste['id'] : $auteur->ajouterAuteur($nomAuteur, $prenomAuteur);

            $livreObj = new Livre($this->connection);
            $livreObj->modifierLivre($id, $titre, $auteurId, $annee_publication, $description, $categorieId);

            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Livre modifié avec succès!'
            ];
            header("Location: gestion_livre.php?action=liste");
            exit();
        } else {
            // Pour les requêtes GET, récupérez les détails du livre pour les afficher
            $livre = $this->livre->getDetailsLivre($id);
            require 'views/modifier_livre.php';
        }
    }

    public function supprimer($id) {
        if ($id) {
            $livreObj = new Livre($this->connection);
            if ($livreObj->delete($id)) {
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Livre supprimé avec succès!'
                ];
            } else {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => 'Erreur lors de la suppression du livre.'
                ];
            }
            header("Location: gestion_livre.php?action=liste");
            exit();
        } else {
            // Gérer le cas où l'ID est manquant
            echo "Erreur : L'ID du livre est manquant.";
        }
    }

    public function details($id) {
        $livre = $this->livre->getDetailsLivre($id);
        require '../views/details_livre.php'; // Affiche les détails du livre
    }
}
?>
