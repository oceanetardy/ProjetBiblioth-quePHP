<?php
require_once 'config.php';

class Commentaire {
    private $id;
    private $livre_id;
    private $utilisateur_id;
    private $contenu;
    private $connection;

    public function __construct($connection, $id = null, $livre_id = null, $utilisateur_id = null, $contenu = null) {
        $this->connection = $connection;
        $this->id = $id;
        $this->livre_id = $livre_id;
        $this->utilisateur_id = $utilisateur_id;
        $this->contenu = $contenu;
    }

    public function add() {
        $query = "INSERT INTO commentaires (livre_id, utilisateur_id, contenu) VALUES (?, ?, ?)";
        $statement = $this->connection->prepare($query);
        $statement->execute([$this->livre_id, $this->utilisateur_id, $this->contenu]);
        return $this->connection->lastInsertId(); // Retourne l'ID du commentaire ajouté
    }

    public function update() {
        $query = "UPDATE commentaires SET contenu = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->execute([$this->contenu, $this->id]);
    }

    public function delete() {
        $query = "DELETE FROM commentaires WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }

    public static function fetchAll($connection, $livre_id) {
        $query = "SELECT * FROM commentaires WHERE livre_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$livre_id]);
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Commentaire');
    }


    public static function fetchById($connection, $id) {
        $query = "SELECT * FROM commentaires WHERE id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$id]);
        return $statement->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif
    }

}
?>
