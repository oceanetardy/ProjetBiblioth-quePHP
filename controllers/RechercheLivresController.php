<?php
require_once 'models/Livre.php';

class RechercheLivresController {
    private $connection;
    private $livre;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->livre = new Livre($connection);
    }

    public function rechercherLivres($recherche) {
        // Effectuer la recherche des livres par titre ou auteur
        $resultats = $this->livre->rechercherLivres($recherche);

        return $resultats;
    }

}
