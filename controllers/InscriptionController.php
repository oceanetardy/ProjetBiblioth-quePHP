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

    public function inscrire($nom_utilisateur, $email, $mot_de_passe)
    {
        // Vérifiez si l'email existe déjà
        $utilisateurExist = $this->utilisateur->getUtilisateurByEmail($email);

        if ($utilisateurExist) {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Cet email est déjà utilisé.'
            ];
            header('Location: inscription.php');
            exit();
        } else {
            // Définir le rôle par défaut à 'user'
            $role = 'user';

            // Enregistrez l'utilisateur avec mot de passe haché et rôle par défaut
            $enregistrementReussi = $this->utilisateur->enregistrerUtilisateur($nom_utilisateur, $email, $mot_de_passe, $role);

            if ($enregistrementReussi) {
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Votre compte a été créé avec succès !'
                ];
                header('Location: login.php'); // Redirection vers la page de connexion
            } else {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.'
                ];
                header('Location: inscription.php');
            }
            exit();
        }
    }

    public function getViewData()
    {
        return [];
    }
}
?>
