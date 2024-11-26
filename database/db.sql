-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage des données de la table share_my_links.admin_user : ~1 rows (environ)
INSERT INTO `admin_user` (`id_admin`, `login_admin`, `password_admin`) VALUES
	(3, 'WhiteWolf', '$2y$10$S1MR4AP59GCWBqy72TD/Y.CcPltZOB5nF/BD828EIIJO.O8TPHL22');

-- Listage des données de la table share_my_links.link : ~5 rows (environ)
INSERT INTO `link` (`id_link`, `url_link`, `titre_link`, `description_link`, `date_link`) VALUES
	(1, 'https://piccalil.li/blog/how-i-build-a-button-component/?ref=dailydev', 'How I build a button component', 'Did you know that you can layer CSS gradients on top of each other? <br/>I first started playing with the concept when checking out this tool for making mesh gradients.', '2024-10-10'),
	(11, 'https://dev.to/keshav___dev/docker-cheat-sheet-for-beginners-18mo?ref=dailydev', 'Docker Cheat-sheet for beginners', 'Comprehensive cheat sheet for beginners to master essential Docker commands.', '2024-10-11'),
	(13, 'https://michaelnthiessen.com/create-beautiful-pdfs-with-html-css-and-markdown?ref=dailydev', 'Create Beautiful PDFs with HTML, CSS, and Markdown', 'I built an easy-to-use tool that lets me use just HTML, CSS, and Markdown to create beautiful ebooks and PDFs.', '2024-10-11'),
	(14, 'https://cassidoo.co/post/layer-css-gradients/?ref=dailydev', 'Layering CSS gradients', 'Did you know that you can layer CSS gradients on top of each other? <br />I first started playing with the concept when checking out this tool for making mesh gradients.', '2024-10-11'),
	(15, 'https://dev.to/msnmongare/best-practices-for-naming-api-endpoints-2n5o?ref=dailydev', 'Best Practices for Naming API Endpoints', '', '2024-10-12');

-- Listage des données de la table share_my_links.link_comment : ~5 rows (environ)
INSERT INTO `link_comment` (`id_comment`, `login_comment`, `commentaire`, `date_comment`, `heure_comment`, `id_link`) VALUES
	(1, 'Charles', 'Bookmarked! This was fantastic', '2024-10-10', '09:57:17', 1),
	(2, 'Jhon', 'It’s… Awesome, I will save this resource. I found it very useful, and the idea of use data attributes is great! 👍', '2024-10-10', '09:57:18', 1),
	(3, 'Jess', 'Great snippet, thanks :) It would be nice if there was just an icon without any text', '2024-10-10', '09:57:19', 1),
	(4, 'Patrick', 'Simple and nice. I would never have thought of implementing this effect in this way. Thank you.', '2024-10-13', '14:40:42', 14),
	(5, 'RemiTiab', 'Very cool ! thanks', '2024-10-13', '14:44:55', 14);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
