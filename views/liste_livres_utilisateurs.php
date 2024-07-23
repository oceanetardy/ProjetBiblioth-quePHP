<?php
session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../models/Livre.php';
require_once '../models/Auteur.php';

$livre = new Livre($connection);
$listeLivres = $livre->getLivresUtilisateur($_SESSION['utilisateur_id']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mes Livres</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #4b2e17;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table a {
            color: #4b2e17;
            text-decoration: none;
        }

        table a:hover {
            text-decoration: underline;
        }

        .button {
            background-color: #8B4513;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-block;
            margin: 10px 0;
        }

        .button:hover {
            background-color: #A0522D;
        }

        .container {
            padding: 20px;
            max-width: 1000px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .container h1 {
            margin-top: 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include '../header.php'; ?>

    <div class="container">
        <h1>Mes Livres</h1>

        <table>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Description</th>
            </tr>
            <?php foreach ($listeLivres as $livre) : ?>
                <tr>
                    <td><a href="../details_livre.php?livreId=<?php echo htmlspecialchars($livre['id']); ?>"><?php echo htmlspecialchars($livre['titre']); ?></a></td>
                    <td><?php echo htmlspecialchars($livre['nom_auteur']) . ' ' . htmlspecialchars($livre['prenom_auteur']); ?></td>
                    <td><?php echo htmlspecialchars($livre['description']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <a href="../ajouter_livre.php" class="button">Ajouter un livre</a>
        <a href="../index.php" class="button">Retour</a>
    </div>

    <?php include '../footer.php'; ?>
</body>

</html>