<?php
require_once 'models/Livre.php';

class RechercheLivresController {
    private $connection;
    private $livre;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->livre = new Livre($connection);
    }

    public function rechercherLivres($recherche, $categorie = null) {
        $resultats = $this->livre->rechercherLivres($recherche, $categorie);

        return $resultats;
    }

}
