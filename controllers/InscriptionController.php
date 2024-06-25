<?php
require_once 'models/Utilisateur.php';

class InscriptionController {
    private $connection;
    private $utilisateur;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->utilisateur = new Utilisateur($connection);
    }

    public function handleInscription($nom_utilisateur, $email, $mot_de_passe) {
        $utilisateurExist = $this->utilisateur->getUtilisateurByEmail($email);

        if ($utilisateurExist) {
            $viewData['message_erreur'] = 'Cet email est déjà utilisé.';
        } else {
            $this->utilisateur->enregistrerUtilisateur($nom_utilisateur, $email, $mot_de_passe);
            header('Location: index.php');
            exit();
        }
    }

    public function getViewData() {
        return [];
    }
}
