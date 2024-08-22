<?php
class Categorie
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM categories";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function ajouterCategorie($libelle)
    {
        $query = "INSERT INTO categories (libelle) VALUES (:libelle)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':libelle', $libelle, PDO::PARAM_STR);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    public function getCategorieById($categorieId)
    {
        $query = "SELECT * FROM categories WHERE id = :categorieId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':categorieId', $categorieId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
