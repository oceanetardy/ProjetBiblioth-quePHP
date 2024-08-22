<?php
require_once '../models/Livre.php';
require_once '../models/Auteur.php';
require_once '../models/Categorie.php';

class AjouterLivreController {
    private $connection;
    private $livre;
    private $auteur;
    private $categorie;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->livre = new Livre($connection);
        $this->auteur = new Auteur($connection);
        $this->categorie = new Categorie($connection);
    }

    public function handleAjouterLivre($titre, $nomAuteur, $prenomAuteur, $annee_publication, $description, $utilisateurId, $categorieId)
    {
        if (empty($nomAuteur) || empty($prenomAuteur)) {
            $_SESSION['message_erreur'] = 'Veuillez saisir le nom et le prénom de l\'auteur.';
            return;
        }

        // Vérifier si l'auteur existe déjà
        $auteurExiste = $this->auteur->getAuteurByNomPrenom($nomAuteur, $prenomAuteur);

        if (empty($auteurExiste)) {
            // L'auteur n'existe pas, on l'ajoute à la table des auteurs
            $auteurId = $this->auteur->ajouterAuteur($nomAuteur, $prenomAuteur);
        } else {
            // L'auteur existe déjà, on récupère son ID
            $auteurId = $auteurExiste['id'];
        }

        // Insertion du livre dans la base de données
        $ajoutLivre = $this->livre->ajouterLivre($titre, $auteurId, $annee_publication, $description, $utilisateurId, $categorieId);

        if ($ajoutLivre) {
            $_SESSION['message_succes'] = 'Livre ajouté avec succès!';
            header('Location: ajouter_livre.php');
            exit();
        } else {
            $_SESSION['message_erreur'] = 'Erreur lors de l\'ajout du livre.';
        }
    }

    public function getViewData() {
        $categories = $this->categorie->getAllCategories();
        return [
            'categories' => $categories
        ];
    }
}
