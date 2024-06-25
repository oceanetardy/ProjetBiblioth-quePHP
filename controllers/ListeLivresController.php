<?php
class ListeLivresController {
    private $connection;
    private $livre;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->livre = new Livre($connection);
    }

    public function getListeLivres() {
        return $this->livre->getListeLivres();
    }

    public function getViewData() {
        $livres = $this->getListeLivres();
        return ['livres' => $livres];
    }

    public function afficherListeLivres() {
        // Récupération de la liste de tous les livres
        $listeLivres = $this->livre->getListeLivres();

        // Affichage de la vue avec les données
        include 'views/liste_livres.php';
    }
}

