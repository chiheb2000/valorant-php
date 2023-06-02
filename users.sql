-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 02 juin 2023 à 13:43
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `users`
--

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_produit` int(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `somme` int(100) NOT NULL,
  `date_commande` datetime NOT NULL,
  `etat` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `id_user`, `id_produit`, `location`, `quantity`, `somme`, `date_commande`, `etat`) VALUES
(58, 2, 6, 'paris', 1, 25, '2023-05-09 12:46:55', 2),
(61, 4, 6, 'msaken', 2, 40, '2023-05-11 22:31:29', 2),
(63, 2, 12, 'sahloul', 5, 200, '2023-05-09 11:00:42', 2),
(66, 5, 11, 'sfax', 10, 400, '2023-05-11 13:09:34', 2),
(70, 2, 6, 'souuse', 1, 25, '2023-05-09 16:16:47', 2),
(73, 2, 17, 'tunis', 1, 250, '2023-05-09 15:06:43', 2),
(75, 6, 18, 'zarmdine', 2, 300, '2023-05-12 16:24:22', 2),
(76, 2, 11, 'sahloul', 1, 50, '2023-05-09 18:13:10', 2),
(81, 3, 13, 'tunis', 2, 160, '2023-05-13 21:44:29', 2),
(88, 2, 9, 'tunis', 5, 125, '2023-05-14 13:11:00', 2),
(89, 4, 8, 'sfax', 10, 80, '2023-05-07 00:00:00', 2),
(90, 2, 15, 'Paris', 5, 150, '2023-05-12 13:11:14', 2),
(99, 2, 27, 'souuse', 3, 75, '2023-05-14 13:25:54', 2),
(112, 2, 8, 'sahloul', 10, 80, '2023-05-13 11:22:53', 2),
(115, 2, 6, 'msaken', 5, 150, '2023-05-15 12:39:50', 2),
(128, 2, 8, 'sfax', 2, 16, '2023-05-15 11:48:42', 2),
(129, 8, 16, 'msaken', 1, 250, '2023-05-17 11:41:58', 2),
(130, 3, 35, 'sahloul', 5, 150, '2023-05-17 17:10:07', 2),
(133, 2, 8, 'sfax', 5, 40, '2023-05-15 18:55:32', 2),
(134, 2, 9, 'sahloul', 5, 125, '2023-05-16 18:19:10', 2),
(135, 3, 15, 'sfax', 10, 300, '2023-05-23 23:41:11', 1),
(138, 2, 8, 'msaken', 5, 40, '2023-05-19 17:58:31', 2),
(141, 6, 12, 'Zarmdine', 2, 80, '2023-05-19 19:55:01', 2),
(151, 3, 27, 'sahloul', 1, 25, '2023-05-20 11:07:58', 2),
(153, 9, 18, 'Moknin', 1, 150, '2023-05-20 11:17:09', 2),
(154, 9, 17, 'sahloul', 1, 250, '2023-05-25 22:00:56', 1),
(155, 5, 14, 'Khzema', 5, 150, '2023-05-20 23:56:57', 2),
(156, 4, 23, 'msaken', 1, 30, '2023-05-20 23:58:01', 1),
(157, 2, 24, 'sahloul', 1, 10, '2023-05-25 21:59:34', 1),
(159, 3, 14, 'sahloul', 1, 30, '2023-05-25 21:59:51', 1),
(161, 2, 8, 'msaken', 50, 320, '2023-05-21 10:59:20', 2),
(163, 2, 6, 'msaken', 1, 50, '2023-05-25 21:05:21', 2);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(50) NOT NULL,
  `nom_produit` varchar(100) NOT NULL,
  `prix` int(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom_produit`, `prix`, `img`, `stock`) VALUES
(6, 'Jett Statue', 35, 'produit/2022_Promos_Jett-Statue_Ecomm_image_12.png', 44),
(8, 'Valorant Keychain', 8, 'produit/il_794xN.4760791654_nmyd.jpg', 28),
(9, 'Gamer Coffee Mug', 25, 'produit/il_794xN.4405979260_2s9i.jpg', 45),
(11, 'helmet holder ', 50, 'produit/il_794xN.4813854845_cese.avif', 50),
(12, 'Valorant Hoodie', 40, 'produit/il_794xN.4495795940_q2d8.jpg', 52),
(13, 'Acrylic LED Light', 80, 'produit/il_794xN.4464789593_236k.avif', 48),
(14, 'Hats and beanies', 30, 'produit/il_794xN.3885982634_f2ga.avif', 14),
(15, 'Keycaps_Neon', 30, 'produit/il_794xN.4291475628_6coy.avif', 11),
(16, 'Chamber outfit', 250, 'produit/il_794xN.3964188245_nfmt.jpg', 30),
(17, 'Jett Outfit', 250, 'produit/il_794xN.4848284012_qgam.jpg', 19),
(18, 'Valorant Chairs', 150, 'produit/valorant-collab-chair.png', 47),
(23, 'Phoenix Statue', 30, 'produit/2022_Promos_Phoenix-Statue_Ecomm_image_10.png', 29),
(24, 'Jett_Mousepad', 10, 'produit/jett_mousepad_2560x2560_02.png', 99),
(27, 'Case Cover', 25, 'produit/icr,iphone_14_tough,back,a,x600-pad,600x600,f8f8f8.u1.jpg', 26),
(35, 'RGB_Mousepad', 30, 'produit/il_794xN.4434864532_ghsg.jpg', 45);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `tel` int(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `pass`, `tel`, `role`) VALUES
(1, 'admin', 'chiheb', 'admin@gmail.com', 'admin', 21228784, 'admin'),
(2, 'baya chatti', 'chiheb', 'chattichiheb35@gmail.com', '1Azerty*', 21228784, 'user'),
(3, 'achoura123', 'ahmzd', 'karmous@gmail.com', 'ahmed', 25896478, 'user'),
(4, 'baya', 'chiheb', 'chiheb@gmail.com', '1Azerty*', 23256981, 'user'),
(5, 'zorgati', 'amine', 'zorgati@gmail.com', '1Azerty*', 23256987, 'user'),
(6, 'haded', 'chema', 'chema@gmail.com', '1Azerty*', 99140599, 'user'),
(7, 'matoug', 'mahdi', 'mahdi@gmail.com', '1Chichi*', 21221878, 'user'),
(8, 'Chatti', 'Chichi', 'chichi@gmail.com', '1Chichi*', 24611837, 'user'),
(9, 'Fish', 'Fachfouch', 'fish@gmail.com', '1Azerty*', 21221879, 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
