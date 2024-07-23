<?php
require_once 'models/Utilisateur.php';

class InscriptionController
{
    private $connection;
    private $utilisateur;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->utilisateur = new Utilisateur($connection);
    }

    public function handleInscription($nom_utilisateur, $email, $mot_de_passe)
    {
        $utilisateurExist = $this->utilisateur->getUtilisateurByEmail($email);

        if ($utilisateurExist) {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Cet email est déjà utilisé.'
            ];
            header('Location: inscription.php');
            exit();
        } else {
            $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            $this->utilisateur->enregistrerUtilisateur($nom_utilisateur, $email, $hashed_password);

            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Votre compte a été créé avec succès !'
            ];
            header('Location: inscription.php');
            exit();
        }
    }

    public function getViewData()
    {
        return [];
    }
}
