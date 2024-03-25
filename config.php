<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'gestion_livres');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// Classe de gestion de la base de données
class Database
{
    private $host;
    private $name;
    private $user;
    private $password;
    private $connection;

    public function __construct($host, $name, $user, $password)
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
    }

    public function connect()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8mb4";

        try {
            $this->connection = new PDO($dsn, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }

        return $this->connection;
    }

    public function close()
    {
        $this->connection = null;
    }
}

// Création de l'objet Database
$database = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$connection = $database->connect();