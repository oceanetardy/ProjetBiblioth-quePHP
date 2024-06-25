
# Bibliothèque 2.0

Ce projet de Bibliothèque 2.0 a été développé avec Wamp Server.
## Description

Ce projet permet de gérer une collection de livres enregistrés dans une base de données. Il faut être connecté pour avoir accès à toutes les fonctionnalités.


Il offre les fonctionnalités suivantes :

- Système de connexion et d'inscription
- Afficher la liste de tous les livres enregistrés en base
- Afficher les livres d'un utilisateur
- Afficher les détails d'un livre spécifique (Titre, Année de publication, Auteur, Descriptiion, Commentaires publiés)
- Pouvoir laisser un commentaire sur la page d'un livre
- Ajouter un livre (lors de l'ajout, le livre est relié à l'utilisateur connecté)
- Moteur de recherche en recherchant par titre ou auteur

Lors de l'ajout d'un livre, si l'auteur existe déjà, il n'y aura pas de doublon de l'auteur en base.

## Installation

1. Assurez-vous d'avoir installé Wamp Server sur votre machine.
2. Clonez ce dépôt dans le répertoire www de votre installation Wamp Server.
3. Importez la base de données fournie (`gestionlivre.sql`) dans votre système de gestion de base de données (par exemple, phpMyAdmin).
4. Configurez les informations de connexion à la base de données dans le fichier `config.php`.
5. Lancez Wamp Server et accédez au projet via votre navigateur en utilisant l'URL `http://localhost/gestionlivre`.

## Technologies utilisées

- PHP
- MySQL
- HTML
- CSS


