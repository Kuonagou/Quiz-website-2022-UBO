-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 06 déc. 2022 à 00:10
-- Version du serveur : 10.5.12-MariaDB-0+deb11u1
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `znl3-zgouhiean_2`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`zgouhiean`@`%` PROCEDURE `aff_score` (IN `matid` INT)   BEGIN
set @total =(select SUM(JOU_SCORE) from T_JOUEUR_JOU WHERE MAT_ID=matid);
SELECT afficher_score(@total,matid);
END$$

CREATE DEFINER=`zgouhiean`@`%` PROCEDURE `info_match` ()   BEGIN
set @avenir := (SELECT count(MAT_ID) from T_MATCH_MAT where MAT_DEBUT IS NULL OR MAT_DEBUT>CURRENT_TIMESTAMP);
set @encours := (SELECT count(MAT_ID) from T_MATCH_MAT where MAT_DEBUT IS NOT NULL AND MAT_DEBUT<CURRENT_TIMESTAMP AND ( MAT_FIN>CURRENT_TIMESTAMP OR MAT_FIN IS NULL));
set @fini := (SELECT count(MAT_ID) from T_MATCH_MAT where MAT_FIN IS NOT NULL AND MAT_FIN<CURRENT_TIMESTAMP);
select @avenir as Match_A_Venir, @encours as Match_En_Cours, @fini as Match_Fini;
END$$

CREATE DEFINER=`zgouhiean`@`%` PROCEDURE `insert_act_match` (IN `matchID` INT)   BEGIN
    SET @matchfin := (SELECT MAT_FIN FROM T_MATCH_MAT WHERE MAT_ID=matchID);
    SET @bon := (SELECT @matchfin<CURRENT_TIMESTAMP);
    SET @ok := (SELECT @matchfin IS NOT NULL);
    IF @bon AND @ok THEN 
        SET @quizintitule := (SELECT QUI_INTITULE FROM T_QUIZ_QUI JOIN T_MATCH_MAT using (QUI_ID) WHERE MAT_ID=matchID);
        SET @matchdebut := (SELECT MAT_DEBUT FROM T_MATCH_MAT WHERE MAT_ID=matchID);
        SET @matchparticipant = (SELECT participant(matchID));
        SET @text1=CONCAT('Fin du match sur ',@quizintitule);
        SET @text2=CONCAT('Ce match était ouvert du ',@matchdebut,' au ',@matchfin,@matchparticipant);
        INSERT INTO T_ACTUALITE_ACT VALUES (NULL,@text1,@text2,CURDATE(),1);
    END IF;
END$$

CREATE DEFINER=`zgouhiean`@`%` PROCEDURE `supp_match` (IN `code` TEXT)   BEGIN
DELETE FROM T_JOUEUR_JOU WHERE MAT_ID=id_match(code);
DELETE FROM T_MATCH_MAT WHERE MAT_CODE=code;
END$$

CREATE DEFINER=`zgouhiean`@`%` PROCEDURE `une_question_ses_reponses` (IN `questionid` INT)   BEGIN
 SELECT QUE_ID, QUE_INTITULEQUESTION, REP_REPONSE, REP_ID from Question_réponses WHERE QUE_ID=questionid;
END$$

CREATE DEFINER=`zgouhiean`@`%` PROCEDURE `un_quiz_ses_questions` (IN `quizid` INT)   BEGIN
 SELECT QUI_ID, QUI_INTITULE, QUE_INTITULEQUESTION, QUE_ID from T_QUIZ_QUI  left outer join T_QUESTION_QUE using(QUI_ID) WHERE QUI_ID=quizid;
END$$

--
-- Fonctions
--
CREATE DEFINER=`zgouhiean`@`%` FUNCTION `activer_question` (`questid` INT) RETURNS INT(11)  BEGIN
update T_QUESTION_QUE set QUE_ACTIVE=1 where QUE_ID=questid; 
return questid;
END$$

CREATE DEFINER=`zgouhiean`@`%` FUNCTION `afficher_score` (`total` INT, `id` INT) RETURNS TEXT CHARSET utf8mb4  BEGIN
return concat('Le score total du match ',id,' est de ',total);
END$$

CREATE DEFINER=`zgouhiean`@`%` FUNCTION `désactiver_question` (`questid` INT) RETURNS INT(11)  BEGIN
update T_QUESTION_QUE set QUE_ACTIVE=0 where QUE_ID=questid; 
return questid;
END$$

CREATE DEFINER=`zgouhiean`@`%` FUNCTION `id_match` (`code` VARCHAR(8)) RETURNS INT(11)  BEGIN
set @mat := (SELECT MAT_ID FROM T_MATCH_MAT WHERE MAT_CODE=code);
return @mat;
END$$

CREATE DEFINER=`zgouhiean`@`%` FUNCTION `match_actif` (`code` VARCHAR(8)) RETURNS INT(11)  BEGIN
set @actif := (select MAT_ACTIF from T_MATCH_MAT WHERE MAT_CODE=code);
set @debut := (select MAT_DEBUT from T_MATCH_MAT WHERE MAT_CODE=code);
IF((@debut>NOW() OR @debut is NULL) AND @actif )THEN
    set @actif :=2;
END IF;
return @actif;
END$$

CREATE DEFINER=`zgouhiean`@`%` FUNCTION `nombre_act` (`utilisateurid` INT) RETURNS INT(11)  BEGIN
set @nbnews := (SELECT count(ACT_ID) from T_ACTUALITE_ACT WHERE UTI_IDUTILISATEUR=utilisateurid);
return @nbnews;
END$$

