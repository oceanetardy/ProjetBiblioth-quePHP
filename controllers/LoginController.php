<?php
require_once 'models/Utilisateur.php';

class LoginController
{
    private $connection;
    private $utilisateur;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->utilisateur = new Utilisateur($connection);
    }

    public function handleLogin($email, $mot_de_passe)
    {
        $utilisateur = $this->utilisateur->getUtilisateurByEmail($email);

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Connexion réussie!'
            ];
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Email ou mot de passe incorrect.'
            ];
            header('Location: login.php');
            exit();
        }
    }

    public function getViewData()
    {
        return [];
    }
}
