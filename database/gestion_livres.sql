-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2024 at 07:36 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_livres`
--

-- --------------------------------------------------------

--
-- Table structure for table `auteurs`
--

CREATE TABLE `auteurs` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auteurs`
--

INSERT INTO `auteurs` (`id`, `nom`, `prenom`) VALUES
(5, 'ANTOINE', 'Henry'),
(4, 'HUGO', 'Victor'),
(6, 'BEAUDELAIRE', 'Charles'),
(7, 'Test', 'Test '),
(8, 'd', 'd'),
(9, 'rrrr', 'rrrr'),
(10, 'Je ne sais pas', 'Je ne sais pas'),
(11, 'Testbvbvvbbvbb', 'Test '),
(12, 'd', 'Victor'),
(13, 'Tardy', 'Oceane'),
(14, 'HUGO', 'test'),
(15, 'Rowling', 'J.K'),
(16, 'CAMUS', 'Albert'),
(17, 'De Saint Exupéry', 'Antoine'),
(18, 'Tolkien', 'J.R.R'),
(19, 'FLAUBERT', 'Gustave'),
(20, 'BRONTE', 'Emilie'),
(21, 'AUSTEN', 'Jane');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `libelle` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `libelle`) VALUES
(1, 'Thriller'),
(2, 'Romance'),
(3, 'Tragédie'),
(4, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int NOT NULL,
  `livre_id` int DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL,
  `contenu` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `livre_id`, `utilisateur_id`, `contenu`) VALUES
(38, 37, 32, 'J\'adore cet auteur ! Son ouvrage est excellent ! '),
(37, 36, 32, 'Magnifique !'),
(36, 41, 32, 'Je recommande aussi !'),
(35, 41, 28, 'Je recommande'),
(34, 41, 28, 'sUPER BEAU LIVRE !\r\n'),
(33, 36, 29, 'Super Bon livre ! Je recommande'),
(39, 37, 29, 'Tout à fait du même avis !');

-- --------------------------------------------------------

--
-- Table structure for table `livres`
--

CREATE TABLE `livres` (
  `id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `annee_publication` int DEFAULT NULL,
  `description` varchar(10000) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL,
  `auteur_id` int DEFAULT NULL,
  `categorie_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `annee_publication`, `description`, `utilisateur_id`, `auteur_id`, `categorie_id`) VALUES
