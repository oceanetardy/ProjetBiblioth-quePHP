<?php
class Livre
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function ajouterLivre($titre, $auteurId, $anneePublication, $description, $utilisateurId, $categorieId) {
        $query = "INSERT INTO livres (titre, auteur_id, annee_publication, description, utilisateur_id, categorie_id) VALUES (:titre, :auteurId, :anneePublication, :description, :utilisateurId, :categorieId)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':titre', $titre, PDO::PARAM_STR);
        $statement->bindParam(':auteurId', $auteurId, PDO::PARAM_INT);
        $statement->bindParam(':anneePublication', $anneePublication, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $statement->bindParam(':categorieId', $categorieId, PDO::PARAM_INT);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    public function getDetailsLivre($livreId)
    {
        $query = "SELECT l.*, a.nom, a.prenom, ca.libelle FROM livres l
              INNER JOIN auteurs a ON l.auteur_id = a.id
              INNER JOIN categories ca ON ca.id = l.categorie_id
              WHERE l.id = :livreId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':livreId', $livreId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function getLivresUtilisateur($utilisateurId)
    {
        $query = "SELECT livres.*, auteurs.nom AS nom_auteur, auteurs.prenom AS prenom_auteur, categories.id AS categorie_id, categories.libelle AS categorie_libelle
              FROM livres
              INNER JOIN auteurs ON livres.auteur_id = auteurs.id
              INNER JOIN categories ON livres.categorie_id = categories.id
              WHERE livres.utilisateur_id = :utilisateurId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getAllLivres()
    {
        $query = "SELECT l.*, a.nom, a.prenom, cat.id AS categorie_id, cat.libelle AS categorie_libelle FROM livres l
              INNER JOIN auteurs a ON l.auteur_id = a.id
              INNER JOIN categories cat ON l.categorie_id = cat.id";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function rechercherLivres($recherche) {
        $query = "SELECT livres.*, auteurs.nom, auteurs.prenom, categories.libelle 
                  FROM livres              
                  INNER JOIN auteurs ON livres.auteur_id = auteurs.id
                  INNER JOIN categories ON livres.categorie_id = categories.id
                  WHERE titre LIKE :recherche 
                  OR auteurs.nom LIKE :recherche 
                  OR auteurs.prenom LIKE :recherche";
        $statement = $this->connection->prepare($query);
        $recherche = '%' . $recherche . '%';
        $statement->bindParam(':recherche', $recherche, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getCommentairesLivre($livreId)
    {
        $query = "SELECT * FROM commentaires c
                INNER JOIN utilisateurs u ON u.id = c.utilisateur_id
            WHERE livre_id = :livreId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':livreId', $livreId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
