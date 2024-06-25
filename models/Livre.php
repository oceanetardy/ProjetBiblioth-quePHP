<?php
class Livre
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function ajouterCommentaire($livreId, $utilisateurId, $contenu)
    {
        $query = "INSERT INTO commentaires (livre_id, utilisateur_id, contenu) VALUES (:livreId, :utilisateurId, :contenu)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':livreId', $livreId, PDO::PARAM_INT);
        $statement->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $statement->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $statement->execute();
    }
    public function getDetailsLivre($livreId)
    {
        $query = "SELECT l.*, a.nom, a.prenom FROM livres l
              INNER JOIN auteurs a ON l.auteur_id = a.id
              WHERE l.id = :livreId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':livreId', $livreId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }


    public function ajouterLivre($titre, $auteurId, $anneePublication, $description, $utilisateurId) {
        $query = "INSERT INTO livres (titre, auteur_id, annee_publication, description, utilisateur_id) VALUES (:titre, :auteurId, :anneePublication, :description, :utilisateurId)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':titre', $titre, PDO::PARAM_STR);
        $statement->bindParam(':auteurId', $auteurId, PDO::PARAM_INT);
        $statement->bindParam(':anneePublication', $anneePublication, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $statement->execute();

        return $this->connection->lastInsertId();
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

    public function rechercherLivres($recherche) {
        $query = "SELECT * , livres.id FROM livres              
    INNER JOIN auteurs ON livres.auteur_id = auteurs.id
 WHERE titre LIKE :recherche OR nom LIKE :recherche OR prenom LIKE :recherche";
        $statement = $this->connection->prepare($query);
        $recherche = '%' . $recherche . '%';
        $statement->bindParam(':recherche', $recherche, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
    public function getLivresUtilisateur($utilisateurId)
    {
        $query = "SELECT livres.*, auteurs.nom AS nom_auteur, auteurs.prenom AS prenom_auteur
              FROM livres
              INNER JOIN auteurs ON livres.auteur_id = auteurs.id
              WHERE livres.utilisateur_id = :utilisateurId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }


    public function getAllLivres()
    {
        $query = "SELECT l.*, a.nom, a.prenom FROM livres l
              INNER JOIN auteurs a ON l.auteur_id = a.id";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }





}