CREATE DEFINER=`zgouhiean`@`%` FUNCTION `NOM_id` (`utilisateurid` INT) RETURNS TEXT CHARSET utf8mb4  BEGIN
set @pseudo := (SELECT UTI_PSEUDO FROM T_UTILISATEUR_UTI WHERE UTI_IDUTILISATEUR=utilisateurid);
return @pseudo;
END$$

CREATE DEFINER=`zgouhiean`@`%` FUNCTION `participant` (`matchid` INT) RETURNS TEXT CHARSET utf8mb4  BEGIN
 SET @joueurs := (select GROUP_CONCAT(JOU_PSEUDO) from T_JOUEUR_JOU where MAT_ID=matchid);
IF (@joueurs IS NULL) THEN
	set @joueurs := " et personne ne l'a testé.";
ELSE
	set @joueurs:= concat(" et les joueurs ",@joueurs," l'on testé.");
END IF;
RETURN @joueurs;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Question_réponses`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Question_réponses` (
`QUE_ID` int(11)
,`QUE_INTITULEQUESTION` varchar(200)
,`REP_ID` int(11)
,`REP_REPONSE` varchar(200)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `Question_réponse_vrai`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `Question_réponse_vrai` (
`QUE_ID` int(11)
,`QUE_INTITULEQUESTION` varchar(200)
,`REP_ID` int(11)
,`REP_REPONSE` varchar(200)
);

-- --------------------------------------------------------

--
-- Structure de la table `T_ACTUALITE_ACT`
--

CREATE TABLE `T_ACTUALITE_ACT` (
  `ACT_ID` int(11) NOT NULL,
  `ACT_TITRE` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ACT_CONTENU` varchar(500) NOT NULL,
  `ACT_NEWDATE` datetime NOT NULL,
  `UTI_IDUTILISATEUR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_ACTUALITE_ACT`
--

INSERT INTO `T_ACTUALITE_ACT` (`ACT_ID`, `ACT_TITRE`, `ACT_CONTENU`, `ACT_NEWDATE`, `UTI_IDUTILISATEUR`) VALUES
(1, 'Nouvelle information', 'Bienvenue, \r\nnotre site sera fonctionnel  dans les deux prochaines semaines ! ', '2022-09-30 12:10:15', 2),
(2, 'Nouveau quiz Rugby Féminin en Préparation', 'Je suis actuellement en préparation d\'un nouveau quiz spécial rugby féminin, j\'espère qu\'il vous plaira. A très vite !', '2022-10-08 12:55:47', 3),
(3, 'Quiz Equipes du monde', 'Un nouveau quiz sera bientôt disponible, il s\'agit d\'un quiz sur les équipes du monde et leur emblêmes, à très vite !', '2022-10-11 18:00:23', 4),
(4, 'Le rugby notre passion', 'Avis à tout les passionnés,\n venez vite découvrir les nouvelles questions disponibles à propos du rugby féminin !', '2022-10-04 14:23:15', 2),
(5, 'Dernier jours !', 'Dépécher vous !\n Il ne reste que quelques jour pour faire le quiz sur les règles du rugby à 15 avec le code de match \"R15TEST1\".', '2022-10-15 15:45:13', 3),
(6, 'Fin du match sur Règles du rugby à 15', 'Ce match était ouvert du 2022-10-07 12:49:36 au 2022-10-15 12:49:36 et les joueursTim,Julie,Gordon,Brendan,Elisabeth,JUlia,Julie l\'on testé.', '2022-10-20 00:00:00', 1),
(9, 'Fin du match sur Règles du rugby à 15', 'Ce match était ouvert du 2022-10-07 12:49:36 au 2022-10-15 12:49:36 et les joueurs Tim,Julie,Gordon,Brendan,Elisabeth,JUlia,Julie l\'on testé.', '2022-10-21 00:00:00', 1),
(10, 'Fin du match sur Coupe du monde rugby féminin 2022 : Résultats aux 10 octobre', 'Ce match était ouvert du 2022-10-02 12:09:23 au 2022-10-16 12:09:23 et personne ne l\'a testé.', '2022-10-21 00:00:00', 1),
(11, 'Fin du match sur Equipes et emblèmes', 'Ce match était ouvert du 2022-10-02 14:10:19 au 2022-10-19 14:10:19 et personne ne l\'a testé.', '2022-10-21 00:00:00', 1),
(45, 'Modification du quiz : 9', 'QUIZ VIDE ! Les matchs suivant : testtrig,blublu89,lalalala n\'ont plus de questions ! KuGou,Vict0r,Mat1s attention un de vos match n\'as plus de questions ! ', '2022-11-10 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `T_JOUEUR_JOU`
--

CREATE TABLE `T_JOUEUR_JOU` (
  `JOU_ID` int(11) NOT NULL,
  `JOU_PSEUDO` varchar(20) NOT NULL,
  `JOU_SCORE` double DEFAULT NULL,
  `MAT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_JOUEUR_JOU`
--

INSERT INTO `T_JOUEUR_JOU` (`JOU_ID`, `JOU_PSEUDO`, `JOU_SCORE`, `MAT_ID`) VALUES
(286, 'anouk', 33, 4),
(287, 'Loana', 52, 4),
(288, 'mathis', 22, 4),
(289, 'tom', 44, 4),
(290, 'LOuis', 40, 5),
(291, 'Tim', 40, 5),
(292, 'Marie', NULL, 5),
(293, 'Raoul', 40, 5),
(294, 'Myriam', NULL, 4),
(295, 'Louis', NULL, 4),
(296, 'Math', 22, 4);

--
-- Déclencheurs `T_JOUEUR_JOU`
--
DELIMITER $$
CREATE TRIGGER `affichage_score_total` AFTER UPDATE ON `T_JOUEUR_JOU` FOR EACH ROW BEGIN
IF(OLD.JOU_SCORE!=NEW.JOU_SCORE) then
    CALL aff_score(NEW.MAT_ID);
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `T_MATCH_MAT`
--

CREATE TABLE `T_MATCH_MAT` (
  `MAT_ID` int(11) NOT NULL,
  `MAT_DEBUT` datetime DEFAULT NULL,
  `MAT_FIN` datetime DEFAULT NULL,
  `UTI_IDUTILISATEUR` int(11) NOT NULL,
  `QUI_ID` int(11) NOT NULL,
  `MAT_CODE` char(8) NOT NULL,
  `MAT_CORRECTION` tinyint(4) NOT NULL,
  `MAT_ACTIF` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_MATCH_MAT`
--

INSERT INTO `T_MATCH_MAT` (`MAT_ID`, `MAT_DEBUT`, `MAT_FIN`, `UTI_IDUTILISATEUR`, `QUI_ID`, `MAT_CODE`, `MAT_CORRECTION`, `MAT_ACTIF`) VALUES
(1, '2022-12-07 23:29:46', NULL, 4, 1, 'RUGBYATO', 0, 1),
(2, '2022-12-04 10:04:02', NULL, 4, 3, 'R15TEST1', 0, 0),
(3, '2022-12-07 22:35:27', '2022-12-08 23:29:10', 5, 8, 'VOC15ANG', 0, 0),
(4, '2022-10-16 09:23:05', '2022-12-02 18:59:59', 6, 8, 'ANG456TE', 1, 1),
(5, '2022-11-29 10:03:53', NULL, 4, 4, 'EQUI8EMB', 0, 1),
(6, '2022-12-07 23:38:20', NULL, 9, 7, 'FEMRUG12', 0, 0),
(7, '2022-12-07 12:50:50', NULL, 9, 4, 'EQUIEMB1', 0, 1),
(37, '2022-12-03 18:26:17', NULL, 6, 4, '26Er1308', 0, 0),
(40, '2022-12-04 12:46:36', NULL, 3, 9, '28Rom243', 0, 0),
(46, '2022-12-05 01:06:31', NULL, 6, 1, '25Er1246', 0, 0),
(49, '2022-12-05 23:57:21', NULL, 9, 4, '27Vic140', 0, 0);

--
-- Déclencheurs `T_MATCH_MAT`
--
DELIMITER $$
CREATE TRIGGER `fin_match_act` AFTER UPDATE ON `T_MATCH_MAT` FOR EACH ROW BEGIN
IF (OLD.MAT_FIN is NULL AND NEW.MAT_FIN<CURRENT_TIMESTAMP) THEN
call insert_act_match(NEW.MAT_ID);
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `remise_zero_match` AFTER UPDATE ON `T_MATCH_MAT` FOR EACH ROW BEGIN
IF ((NEW.MAT_DEBUT>CURRENT_TIMESTAMP) and (NEW.MAT_FIN is NULL) ) THEN
	delete from T_JOUEUR_JOU where MAT_ID=NEW.MAT_ID;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `T_PROFIL_PRO`
--

CREATE TABLE `T_PROFIL_PRO` (
  `PRO_NOM` varchar(80) NOT NULL,
  `PRO_PRENOM` varchar(80) NOT NULL,
  `PRO_MAIL` varchar(200) NOT NULL,
  `UTI_IDUTILISATEUR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_PROFIL_PRO`
--

INSERT INTO `T_PROFIL_PRO` (`PRO_NOM`, `PRO_PRENOM`, `PRO_MAIL`, `UTI_IDUTILISATEUR`) VALUES
('Bourgeon', 'Lucas', 'bourgeon.l@gmail.com', 4),
('Penven', 'Charlotte', 'cha.penven@hotmail.fr', 5),
('Rupen', 'Eric', 'lepoissonrouge.quiflotte@gmail.com', 6),
('Connerit', 'Mathis', 'mathis.con@gmail.com', 7),
('Le Pelvec', 'Romain', 'rom1.lepel@hotmail.fr', 3);

-- --------------------------------------------------------

--
-- Structure de la table `T_QUESTION_QUE`
--

CREATE TABLE `T_QUESTION_QUE` (
  `QUE_ID` int(11) NOT NULL,
  `QUE_INTITULEQUESTION` varchar(200) NOT NULL,
  `QUE_ACTIVE` tinyint(4) NOT NULL,
  `QUE_ORDRE` int(11) NOT NULL,
  `QUI_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_QUESTION_QUE`
--

INSERT INTO `T_QUESTION_QUE` (`QUE_ID`, `QUE_INTITULEQUESTION`, `QUE_ACTIVE`, `QUE_ORDRE`, `QUI_ID`) VALUES
(1, 'Quel est la taille du terrain lorsque l\'on joue à toucher ?', 1, 1, 1),
(2, 'Quel est l\'effectif maximum sur le terrain ?', 1, 2, 1),
(3, 'Sur quelle partie du corps le toucher à deux main simultané est-t\'il valable ?', 1, 3, 1),
(4, 'Laquelle de ces remises en jeu n\'existe pas ?', 1, 4, 1),
(5, 'Est-il possible de jouer au pied au toucher ?', 1, 5, 1),
(6, 'Si mon équipe fait tomber le ballon au sol vers arrière ( pas d\'en-avant ), j\'ai le droit de :', 1, 6, 1),
(7, 'Qu\'est ce qu\'un PICK AND GO ?', 1, 7, 1),
(8, 'Lequel de ces mots ne décrit PAS une partie du terrain de rugby ?', 0, 1, 3),
(9, 'En milieu professionnel, quel est le nombre de joueur par équipe ?', 1, 2, 3),
(10, 'Combien de temps dure un match de rugby ?', 1, 3, 3),
(11, 'Laquelle de ces catégories de point est erronée ?', 0, 4, 3),
(12, 'Quel est le numéro du relayeur ?', 1, 5, 3),
(13, 'Quelle est la sanction pour un en-avant au rugby ?', 1, 6, 3),
(14, 'Le ballon est dans l\'en-but adverse, je plonge pour marquer et j\'aplatis avec ma cuisse. Essai validé ?', 1, 7, 3),
(15, 'Y a-t-il hors jeu dans l\'en but ?', 1, 8, 3),
(16, 'Lorsqu\'un joueur récupère à la volée le ballon d\'un coup de pied adversaire, il peut :', 1, 9, 3),
(17, 'Lorsqu\'un joueur perd ou passe la balle en avant, il y a :', 1, 10, 3),
(18, 'Lorsqu\'un joueur commet un placage haut, il y a :', 1, 11, 3),
(19, 'Lorsqu\'un joueur est au sol avec la balle, il doit :', 1, 12, 3),
(20, 'Quel est l\'emblème de l\'équipe d\'Angleterre ?', 1, 1, 4),
(21, 'Quel est l\'emblème du XV d\'Australie ?', 1, 2, 4),
(22, 'Quelle équipe est surnommée le XV du chardon ?', 1, 3, 4),
(23, 'Quel est l\'emblème de l\'Irlande ?', 1, 4, 4),
(24, 'Quel est l\'emblème de la France ?', 1, 5, 4),
(25, 'Qui sont surnommés les Pumas ?', 1, 6, 4),
(26, 'Quel est l\'emblème du Canada ?', 1, 7, 4),
(27, 'Quel est l\'emblème des Etats-Unis ?', 1, 8, 4),
(28, 'Quel est le surnom de la Nouvelle-Zélande ?', 1, 9, 4),
(29, 'Quel est l\'emblème de l\'Afrique du Sud ?', 1, 10, 4),
(30, 'Quelle équipe ne se trouve pas dans la poule A ?', 1, 1, 7),
(31, 'Quelle équipe ne se trouve pas dans la poule B ?', 1, 2, 7),
(32, 'Quelle équipe ne se trouve pas dans la poule C ?', 1, 3, 7),
(33, 'Qui a gagné France - Afrique du Sud ?', 1, 4, 7),
(34, 'Qui a gagné Fidji - Angleterre ?', 1, 5, 7),
(35, 'Qui a gagné Australie - Nouvelle-Zélande ?', 1, 6, 7),
(36, 'Qui a gagné Italie - Etat Unis ?', 1, 7, 7),
(37, 'Qui a gagné Canada - Japon ?', 1, 8, 7),
(38, 'Qui a gagné Pays de Galles - Ecosse ?', 1, 9, 7),
(39, 'Quelle équipe est première de la poule A ?', 1, 10, 7),
(40, 'Quelle équipe est première de la poule B ?', 1, 11, 7),
(41, 'Quelle équipe est première de la poule C ?', 1, 12, 7),
(42, 'Que est le mot anglais pour les lignes de touche', 0, 1, 8),
(43, 'Que est le mot anglais pour un essai', 1, 2, 8),
(44, 'Que est le mot anglais pour la ligne médiane', 1, 3, 8),
(45, 'Que est le mot anglais pour la barre transversale', 1, 4, 8),
(46, 'Que est le mot anglais pour une passe', 1, 4, 8),
(47, 'Que est le mot anglais pour un en-avant', 1, 5, 8),
(48, 'Que est le mot anglais pour une plaquage', 1, 6, 8),
(49, 'Que est le mot anglais pour une obstruction', 1, 7, 8),
(50, 'Que est le mot anglais pour un arbitre', 1, 8, 8),
(51, 'Combien de fois l\'équipe de france de rugby masculin a t\'elle été championne du monde ?', 1, 1, 5),
(52, 'Et combien de fois pour l\'équipe d\'angleterre ?', 1, 2, 5),
(53, 'En quelle année ?', 1, 3, 5),
(54, 'Quelle équipe a gagné en premier la coupe du monde de Rugby ?', 1, 4, 5),
(55, 'En quelle année a eu lieu la première coupe du monde de rugby ?', 1, 5, 5),
(56, 'Quand la France à t\'elle accueillit la coupe du monde ?', 1, 6, 5),
(57, 'Quelle est l\'année de la prochaine édition en France ?', 1, 7, 5),
(58, 'Quel est le plus gros score au rugby ?', 1, 8, 5);

--
-- Déclencheurs `T_QUESTION_QUE`
--
DELIMITER $$
CREATE TRIGGER `act_suppression_question` BEFORE DELETE ON `T_QUESTION_QUE` FOR EACH ROW BEGIN
set @idquiz := (select QUI_ID from T_QUESTION_QUE where QUE_ID=OLD.QUE_ID);
set @recherchetitre := CONCAT('Modification du quiz : ',@idquiz);
set @actid := (select act_id from T_ACTUALITE_ACT where ACT_TITRE=@recherchetitre );
IF (@actid is not null) THEN
delete from T_ACTUALITE_ACT where ACT_ID=@actid;
END IF;
	set @titre := CONCAT('Modification du quiz : ', @idquiz);
	set @nbquestion := (select count(QUE_ID) from T_QUESTION_QUE where QUI_ID=@idquiz);
	set @nbquestion := @nbquestion-1;
	IF (@nbquestion>1) THEN
		
		set @texte := CONCAT('Suppression d’une question, il reste ',@nbquestion,' questions .');
		insert into T_ACTUALITE_ACT values(NULL,@titre,@texte,CURDATE(),1);
	ELSEIF (@nbquestion = 1) THEN
		insert into T_ACTUALITE_ACT values(NULL,@titre,"ATTENTION, plus qu’une question ! ",CURDATE(),1);
	ELSE 
		set @nbmatch := (select count(MAT_CODE) from T_MATCH_MAT where QUI_ID=@idquiz);
		IF (@nbmatch>1) THEN
			set @matchs := (select GROUP_CONCAT(MAT_CODE) from T_MATCH_MAT where QUI_ID=@idquiz);
			SET @forma := (select GROUP_CONCAT(UTI_PSEUDO) from T_MATCH_MAT join T_UTILISATEUR_UTI using (UTI_IDUTILISATEUR) WHERE QUI_ID=@idquiz);
			set @texte := CONCAT('QUIZ VIDE ! Les matchs suivant : ',@matchs,' n''ont plus de questions ! ',@forma,' attention un de vos match n''as plus de questions ! ');
		ELSEIF (@nbmatch = 1) THEN
			set @matchs := (select MAT_CODE from T_MATCH_MAT where QUI_ID=@idquiz);
			SET @forma := (select UTI_PSEUDO from T_MATCH_MAT join T_UTILISATEUR_UTI using (UTI_IDUTILISATEUR) WHERE QUI_ID=@idquiz);
			set @texte := CONCAT('QUIZ VIDE ! Le match : ',@matchs,' n''a plus de questions ! ',@forma,' attention un de vos match n''as plus de questions ! ');
		ELSE 
			set @texte := ("QUIZ VIDE ! Aucun match associé à ce quiz pour l’instant !");
		END IF;
		insert into T_ACTUALITE_ACT values(NULL,@titre,@texte,CURDATE(),1);
	END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sup_question_et_rep_asso` BEFORE DELETE ON `T_QUESTION_QUE` FOR EACH ROW BEGIN
delete from T_REPONSE_REP where QUE_ID=OLD.QUE_ID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `T_QUIZ_QUI`
--

CREATE TABLE `T_QUIZ_QUI` (
  `QUI_ID` int(11) NOT NULL,
  `QUI_INTITULE` varchar(200) NOT NULL,
  `QUI_IMAGE` varchar(200) DEFAULT NULL,
  `QUI_ACTIF` tinyint(4) NOT NULL,
  `UTI_IDUTILISATEUR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_QUIZ_QUI`
--

INSERT INTO `T_QUIZ_QUI` (`QUI_ID`, `QUI_INTITULE`, `QUI_IMAGE`, `QUI_ACTIF`, `UTI_IDUTILISATEUR`) VALUES
(1, 'Règles du rugby à Toucher', NULL, 1, 3),
(3, 'Règles du rugby à 15', 'RegleRugby.jpg', 1, 3),
(4, 'Equipes et emblèmes', NULL, 1, 4),
(5, 'Coupe du monde rugby : un peu d\'histoire', 'HistoireRugby.jpg', 1, 5),
(7, 'Coupe du monde rugby féminin 2022 : Résultats aux 10 octobre', 'EquipeFranceRugby.jpg', 0, 5),
(8, 'Et en anglais alors ! Test de vocabulaire', NULL, 1, 6),
(9, 'quiz test trigger', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `T_REPONSE_REP`
--

CREATE TABLE `T_REPONSE_REP` (
  `REP_ID` int(11) NOT NULL,
  `REP_REPONSE` varchar(200) NOT NULL,
  `REP_VRAI` tinyint(4) NOT NULL,
  `QUE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_REPONSE_REP`
--

INSERT INTO `T_REPONSE_REP` (`REP_ID`, `REP_REPONSE`, `REP_VRAI`, `QUE_ID`) VALUES
(1, 'Le terrain normal ( environ 100 longueur pour 70 mettre largeur )', 0, 1),
(2, 'Une moitié de terrain dans le sens de la longueur', 0, 1),
(3, 'Une moitié de terrain dans le sens de la largueur', 1, 1),
(4, '7 contre 7', 0, 2),
(5, '6 contre 6', 0, 2),
(6, '5 contre 5', 1, 2),
(7, '4 contre 4', 0, 2),
(8, 'sur le buste, des hanche aux épaules', 0, 3),
(9, 'sur le buste des hanches aux épaules excepter les bras', 1, 3),
(10, 'tout le corps', 0, 3),
(11, 'tout le corps à l\'exception de la tête', 0, 3),
(12, 'jonglage avec le pied, je lâche mon ballon sur mon pied puis le récupère après le rebond', 0, 4),
(13, 'taper le ballon au sol en le gardant bien entre ces mains', 0, 4),
(14, 'placer le ballon au sol, le toucher du pied puis le ramasser', 0, 4),
(15, 'ramasser le ballon puis faire une passe à ma partenaire', 1, 4),
(16, 'non c\'est interdit au toucher', 0, 5),
(17, 'oui sur tout le terrain', 0, 5),
(18, 'oui seulement entre les pointillés des 15 et des 5 m', 1, 5),
(19, 'le récupérer et partir', 0, 6),
(20, 'le récupérer et faire directement une passe', 0, 6),
(21, 'reculer de 5 m et me préparer à défendre', 1, 6),
(22, 'c\'est lorsque deux défenseur touche une personne en même temps, ils sont alors tout deux figer avant que le ballon ai fait 5 m ou une passe', 0, 7),
(23, 'c\'est lorsque l\'on saute une personne lors d\'une passe', 0, 7),
(24, 'c\'est lorsque que quelqu\'un botte et récupère direct le ballon ( avant qu\'il ne touche le sol )', 0, 7),
(25, 'c\'est lorsque le relayeur par dans la défense sans faire au préalable une passe', 1, 7),
(26, 'l\'allée', 1, 8),
(27, 'l\'en-but', 0, 8),
(28, 'l\'aire du périmètre', 0, 8),
(29, 'les 22', 0, 8),
(30, '20 joueurs dont 5 remplaçants', 0, 9),
(31, '22 joueurs dont 7 remplaçants', 0, 9),
(32, '23 joueurs dont 8 remplaçants', 1, 9),
(33, '25 joueurs dont 10 remplaçants', 0, 9),
(34, 'deux fois 45 min ', 0, 10),
(35, 'deux fois 40 min', 1, 10),
(36, 'deux fois 35 min', 0, 10),
(37, 'deux fois 30 min', 0, 10),
(38, 'Essai						5 points', 0, 11),
(39, 'Essai de pénalité	 		7 points', 0, 11),
(40, 'But sur transformation	2 points', 0, 11),
(41, 'But sur pénalité			2 points', 1, 11),
(42, '9', 1, 12),
(43, '11', 0, 12),
(44, '5', 0, 12),
(45, '14', 0, 12),
(46, 'Mêlée introduction pour l\'adversaire', 0, 13),
(47, 'Pénalité pour l\'adversaire', 0, 13),
(48, 'Mêlée ou pénalité pour l\'adversaire', 1, 13),
(49, 'Coup-franc', 0, 13),
(50, 'Oui', 0, 14),
(51, 'Non', 1, 14),
(52, 'Oui', 0, 15),
(53, 'Non', 1, 15),
(54, 'Marquer', 1, 16),
(55, 'Prendre une pénalité', 0, 16),
(56, 'Prendre une mêlée', 0, 16),
(57, 'Une mêlée avec introduction de l\'équipe du joueur qui a passé ou perdu la balle en avant', 0, 17),
(58, 'Une mêlée avec introduction de l\'adversaire', 1, 17),
(59, 'Une pénalité en faveur de l\'adversaire', 0, 17),
(60, 'Une pénalité en faveur du plaqueur', 0, 18),
(61, 'Une mêlée avec introduction de l\'adversaire', 0, 18),
(62, 'Une pénalité en faveur de l\'adversaire', 1, 18),
(63, 'La laisser', 1, 19),
(64, 'La tenir', 0, 19),
(65, 'La tenir jusqu\'à ce qu\'un joueur de son équipe arrive', 0, 19),
(66, 'La rose', 1, 20),
(67, 'La tulipe ', 0, 20),
(68, 'Le rosbeef', 0, 20),
(69, 'Le Walabies', 1, 21),
(70, 'Le Kiwi', 0, 21),
(71, 'Le Boomerang', 0, 21),
(72, 'Norvège', 0, 22),
(73, 'Ecosse', 1, 22),
(74, 'Allemagne', 0, 22),
(75, 'Le poireau', 0, 23),
(76, 'Le trèfle', 1, 23),
(77, 'Le pin', 0, 23),
(78, 'Le coq', 1, 24),
(79, 'Le chien', 0, 24),
(80, 'Le cheval', 0, 24),
(81, 'Angleterre', 0, 25),
(82, 'Argentine', 1, 25),
(83, 'Namibie', 0, 25),
(84, 'Le canuck', 0, 26),
(85, 'Le caribou', 0, 26),
(86, 'La feuille d\'érable', 1, 26),
(87, 'Lions', 0, 27),
(88, 'Bears', 0, 27),
(89, 'Eagles', 1, 27),
(90, 'All White', 0, 28),
(91, 'All Black', 1, 28),
(92, 'All Blue', 0, 28),
(93, 'Le springboks', 1, 29),
(94, 'La gazelle', 0, 29),
(95, 'Le gnou', 0, 29),
(96, 'Nouvelle-Zélande', 0, 30),
(97, 'Australie', 0, 30),
(98, 'Ecosse', 0, 30),
(99, 'Angleterre', 1, 30),
(100, 'Italie', 0, 31),
(101, 'Pays de Galles', 1, 31),
(102, 'Etats-Unis', 0, 31),
(103, 'Japon', 0, 31),
(104, 'Angleterre', 0, 32),
(105, 'Italie', 1, 32),
(106, 'Afrique du Sud', 0, 32),
(107, 'Fidji', 0, 32),
(108, 'La France', 1, 33),
(109, 'L\'Afrique du Sud', 0, 33),
(110, 'Les Fidji', 0, 34),
(111, 'L\'Angleterre', 1, 34),
(112, 'La Nouvelle-Zélande', 1, 35),
(113, 'L\'Australie', 0, 35),
(114, 'Les Etats-Unis', 0, 36),
(115, 'L\'Italie', 1, 36),
(116, 'Le Japon', 0, 37),
(117, 'Le Canada', 1, 37),
(118, 'Le Pays de Galles', 1, 38),
(119, 'L\'Ecosse', 0, 38),
(120, 'L\'Australie', 0, 39),
(121, 'L\'Ecosse', 0, 39),
(122, 'La Nouvelle-Zélande', 1, 39),
(123, 'Le Pays de Galles', 0, 39),
(124, 'Le Canada', 1, 40),
(125, 'L\'Italie', 0, 40),
(126, 'Les Etats-Unis', 0, 40),
(127, 'Le Japon', 0, 40),
(128, 'La France', 0, 41),
(129, 'L\'Afrique du Sud', 0, 41),
(130, 'Les Fidji', 0, 41),
(131, 'L\'Angleterre', 1, 41),
(132, 'sidelines', 0, 42),
(133, 'touchlines', 1, 42),
(134, 'try lines', 0, 42),
(135, 'field goal', 0, 43),
(136, 'conversion', 0, 43),
(137, 'try', 1, 43),
(138, 'try line', 0, 44),
(139, 'touchlines', 0, 44),
(140, 'halfway line', 1, 44),
(141, 'crossbar', 1, 45),
(142, 'goalposts', 0, 45),
(143, 'touchline', 0, 45),
(144, 'bowl', 0, 46),
(145, 'pass', 1, 46),
(146, 'toss', 0, 46),
(147, 'forward pass', 0, 47),
(148, 'passover', 0, 47),
(149, 'knock-on', 1, 47),
(150, 'tackled', 1, 48),
(151, 'fouled', 0, 48),
(152, 'drop kicked', 0, 48),
(153, 'blockage', 0, 49),
(154, 'obstruction', 1, 49),
(155, 'dangerous play', 0, 49),
(156, 'umpire', 0, 50),
(157, 'touche judge', 0, 50),
(158, 'referee', 1, 50);

-- --------------------------------------------------------

--
-- Structure de la table `T_UTILISATEUR_UTI`
--

CREATE TABLE `T_UTILISATEUR_UTI` (
  `UTI_IDUTILISATEUR` int(11) NOT NULL,
  `UTI_PSEUDO` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `UTI_MDP` char(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `UTI_ROLE` char(1) NOT NULL,
  `UTI_ETAT` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `T_UTILISATEUR_UTI`
--

INSERT INTO `T_UTILISATEUR_UTI` (`UTI_IDUTILISATEUR`, `UTI_PSEUDO`, `UTI_MDP`, `UTI_ROLE`, `UTI_ETAT`) VALUES
(1, 'responsable', '2b62268215e6533364fdaba530243da013805b004231f2ccb6061a0c4971f242', 'A', 'A'),
(2, 'KuGou', 'd7f38b0a5873c7ff7e3aa5b3dbc050cc7a6037be33f71d9c850edbea6c425a5a', 'A', 'A'),
(3, 'Rom1', '944b09345b3790722a5cd36a505a47309fce0a56f8e6470c06bef108ba6267d3', 'F', 'A'),
(4, 'Luc4', '2961c7afde573dd9627d589ca42af9b5ba30ca418367a8ee447ce3a95db40dc8', 'F', 'A'),
(5, 'Chacha8', '90db4f2363f3c99bdcf82f2aaad6cd6fbdb520265233aded328c2efa23e9fb85', 'F', 'D'),
(6, 'Er1c', '082d9ace2d8c27a5537cf76723463d2da7b5b215c10fbcc3693890f9b2f8df6d', 'F', 'A'),
(7, 'Mat1s', '6ffdcbfcba803dc8704069d630f10f56513d6c180298cb294207b1b4c3b64cae', 'F', 'A'),
(9, 'Vict0r', 'cb22fc7f6379840876d57940cfb990c1c0f46f31fafb43cb5709e33641760e31', 'F', 'A');

-- --------------------------------------------------------

--
-- Structure de la vue `Question_réponses`
--
DROP TABLE IF EXISTS `Question_réponses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`zgouhiean`@`%` SQL SECURITY DEFINER VIEW `Question_réponses`  AS SELECT `T_QUESTION_QUE`.`QUE_ID` AS `QUE_ID`, `T_QUESTION_QUE`.`QUE_INTITULEQUESTION` AS `QUE_INTITULEQUESTION`, `T_REPONSE_REP`.`REP_ID` AS `REP_ID`, `T_REPONSE_REP`.`REP_REPONSE` AS `REP_REPONSE` FROM (`T_QUESTION_QUE` join `T_REPONSE_REP` on(`T_QUESTION_QUE`.`QUE_ID` = `T_REPONSE_REP`.`QUE_ID`))  ;

-- --------------------------------------------------------

--
-- Structure de la vue `Question_réponse_vrai`
--
DROP TABLE IF EXISTS `Question_réponse_vrai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`zgouhiean`@`%` SQL SECURITY DEFINER VIEW `Question_réponse_vrai`  AS SELECT `T_QUESTION_QUE`.`QUE_ID` AS `QUE_ID`, `T_QUESTION_QUE`.`QUE_INTITULEQUESTION` AS `QUE_INTITULEQUESTION`, `T_REPONSE_REP`.`REP_ID` AS `REP_ID`, `T_REPONSE_REP`.`REP_REPONSE` AS `REP_REPONSE` FROM (`T_QUESTION_QUE` join `T_REPONSE_REP` on(`T_QUESTION_QUE`.`QUE_ID` = `T_REPONSE_REP`.`QUE_ID`)) WHERE `T_REPONSE_REP`.`REP_VRAI` = 11  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `T_ACTUALITE_ACT`
--
ALTER TABLE `T_ACTUALITE_ACT`
  ADD PRIMARY KEY (`ACT_ID`),
  ADD KEY `fk_T_ACTUALITE_ACT_T_UTILISATEUR_UTI1_idx` (`UTI_IDUTILISATEUR`);

--
-- Index pour la table `T_JOUEUR_JOU`
--
ALTER TABLE `T_JOUEUR_JOU`
  ADD PRIMARY KEY (`JOU_ID`),
  ADD KEY `fk_T_JOUEUR_JOU_T_MATCH_MAT1_idx` (`MAT_ID`);

--
-- Index pour la table `T_MATCH_MAT`
--
ALTER TABLE `T_MATCH_MAT`
  ADD PRIMARY KEY (`MAT_ID`),
  ADD UNIQUE KEY `MAT_CODE_UNIQUE` (`MAT_CODE`),
  ADD KEY `fk_T_MATCH_MAT_T_UTILISATEUR_UTI1_idx` (`UTI_IDUTILISATEUR`),
  ADD KEY `fk_T_MATCH_MAT_T_QUIZ_QUI1_idx` (`QUI_ID`);

--
-- Index pour la table `T_PROFIL_PRO`
--
ALTER TABLE `T_PROFIL_PRO`
  ADD PRIMARY KEY (`PRO_MAIL`),
  ADD UNIQUE KEY `UTI_IDUTILISATEUR` (`UTI_IDUTILISATEUR`),
  ADD KEY `fk_T_PROFIL_PRO_T_UTILISATEUR_UTI1_idx` (`UTI_IDUTILISATEUR`);

--
-- Index pour la table `T_QUESTION_QUE`
--
ALTER TABLE `T_QUESTION_QUE`
  ADD PRIMARY KEY (`QUE_ID`),
  ADD KEY `fk_T_QUESTION_QUE_T_QUIZ_QUI1_idx` (`QUI_ID`);

--
-- Index pour la table `T_QUIZ_QUI`
--
ALTER TABLE `T_QUIZ_QUI`
  ADD PRIMARY KEY (`QUI_ID`),
  ADD KEY `fk_T_QUIZ_QUI_T_UTILISATEUR_UTI1_idx` (`UTI_IDUTILISATEUR`);

--
-- Index pour la table `T_REPONSE_REP`
--
ALTER TABLE `T_REPONSE_REP`
  ADD PRIMARY KEY (`REP_ID`),
  ADD KEY `fk_T_REPONSE_REP_T_QUESTION_QUE1_idx` (`QUE_ID`);

--
-- Index pour la table `T_UTILISATEUR_UTI`
--
ALTER TABLE `T_UTILISATEUR_UTI`
  ADD PRIMARY KEY (`UTI_IDUTILISATEUR`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `T_ACTUALITE_ACT`
--
ALTER TABLE `T_ACTUALITE_ACT`
  MODIFY `ACT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `T_JOUEUR_JOU`
--
ALTER TABLE `T_JOUEUR_JOU`
  MODIFY `JOU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT pour la table `T_MATCH_MAT`
--
ALTER TABLE `T_MATCH_MAT`
  MODIFY `MAT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `T_PROFIL_PRO`
--
ALTER TABLE `T_PROFIL_PRO`
  MODIFY `UTI_IDUTILISATEUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `T_QUESTION_QUE`
--
ALTER TABLE `T_QUESTION_QUE`
  MODIFY `QUE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `T_QUIZ_QUI`
--
ALTER TABLE `T_QUIZ_QUI`
  MODIFY `QUI_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `T_REPONSE_REP`
--
ALTER TABLE `T_REPONSE_REP`
  MODIFY `REP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT pour la table `T_UTILISATEUR_UTI`
--
ALTER TABLE `T_UTILISATEUR_UTI`
  MODIFY `UTI_IDUTILISATEUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `T_ACTUALITE_ACT`
--
ALTER TABLE `T_ACTUALITE_ACT`
  ADD CONSTRAINT `fk_T_ACTUALITE_ACT_T_UTILISATEUR_UTI1` FOREIGN KEY (`UTI_IDUTILISATEUR`) REFERENCES `T_UTILISATEUR_UTI` (`UTI_IDUTILISATEUR`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_JOUEUR_JOU`
--
ALTER TABLE `T_JOUEUR_JOU`
  ADD CONSTRAINT `fk_T_JOUEUR_JOU_T_MATCH_MAT1` FOREIGN KEY (`MAT_ID`) REFERENCES `T_MATCH_MAT` (`MAT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_MATCH_MAT`
--
ALTER TABLE `T_MATCH_MAT`
  ADD CONSTRAINT `fk_T_MATCH_MAT_T_QUIZ_QUI1` FOREIGN KEY (`QUI_ID`) REFERENCES `T_QUIZ_QUI` (`QUI_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_T_MATCH_MAT_T_UTILISATEUR_UTI1` FOREIGN KEY (`UTI_IDUTILISATEUR`) REFERENCES `T_UTILISATEUR_UTI` (`UTI_IDUTILISATEUR`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_PROFIL_PRO`
--
ALTER TABLE `T_PROFIL_PRO`
  ADD CONSTRAINT `fk_T_PROFIL_PRO_T_UTILISATEUR_UTI1` FOREIGN KEY (`UTI_IDUTILISATEUR`) REFERENCES `T_UTILISATEUR_UTI` (`UTI_IDUTILISATEUR`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_QUESTION_QUE`
--
ALTER TABLE `T_QUESTION_QUE`
  ADD CONSTRAINT `fk_T_QUESTION_QUE_T_QUIZ_QUI1` FOREIGN KEY (`QUI_ID`) REFERENCES `T_QUIZ_QUI` (`QUI_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_QUIZ_QUI`
--
ALTER TABLE `T_QUIZ_QUI`
  ADD CONSTRAINT `fk_T_QUIZ_QUI_T_UTILISATEUR_UTI1` FOREIGN KEY (`UTI_IDUTILISATEUR`) REFERENCES `T_UTILISATEUR_UTI` (`UTI_IDUTILISATEUR`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_REPONSE_REP`
--
ALTER TABLE `T_REPONSE_REP`
  ADD CONSTRAINT `fk_T_REPONSE_REP_T_QUESTION_QUE1` FOREIGN KEY (`QUE_ID`) REFERENCES `T_QUESTION_QUE` (`QUE_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
