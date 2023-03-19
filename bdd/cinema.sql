-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 15 mars 2023 à 18:53
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

CREATE TABLE `acteur` (
  `id_acteur` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
(1, 1),
(2, 2),
(3, 4),
(4, 6),
(5, 9);

-- --------------------------------------------------------

--
-- Structure de la table `casting`
--

CREATE TABLE `casting` (
  `id_film` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `casting`
--

INSERT INTO `casting` (`id_film`, `id_role`, `id_acteur`) VALUES
(1, 1, 1),
(1, 2, 2),
(2, 3, 2),
(3, 5, 2),
(4, 6, 2),
(5, 8, 2),
(2, 4, 3),
(4, 7, 4),
(6, 9, 5),
(7, 10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id_film` int(11) NOT NULL,
  `titre_film` varchar(50) NOT NULL,
  `annee_sortie_film` int(4) NOT NULL,
  `duree_film` int(11) NOT NULL,
  `synopsis_film` text,
  `note_film` int(11) NOT NULL,
  `affiche_film` varchar(255) NOT NULL,
  `id_realisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id_film`, `titre_film`, `annee_sortie_film`, `duree_film`, `synopsis_film`, `note_film`, `affiche_film`, `id_realisateur`) VALUES
(1, 'Manhattan ', 1979, 96, 'Scénariste de télévision, Isaac Davis1,2 (Woody Allen) est un homme désabusé et angoissé. À 42 ans, sa vie professionnelle le laisse insatisfait. Aussi passe-t-il le plus clair de son temps à écrire et réécrire son roman. Sa vie privée est plus que chaotique. Sa deuxième épouse (Meryl Streep), qui l’a quitté pour une autre femme, est sur le point de publier son autobiographie où Isaac tient une bonne place. Il fréquente aussi Tracy, une jeune fille de 17 ans (Mariel Hemingway) avec laquelle il ne se voit aucun avenir. La situation se complique lorsque Yale (Michael Murphy), son meilleur ami, lui présente sa maîtresse, Mary (Diane Keaton), dont Isaac ne tarde pas à tomber amoureux.', 3, 'https://fr.web.img6.acsta.net/medias/00/33/51/003351_af.jpg', 1),
(2, 'Kramer contre Kramer ', 1979, 105, 'Le jour même où Ted rentre chez lui porteur d\'une heureuse nouvelle concernant son travail, il apprend que Joanna le quitte en lui laissant la garde de Billy. Ted est alors contraint de concilier ses activités professionnelles avec l\'éducation de son fils. Il doit notamment s\'occuper des tâches ménagères dont, jusqu\'à présent, il laissait la responsabilité à son épouse. Débordé dans les premiers temps, il s\'habitue ensuite à son double rôle d\'employé et d\'homme au foyer. ', 4, 'https://fr.web.img4.acsta.net/medias/nmedia/18/62/87/37/19151171.jpg', 2),
(3, 'A.I. Intelligence artificielle', 2001, 146, 'Dans un monde futuriste ravagé par le réchauffement de la planète et où la procréation est strictement encadrée, les êtres humains vivent en parfaite harmonie avec les « méchas », des robots androïdes spécialement créés pour répondre à leurs besoins : tâches ménagères, services et… amour. Une famille, dont le fils est dans le coma, décide d\'aller plus loin et d\'adopter un enfant robot…', 2, 'https://fr.web.img5.acsta.net/medias/nmedia/00/00/00/64/69216449_af.jpg', 3),
(4, 'Mamma Mia!', 2008, 114, 'Cinq ans après les événements du premier film, sur l\'île grecque Kalokairi. Sophie Sheridan (Amanda Seyfried) prépare la grande réouverture de l\'hôtel de sa mère, Donna (Meryl Streep), un an après le décès de cette dernière (Thank You For The Music). Elle est également poussée à bout de nerfs car deux de ses pères, Harry (Colin Firth) et Bill (Stellan Skarsgård), ne pourront pas venir à la réouverture et sa relation avec Sky (Dominic Cooper), lequel est à New York, connaît de plus en plus de vagues.', 5, 'https://fr.web.img3.acsta.net/medias/nmedia/18/65/61/22/18965700.jpg', 4),
(5, 'Don\'t Look Up', 2021, 143, 'Inspiré par le thème de l\'actuelle crise climatique dont personne ne se soucie vraiment malgré le consensus scientifique, le film évoque la chute prochaine d\'une grande comète qui va complètement ravager la Terre et tuer tous ses habitants, et la difficulté que rencontrent les scientifiques qui l\'ont découverte pour prévenir le monde face à la désinformation, au déni et aux sarcasmes du monde médiatique et politique comme du grand public, ainsi qu\'à la cupidité et à l\'inaction de la présidente des États-Unis sous la coupe du puissant créateur d\'une grande entreprise technologique.', 5, 'https://fr.web.img3.acsta.net/pictures/21/11/16/17/11/5656957.jpg', 5),
(6, 'Black Widow', 2021, 134, 'Après les événements en Allemagne, où elle était aux côtés d\'Iron Man, et bien avant la bataille contre Thanos, Natasha Romanoff est en cavale. Alors qu\'elle s\'est réfugiée en Norvège, elle est attaquée par Taskmaster, qui semble être intéressé par le contenu d\'une mystérieuse valise...', 3, 'https://fr.web.img2.acsta.net/pictures/21/06/30/13/37/5245550.jpg', 6),
(7, 'Le Chat potté 2', 2022, 101, 'Inconscient et téméraire, le Chat Potté ne donne guère d\'importance à ses 9 vies. Mais lorsqu\'il apprend qu\'il ne lui en reste plus qu\'une à vivre, il se lancera dans la quête désespérée d\'une carte magique lui permettant de récupérer ses vies perdues. ', 3, 'https://fr.web.img6.acsta.net/pictures/22/06/16/09/06/2320014.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `libelle_genre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `libelle_genre`) VALUES
(1, 'action'),
(2, 'policier'),
(3, 'romance'),
(4, 'horreur'),
(5, 'famille'),
(6, 'historique'),
(7, 'animation'),
(8, 'enfance'),
(9, 'drame'),
(10, 'comedie'),
(11, 'sience fiction'),
(12, 'musique');

-- --------------------------------------------------------

--
-- Structure de la table `genre_film`
--

CREATE TABLE `genre_film` (
  `id_film` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `genre_film`
--

INSERT INTO `genre_film` (`id_film`, `id_genre`) VALUES
(5, 1),
(6, 1),
(6, 2),
(1, 3),
(3, 5),
(4, 5),
(7, 5),
(7, 7),
(7, 8),
(1, 9),
(2, 9),
(1, 10),
(4, 10),
(5, 10),
(3, 11),
(4, 12);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `id_personne` int(11) NOT NULL,
  `nom_personne` varchar(50) NOT NULL,
  `prenom_personne` varchar(50) NOT NULL,
  `sexe_personne` varchar(6) DEFAULT NULL,
  `date_naissance_personne` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id_personne`, `nom_personne`, `prenom_personne`, `sexe_personne`, `date_naissance_personne`) VALUES
(1, 'Allen', 'Woody', 'homme', '2023-03-15'),
(2, ' Streep', ' Meryl', 'femme', '1949-06-22'),
(3, 'Benton', 'Robert', 'homme', '1932-11-29'),
(4, 'Hoffman', 'Dustin', 'homme', '1973-08-08'),
(5, 'Spielberg', 'Steven', 'homme', '1946-12-18'),
(6, 'Seyfried', 'Amanda', 'femme', '1985-12-03'),
(7, 'Lloyd', 'Phyllida', 'femme', '1957-06-17'),
(8, 'McKay', 'Adam', 'homme', '1968-04-17'),
(9, 'Pugh', 'Florance', 'femme', '1996-01-03'),
(10, 'Shortland', 'Cate', 'femme', '1968-10-11');

-- --------------------------------------------------------

--
-- Structure de la table `realisateur`
--

CREATE TABLE `realisateur` (
  `id_realisateur` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `realisateur`
--

INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
(1, 1),
(2, 3),
(3, 5),
(4, 7),
(5, 8),
(6, 10);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nom_role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `nom_role`) VALUES
(1, 'Isacc Davis'),
(2, 'Jill'),
(3, 'Joanna Kramer'),
(4, 'Ted Kramer'),
(5, 'La fée bleue'),
(6, 'Donna'),
(7, 'Sophie'),
(8, 'Présidente des États-Unis'),
(9, 'Yelena'),
(10, 'Boucle d\'or');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`id_acteur`),
  ADD KEY `id_personne` (`id_personne`);

--
-- Index pour la table `casting`
--
ALTER TABLE `casting`
  ADD PRIMARY KEY (`id_film`,`id_role`,`id_acteur`),
  ADD KEY `id_acteur` (`id_acteur`),
  ADD KEY `id_role` (`id_role`) USING BTREE;

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`),
  ADD KEY `id_realisateur` (`id_realisateur`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Index pour la table `genre_film`
--
ALTER TABLE `genre_film`
  ADD PRIMARY KEY (`id_film`,`id_genre`),
  ADD KEY `id_genre` (`id_genre`) USING BTREE;

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id_personne`);

--
-- Index pour la table `realisateur`
--
ALTER TABLE `realisateur`
  ADD PRIMARY KEY (`id_realisateur`),
  ADD KEY `id_personne` (`id_personne`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteur`
--
ALTER TABLE `acteur`
  MODIFY `id_acteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `id_personne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `realisateur`
--
ALTER TABLE `realisateur`
  MODIFY `id_realisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD CONSTRAINT `acteur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `casting`
--
ALTER TABLE `casting`
  ADD CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `casting_ibfk_3` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `casting_ibfk_4` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `genre_film`
--
ALTER TABLE `genre_film`
  ADD CONSTRAINT `genre_film_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genre_film_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `realisateur`
--
ALTER TABLE `realisateur`
  ADD CONSTRAINT `realisateur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
