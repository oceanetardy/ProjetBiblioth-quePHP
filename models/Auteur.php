<?php
class Auteur
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAuteurById($auteurId)
    {
        $query = "SELECT * FROM auteurs WHERE id = :auteurId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':auteurId', $auteurId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
    public function ajouterAuteur($nom, $prenom)
    {
        $query = "INSERT INTO auteurs (nom, prenom) VALUES (:nom, :prenom)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
        $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    public function getAuteurByNomPrenom($nom, $prenom)
    {
        $query = "SELECT * FROM auteurs WHERE nom = :nom AND prenom = :prenom";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
        $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }




}
