<?php
require_once 'models/Utilisateur.php';
require_once 'models/Livre.php';

class ListeLivresUtilisateurController {
    private $connection;
    private $utilisateur;
    private $livre;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->utilisateur = new Utilisateur($connection);
        $this->livre = new Livre($connection);
    }

    public function getListeLivresUtilisateur($utilisateurId) {
        return $this->livre->getListeLivresUtilisateur($utilisateurId);
    }

    public function getViewData() {
        $utilisateurId = $_SESSION['utilisateur_id'];
        $utilisateur = $this->utilisateur->getUtilisateurById($utilisateurId);
        $livres = $this->getListeLivresUtilisateur($utilisateurId);

        return [
            'utilisateur' => $utilisateur,
            'livres' => $livres
        ];
    }

    public function afficherListeLivresUtilisateur() {
        // Récupération de l'ID de l'utilisateur connecté
        $utilisateurId = $_SESSION['utilisateur_id'];

        // Récupération de la liste des livres de l'utilisateur
        $listeLivresUtilisateur = $this->getListeLivresUtilisateur($utilisateurId);

        // Affichage de la vue avec les données
        include 'views/liste_livres_utilisateurs.php';
    }
}