(35, 'Les misérables', 1862, 'Les Misérables est un roman de Victor Hugo publié en 1862, l’un des plus vastes et des plus notables de la littérature du XIX siècle', 28, 4, 3),
(36, 'Harry Potter Tome 1 : Harry Potter à l\'école des sorciers', 2017, 'Le jour de ses onze ans, Harry Potter, un orphelin élevé par un oncle et une tante qui le détestent, voit son existence bouleversée. Un géant vient le chercher pour l\'emmener à Poudlard, une école de sorcellerie ! Voler en balai, jeter des sorts, combattre les trolls : Harry se révèle un sorcier doué. Mais un mystère entoure sa naissance et l\'effroyable V., le mage dont personne n\'ose prononcer le nom.', 28, 15, 4),
(37, 'L\'étranger', 1942, '\"Premier roman d\'Albert Camus, L\'étranger fait partie de la \"trilogie de l\'absurde\" de l\'auteur, qui comprend également un essai et une pièce de théâtre. Situé en l\'Algérie française, le livre fait le portrait de Arthur Meursault, un homme qui vient de perdre sa mère. Sans raison apparente, il abat un arabe sur une plage, et sera condamné à la peine de mort. Albert Camus résuma son livre par la phrase : « Dans notre société tout homme qui ne pleure pas à l\'enterrement de sa mère risque d\'être condamné à mort ». Le film fut adapté au cinéma en 1967 par Luchino Visconti, avec Marcello Mastroianni dans le rôle de Meursault.\"', 29, 16, 4),
(38, 'Le petit prince', 1943, '\"Traduit dans 180 langues et vendu à 80 millions d\'exemplaires, Le petit prince est un texte à part dans l\'œuvre de Saint-Exupéry. Mondialement connu pour ses récits de voyage en tant qu\'aviateur, l\'auteur a créé ici un conte philosophique et poétique universel. Certains y voient une biographie déguisée de l\'auteur. Le texte lui a en effet été inspiré par deux événements personnels : la rencontre d\'un petit garçon blond dans un train, et le crash de son avion dans le désert de Libye. Le texte est paru en France chez Gallimard un an après sa parution aux États-Unis, et connu par la suite de très nombreuses adaptations, dont une en bande-dessinée de Joann Sfar parue en 2008.\"', 32, 17, 4),
(39, 'Le Seigneur des anneaux - Intégrale', 1955, '\"Œuvre majeure de la littérature fantasy, Le seigneur des anneaux est né comme un suite à Bilbo le Hobbit, paru en 1937, pour lequel Tolkien avait promis une suite à son éditeur. Mais les démêlés personnels de l\'auteur et la seconde guerre mondiale repousseront la parution du livre en 1957. De nombreux éditeurs l\'ont refusé à cause de son ampleur (plus de mille pages). En France, les trois tomes du roman paraitront dix-huit ans après sa publication originale. Le monde de la Terre du milieu sera adapté au cinéma en dessin animé par Ralph Bakshi à la fin des années 70, et en trois films \"live\" par Peter Jackson, au début des années 2000.\"', 32, 18, 4),
(40, 'Madame Bovary', 1857, 'TORKAN a mis 8/10 et l\'a mis dans ses coups de cœur.', 32, 19, 1),
(41, 'Les Hauts de Hurle-Vent', 1847, 'Livre d\'emilie Bronte, littérature anglaise.', 29, 20, 2),
(42, 'Orgueil et Préjugés', 1813, 'Orgueil et Préjugés est un roman de la femme de lettres anglaise Jane Austen paru en 1813. Il est considéré comme l\'une de ses œuvres les plus significatives et est aussi la plus connue du grand public.', 29, 21, 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `nom_utilisateur` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom_utilisateur`, `email`, `mot_de_passe`, `role`) VALUES
(1, 'landrzejak0', 'abalding0@opera.com', '$2a$04$1.tuMkR.8Qxwb37xSnH7x.RiO46augrj9jGXP78Tw3qNmXlVJ3yky', 'admin'),
(2, 'hprazer1', 'mrummery1@purevolume.com', '$2a$04$YMt682lfavxYOTDnZ8CMX.RmBTooAr1PH/W.DrzsSRt8KUyMNapYa', 'user'),
(3, 'smackleden2', 'hcran2@canalblog.com', '$2a$04$kewRX.dBsjDvKMlYx9Fjfe0tkA2Tu5MKNV8Qf85orzBSRnMr3nfqS', 'user'),
(4, 'gescolme3', 'nalmey3@nifty.com', '$2a$04$ovV9hGgSZzoRumoy4Oy9setIN6GUi./DV20xCNVnHcjyXzXWR7ESG', 'user'),
(5, 'bleverington4', 'kgeillier4@miibeian.gov.cn', '$2a$04$ELBCfp1O27DqjSsgJ0v8YeXf04QZC2tKEL4EJFh546JbCP8XC6Hdi', 'user'),
(6, 'cfinan5', 'kenevoldsen5@walmart.com', '$2a$04$v3S/ee/1sdNFGSt6kzCfa.VROYiePhjV/xhuijGfn3DZtF/8YkwES', 'user'),
(7, 'foutridge6', 'cpietrzak6@baidu.com', '$2a$04$IP84SSbgJihe3cRvmwvTU.zbCpNHnaVmL5dRl.WHy84o10SlmqemO', 'user'),
(8, 'wfreegard7', 'aphelps7@cyberchimps.com', '$2a$04$XYIUhYkvYW4sK0afI7lcXu9CiHIzhftD4eYJxhi5d7um2cW8FACAu', 'user'),
(9, 'amaccheyne8', 'spearch8@amazon.com', '$2a$04$o2i0zFsuc5tQTjBPV2x6F.3fHFNcXDUibQWD9iM8Oc3BdKBRWimOC', 'user'),
(10, 'apenritt9', 'tquinell9@bbb.org', '$2a$04$vSmird9ORtymWijfQGTuZ.Bo8kAgYgNWrd5f8o2nJRbVNE8RJ.Fm.', 'user'),
(24, 'arewbottomn', 'snapthinen@state.gov', '$2a$04$NODmE7GpYxTao7KfZKW3Ee85kEOut1IzPFoVBHS3GOmQcytxZb57m', 'user'),
(25, 'cspradbrowo', 'ndemitriso@bing.com', '$2a$04$/C4MdKggbTdC9NKHqY1Ty.5AlakD25ynBLRzg6qYBCnTDOsGh.j/2', 'user'),
(26, 'bleallp', 'ppinnionp@imdb.com', '$2a$04$uMZi58Tcl8mS.oDbW7lG6uQjnK9VVFRPfJiRl6aGKsFZ6.B1MbAka', 'user'),
(27, 'gadamowiczq', 'cguiteq@ucoz.ru', '$2a$04$r7xGYdvSZpeHTcc4.xOagu/inO0NN6l8dgwGXH5AYIl9/abAv.r7S', 'user'),
(28, 'Admin', 'admin@admin.com', '$2y$10$8iOEC4z3wJvXFiYHTmdPVOazEZ6miHSlkmL7SADtt12NPOHwJcm1.', 'admin'),
(29, 'user', 'user@user.com', '$2y$10$YWTCTuVT2T9oAvqY8piWguAcm2MjFFJJSEocn8agvsOOWpAP.Zmyi', 'user'),
(30, 'ehenry', 'ehenry@gmail.com', '$2y$10$30mTESzcdRPQidZ7mpLaAuo5uIuXRdx3I5EKUHTHuUn37SxTzmUDu', 'user'),
(31, 'badpass', 'badpass@gmail.com', '$2y$10$4mZnvZNska07GZ8I6WCyDeDveMDRx/OnwK5CKmMbefzsgU2qrhk5.', 'user'),
(32, 'User 2', 'user2@user.com', '$2y$10$kdC6GCK1Rgdolih0LphsFO0wTYXWyAyeVebfEZNYv8zrhMfO6uP/q', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livre_id` (`livre_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Indexes for table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_utilisateur` (`utilisateur_id`),
  ADD KEY `auteur_id` (`auteur_id`),
  ADD KEY `categorie_id` (`categorie_id`) USING BTREE;

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
