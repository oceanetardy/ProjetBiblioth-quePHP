<?php
require_once 'models/Livre.php';
require_once 'models/Auteur.php';
require_once 'models/Categorie.php';

class LivreController {
    private $connection;
    private $livre;
    private $categorie;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->livre = new Livre($connection);
        $this->categorie = new Categorie($connection);
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

            try {
                $this->livre->modifierLivre($id, $titre, $auteurId, $annee_publication, $description, $categorieId);

                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Livre modifié avec succès!'
                ];
                header("Location: gestion_livre.php?action=liste");
                exit();
            } catch (PDOException $e) {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => 'Erreur lors de la modification du livre : ' . $e->getMessage()
                ];
                header("Location: gestion_livre.php?action=modifier&id=$id");
                exit();
            }
        } else {
            // Pour les requêtes GET, récupérez les détails du livre pour les afficher
            $livre = $this->livre->getDetailsLivre($id);
            $categories = $this->categorie->getAllCategories(); // Récupère toutes les catégories
            require 'views/modifier_livre.php';
        }
    }

    public function supprimer($id) {
        if ($id) {
            if ($this->livre->delete($id)) {
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
            echo "Erreur : L'ID du livre est manquant.";
        }
    }

    public function details($id) {
        $livre = $this->livre->getDetailsLivre($id);
        require 'views/details_livre.php'; // Affiche les détails du livre
    }
}
?>
