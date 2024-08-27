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


    public function ajouterLivre($titre, $auteurId, $anneePublication, $description, $utilisateurId, $categorieId)
    {
        $query = "INSERT INTO livres (titre, auteur_id, annee_publication, description, utilisateur_id, categorie_id) 
                  VALUES (:titre, :auteurId, :anneePublication, :description, :utilisateurId, :categorieId)";
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

    public function modifierLivre($id, $titre, $auteurId, $anneePublication, $description, $categorieId)
    {
        $query = "UPDATE livres 
                  SET titre = :titre, auteur_id = :auteurId, annee_publication = :anneePublication, 
                      description = :description, categorie_id = :categorieId 
                  WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':titre', $titre, PDO::PARAM_STR);
        $statement->bindParam(':auteurId', $auteurId, PDO::PARAM_INT);
        $statement->bindParam(':anneePublication', $anneePublication, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':categorieId', $categorieId, PDO::PARAM_INT);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getDetailsLivre($livreId)
    {
        $query = "SELECT l.*, a.nom, a.prenom, ca.libelle AS categorie_libelle 
                  FROM livres l
                  INNER JOIN auteurs a ON l.auteur_id = a.id
                  INNER JOIN categories ca ON ca.id = l.categorie_id
                  WHERE l.id = :livreId";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':livreId', $livreId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllLivres()
    {
        $query = "SELECT l.id, l.titre, a.nom AS nom_auteur, a.prenom AS prenom_auteur, l.annee_publication, 
                     l.description, cat.libelle AS categorie_libelle
              FROM livres l
              INNER JOIN auteurs a ON l.auteur_id = a.id
              INNER JOIN categories cat ON l.categorie_id = cat.id";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $query = "DELETE FROM livres WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        return $statement->execute();
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


    public function rechercherLivres($recherche, $categorieId = null)
    {
        // Sécuriser la recherche en utilisant des wildcards pour le LIKE
        $recherche = '%' . $recherche . '%';

        // Construire la requête SQL avec un filtre de catégorie optionnel
        $query = "SELECT l.id, l.titre, a.nom AS nom, a.prenom AS prenom, l.annee_publication, 
                         l.description, cat.libelle AS categorie_libelle
                  FROM livres l
                  INNER JOIN auteurs a ON l.auteur_id = a.id
                  INNER JOIN categories cat ON l.categorie_id = cat.id
                  WHERE (l.titre LIKE :recherche
                     OR a.nom LIKE :recherche
                     OR a.prenom LIKE :recherche)";

        if ($categorieId) {
            $query .= " AND l.categorie_id = :categorieId";
        }

        $statement = $this->connection->prepare($query);
        $statement->bindParam(':recherche', $recherche, PDO::PARAM_STR);

        if ($categorieId) {
            $statement->bindParam(':categorieId', $categorieId, PDO::PARAM_INT);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>
