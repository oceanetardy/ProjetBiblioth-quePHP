<?php
require_once './models/Livre.php';
require_once './models/Auteur.php';

class AjouterLivreController {
    private $connection;
    private $livre;
    private $auteur;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->livre = new Livre($connection);
        $this->auteur = new Auteur($connection);
    }

    public function handleAjouterLivre($titre, $nomAuteur, $prenomAuteur, $annee_publication, $description, $utilisateurId) {
        if (empty($nomAuteur) || empty($prenomAuteur)) {
            $viewData['message_erreur'] = 'Veuillez saisir le nom et le prénom de l\'auteur.';
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
        $ajoutLivre = $this->livre->ajouterLivre($titre, $auteurId, $annee_publication, $description, $utilisateurId);

        if ($ajoutLivre) {
            // Redirection vers la liste des livres après l'ajout réussi
            header('Location: index.php');
            exit();
        } else {
            $viewData['message_erreur'] = 'Erreur lors de l\'ajout du livre.';
        }
    }

    public function getViewData() {
        return [];
    }
}
?>
