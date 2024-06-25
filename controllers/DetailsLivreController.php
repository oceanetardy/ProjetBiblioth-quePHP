<?php
require_once 'models/Livre.php';

class DetailsLivreController {
    private $livre;

    public function __construct($connection) {
        $this->livre = new Livre($connection);
    }
    public function afficherDetailsLivre($livreId) {
        // Récupération des détails du livre
        $livre = $this->livre->getDetailsLivre($livreId);

        if ($livre) {
            // Récupération des commentaires du livre
            $commentaires = $this->livre->getCommentairesLivre($livreId);

            // Affichage de la vue des détails du livre avec les données
            include 'views/details_livre.php';
        } else {
            // Livre non trouvé
            echo 'Aucun livre trouvé.';
        }
    }


    public function handleAjouterCommentaire($livreId, $utilisateurId, $contenu) {
        // Ajout du commentaire dans la base de données
        $this->livre->ajouterCommentaire($livreId, $utilisateurId, $contenu);

        // Redirection vers la page des détails du livre
        header('Location: details_livre.php?livreId=' . $livreId);
        exit();
    }


}
