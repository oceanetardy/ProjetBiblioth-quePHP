<?php

class Utilisateur
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Récupère un utilisateur par son ID
    public function getUtilisateurById($utilisateurId) {
        $query = "SELECT id, nom_utilisateur, email, role FROM utilisateurs WHERE id = :utilisateurId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // Récupère un utilisateur par son email
    public function getUtilisateurByEmail($email)
    {
        $query = "SELECT id, mot_de_passe, role FROM utilisateurs WHERE email = :email";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC); // Fetch as associative array for password and role
    }

    // Enregistre un utilisateur avec mot de passe haché
    public function enregistrerUtilisateur($nom_utilisateur, $email, $mot_de_passe, $role = 'user')
    {
        // Hachage du mot de passe
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Requête d'insertion de l'utilisateur avec le mot de passe haché
        $query = "INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe, role) VALUES (:nom_utilisateur, :email, :mot_de_passe, :role)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':mot_de_passe', $hashedPassword, PDO::PARAM_STR);
        $statement->bindParam(':role', $role, PDO::PARAM_STR);

        return $statement->execute();
    }

    // Vérifie les informations d'identification
    public function authenticate($email, $mot_de_passe) {
        $user = $this->getUtilisateurByEmail($email);

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user; // Renvoyer les informations de l'utilisateur (y compris le rôle)
        }

        return false;
    }
}
?>
