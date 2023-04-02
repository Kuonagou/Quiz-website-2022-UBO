/*
Actualités :
Sprint 1
1. Requête listant toutes les actualités de la table des actualités et leur auteur
(login)
2. Requête donnant les données d'une actualité dont on connaît l'identifiant (n°)
3. Requête listant les 5 dernières actualités dans l'ordre décroissant
4. Requête recherchant et donnant la (ou les) actualité(s) contenant un mot
particulier
5. Requête listant toutes les actualités postées à une date particulière + le login
de l’auteur
*/
1. SELECT ACT_ID, ACT_TITRE, UTI_IDUTILISATEUR FROM T_ACTUALITE_ACT ;
2. SELECT ACT_ID,ACT_TITRE,ACT_CONTENU,ACT_NEWDATE,UTI_IDUTILISATEUR FROM T_ACTUALITE_ACT WHERE ACT_ID=3;
3. SELECT ACT_ID,ACT_TITRE FROM T_ACTUALITE_ACT ORDER BY ACT_ID DESC LIMIT 5;
4. SELECT ACT_ID,ACT_TITRE,ACT_CONTENU FROM T_ACTUALITE_ACT WHERE ACT_TITRE like '%Modification%' or ACT_CONTENU like '%match%';
5. SELECT ACT_ID,ACT_TITRE,UTI_IDUTILISATEUR FROM T_ACTUALITE_ACT WHERE ACT_NEWDATE like '2022-10-11%';
/*
Matchs :
Sprint 1
1. Requête vérifiant l’existence (ou non) du code d’un match
2. Requête d’ajout du pseudo d’un joueur pour un match particulier dont l’ID est
connu
3. Requête vérifiant l’existence (ou non) d’un pseudo pour un match particulier
4. Requête(s) d’affichage de toutes les questions (+ réponses) associées à un
match
*/
1. SELECT MAT_ID FROM T_MATCH_MAT WHERE MAT_CODE='testtrig';
2. INSERT INTO T_JOUEUR_JOU VALUES (NULL,'Angelo',NULL,@matchid);
3. SELECT JOU_ID FROM T_JOUEUR_JOU WHERE JOU_PSEUDO like 'Victor';
4. SELECT MAT_ID, QUI_INTITULE, QUE_INTITULEQUESTION, QUE_ID, REP_ID,
 REP_REPONSE from T_MATCH_MAT join T_QUIZ_QUI using ( QUI_ID) left outer join T_QUESTION_QUE using(QUI_ID)
 left outer join T_REPONSE_REP using (QUE_ID) WHERE MAT_ID=1;
/*
Matchs :
Sprint 2
5. Requête(s) d’affichage, si autorisé, de toutes les questions d’un match et leur
bonne réponse
6. Requête de vérification d’une réponse donnée par un joueur (bonne ou
mauvaise ?)
7. Requête de mise à jour du score d’un joueur particulier (pseudo connu)
8. Requête de récupération du score d’un joueur particulier (pseudo connu)
*/
5. SELECT MAT_ID, QUE_ID, QUE_INTITULEQUESTION, REP_ID, REP_REPONSE
FROM T_QUESTION_QUE join T_REPONSE_REP using(QUE_ID) join T_MATCH_MAT using (QUI_ID)
WHERE REP_VRAI=1 and MAT_ID=2 AND QUE_ACTIVE=1;
6. SELECT QUE_ID FROM T_REPONSE_REP where REP_ID=1 and REP_VRAI=1; /*rep 3*/
7. UPDATE T_JOUEUR_JOU set JOU_SCORE='12' WHERE JOU_PSEUDO='Brendan';
8. SELECT JOU_SCORE FROM T_JOUEUR_JOU WHERE JOU_PSEUDO='Brendan';

/*
Actualités :
Sprint 1
1. Requête listant toutes les actualités postées par un auteur particulier
(connaissant le login du formateur connecté)
*/
1. SELECT ACT_ID,ACT_TITRE,UTI_IDUTILISATEUR FROM T_ACTUALITE_ACT WHERE UTI_IDUTILISATEUR=2;
/*
Actualités :
Sprint 3
2. Requête d'ajout d'une actualité
3. Requête qui compte les actualités à une date précise
4. Requête de modification d'une actualité
5. Requête de suppression d'une actualité à partir de son ID (n°)
6. Requête supprimant toutes les actualités postées par un auteur particulier
*/
2. INSERT INTO T_ACTUALITE_ACT values(NULL,'je suis le titre de l\'act','et moi le texte',CURDATE(),1);
3. SELECT count(ACT_ID) from T_ACTUALITE_ACT where ACT_NEWDATE like '2022-10-04%';
4. UPDATE T_ACTUALITE_ACT set ACT_TITRE='nouveau titre' WHERE ACT_ID=3;
5. DELETE FROM T_ACTUALITE_ACT WHERE ACT_ID=3;
6. DELETE FROM T_ACTUALITE_ACT WHERE UTI_IDUTILISATEUR=3;
/*
Profils (formateurs / administrateurs) :
Sprint 1
1. Requête listant toutes les données de tous les profils
2. Requête listant les données des profils des formateurs (/des administrateurs)
3. Requête de vérification des données de connexion (login et mot de passe)
4. Requête récupérant les données d'un profil particulier (utilisateur connecté)
5. Requête récupérant tous les logins des profils et l'état du profil (activé /
désactivé)
*/
1. SELECT * from T_PROFIL_PRO ;
2. SELECT PRO_MAIL, PRO_NOM, PRO_PRENOM from T_PROFIL_PRO join T_UTILISATEUR_UTI using (UTI_IDUTILISATEUR) where UTI_ROLE='F';  /* 'A' */
3. SELECT UTI_IDUTILISATEUR from T_UTILISATEUR_UTI WHERE UTI_MDP='testQuiz22' and UTI_PSEUDO='Mat1s';
4. SELECT PRO_MAIL, PRO_NOM, PRO_PRENOM from T_PROFIL_PRO join T_UTILISATEUR_UTI using (UTI_IDUTILISATEUR) where UTI_PSEUDO='KuGou';
5. SELECT UTI_PSEUDO , UTI_ETAT from T_UTILISATEUR_UTI;
/*
Profils (formateurs / administrateurs) :
Sprint 3
6. Requête d'ajout des données d'un profil
7. Requête de modification des données d'un profil
8. Requête de désactivation d'un profil
9. Requête de suppression d'un profil administrateur
10. Requête(s) de suppression d’un compte formateur et des données associées
à ce compte (sans supprimer les quiz !)
*/
6. INSERT INTO `T_PROFIL_PRO` (`PRO_NOM`, `PRO_PRENOM`, `PRO_MAIL`, `UTI_IDUTILISATEUR`) VALUES
('Le Borgne', 'Maelys', 'lebM@gmail.com',10);
7. UPDATE T_PROFIL_PRO SET PRO_NOM='nouk' where UTI_IDUTILISATEUR=2;
8. UPDATE T_UTILISATEUR_UTI SET UTI_ETAT='0' where UTI_IDUTILISATEUR=2;
9. DELETE FROM T_PROFIL_PRO WHERE UTI_IDUTILISATEUR=2; DELETE FROM T_UTILISATEUR_UTI WHERE UTI_IDUTILISATEUR=2; 
10. DELETE FROM T_ACTUALITE_ACT WHERE UTI_IDUTILISATEUR=2; DELETE FROM T_MATCH_MAT WHERE UTI_IDUTILISATEUR=2;
UPDATE FROM T_QUIZ_QUI SET UTI_IDUTILISATEUR=1 WHERE UTI_IDUTILISATEUR=2; DELETE FROM  T_UTILISATEUR_UTI WHERE UTI_IDUTILISATEUR=2;
/*
Quiz :
Sprint 1
1. Requête(s) permettant de récupérer toutes les données (questions, choix
possibles) d’un quiz en particulier
2. Requête qui compte les questions d’un quiz dont on connaît l’ID
*/
1. SELECT * from T_QUIZ_QUI left outer join T_QUESTION_QUE using(QUI_ID)
	 left outer join T_REPONSE_REP using (QUE_ID) WHERE QUI_ID=1;
2. SELECT count(QUE_ID) from T_QUESTION_QUE where QUI_ID=1;
/* 
Quiz :
Sprint 2
3. Requête listant tous les quiz
4. Requête listant tous les quiz (intitulé et auteur) et les matchs associés (intitulé
et auteur)
5. Requête listant tous les quiz d’un formateur en particulier (dont on connaît l’ID)
6. Requête donnant tous les quiz qui ne sont plus associés à un formateur
7. Requête listant, pour un formateur dont on connaît le login, tous les quiz et
leurs matchs, s’il y en a
*/
3. SELECT QUI_ID, QUI_INTITULE from T_QUIZ_QUI ;
4. SELECT QUI_ID, QUI_INTITULE, NOM_id(T_QUIZ_QUI.UTI_IDUTILISATEUR) as createur, MAT_ID,NOM_id(T_MATCH_MAT.UTI_IDUTILISATEUR) as utilise from T_UTILISATEUR_UTI join T_QUIZ_QUI using (UTI_IDUTILISATEUR) left outer join T_MATCH_MAT using(QUI_ID); 
5. SELECT QUI_ID, QUI_INTITULE from T_QUIZ_QUI WHERE UTI_IDUTILISATEUR=1;
6. SELECT QUI_ID, QUI_INTITULE from T_QUIZ_QUI WHERE UTI_IDUTILISATEUR is NULL;
7. SELECT QUI_ID, QUI_INTITULE, MAT_ID from T_QUIZ_QUI left outer join T_MATCH_MAT using(QUI_ID) WHERE T_QUIZ_QUI.UTI_IDUTILISATEUR=3;
/*
Quiz :
Sprint 3
8. Requête d’insertion d’un quiz
9. Requête(s) de suppression d’un quiz et de toutes les données qui lui sont
associées
10. Requête d’activation (/de désactivation) d’un quiz
11. Requête(s) de copie d’un quiz
12. Requête(s) de modification d’un quiz dont on connaît l’ID (+ suppression des
matchs associés)
13. Requête qui autorise la visualisation des bonnes réponses pour un quiz
*/
8. INSERT INTO `T_QUIZ_QUI` (`QUI_ID`, `QUI_INTITULE`, `QUI_IMAGE`, `QUI_ACTIF`, `UTI_IDUTILISATEUR`) VALUES
(NULL, 'nouveau quiz nom', NULL, 1, 3);
9. DELETE FROM T_QUESTION_QUE where QUI_ID=3; DELETE FROM T_QUIZ_QUI WHERE QUI_ID=3; /*trigger qui supprime les question*/
10. UPDATE T_QUIZ_QUI SET QUI_ACTIF=1 WHERE QUI_ID=3;
11. SELECT * from T_QUIZ_QUI left outer join T_QUESTION_QUE using(QUI_ID) left outer join T_REPONSE_REP using(QUE_ID) WHERE QUI_ID=3;
12. UPDATE T_QUIZ_QUI SET QUI_INTITULE='quiz sur les pizza' WHERE QUI_ID=3; DELETE FROM T_MATCH_MAT WHERE QUI_ID=3;
13. UPDATE T_MATCH_MAT SET MAT_CORRECTION=1 WHERE QUI_ID=3;
/*
Questions / Réponses :
Sprint 3
1. Requête qui liste toutes les questions d’un quiz particulier dont on connaît l’ID
2. Requête qui ajoute une question à un quiz particulier dont on connaît l’ID
3. Requête qui modifie une question d’un quiz particulier dont on connaît l’ID
4. Requête qui active (/désactive) une question d’un quiz particulier dont on
connaît l’ID
5. Requête qui supprime une question (+ toutes les données associées) d’un
quiz particulier dont on connaît l’ID
6. Requête qui liste les questions d’un quiz dans l’ordre
7. Requête qui modifie le numéro (ordre) d’une question d’un quiz
8. Requête qui liste tous les choix possibles pour une question d’un quiz
particulier dont on connaît l’ID
9. Requête qui donne la bonne réponse pour une question d’un quiz particulier
dont on connaît l’ID
10. Requête qui ajoute une proposition de réponse pour une question d’un quiz
particulier
11. Requête qui modifie une proposition de réponse pour une question d’un quiz
particulier
12. Requête qui supprime une proposition de réponse pour une question d‘un
quiz particulier
*/
1. SELECT QUE_ID, QUE_INTITULEQUESTION from T_QUESTION_QUE where QUI_ID=3;
2. INSERT INTO `T_QUESTION_QUE` (`QUE_ID`, `QUE_INTITULEQUESTION`, `QUE_ACTIVE`, `QUE_ORDRE`, `QUI_ID`) VALUES
(NULL, 'De quelle couleur sont les petits poids ?', 1, 5, 1);
3. UPDATE T_QUESTION_QUE SET QUE_INTITULEQUESTION='nouvelle question' WHERE QUE_ID=1;
4. UPDATE T_QUESTION_QUE SET QUE_ACTIVE=1 WHERE QUE_ID=1;
5. DELETE FROM T_QUESTION_QUE where QUE_ID=1; /* trigger pour delete toutes les reponses associé*/
6. SELECT * from T_QUESTION_QUE where QUI_ID=2 ORDER BY QUE_ORDRE;
7. UPDATE T_QUESTION_QUE SET QUE_ACTIVE=1 WHERE QUE_ID=1;
8. SELECT REP_ID, REP_REPONSE FROM T_REPONSE_REP where QUE_ID=12;
9. SELECT REP_ID, REP_REPONSE, QUI_ID, QUE_ID FROM T_REPONSE_REP join T_QUESTION_QUE using (QUE_ID) WHERE QUE_ID=1;
10. INSERT INTO `T_REPONSE_REP` (`REP_ID`, `REP_REPONSE`, `REP_VRAI`, `QUE_ID`) VALUES
(NULL, 'nouvelle réponse', 0, 1);
11. UPDATE T_REPONSE_REP SET REP_REPONSE='nouvelle reponse' WHERE REP_ID=1;
12. DELETE FROM T_REPONSE_REP where REP_ID=1;
/*
Matchs :
Sprint 1
1. Requête permettant de récupérer toutes les données (questions, choix
possibles) d’un questionnaire associé à un match dont on connaît le code
2. Requête donnant le nombre de joueurs d’un match particulier
3. Requête permettant de donner le score final d’un match particulier
4. Requête listant les scores finaux et les pseudos des joueurs d’un match
particulier
5. Requête listant tous les matchs d’un formateur en particulier (formateur
connecté)
6. Requête qui récupère tous les matchs associés à un quiz particulier
(connaissant son ID)
*/
1. SELECT MAT_ID, QUI_INTITULE, QUE_INTITULEQUESTION, QUE_ID, REP_ID,
 REP_REPONSE from T_MATCH_MAT join T_QUIZ_QUI using ( QUI_ID) left outer join T_QUESTION_QUE using(QUI_ID)
 left outer join T_REPONSE_REP using (QUE_ID) WHERE MAT_ID=1;
2. SELECT count(JOU_PSEUDO) from T_JOUEUR_JOU WHERE MAT_ID=2;
3. SELECT AVG(JOU_SCORE) from T_JOUEUR_JOU WHERE MAT_ID=2;
4. SELECT JOU_PSEUDO, JOU_SCORE from T_JOUEUR_JOU WHERE MAT_ID=2;
5. SELECT UTI_IDUTILISATEUR, MAT_ID from T_MATCH_MAT WHERE UTI_IDUTILISATEUR=3;
6. SELECT MAT_ID from T_MATCH_MAT WHERE QUI_ID=2;
/*
Matchs
Sprint 2
7. Requête d’ajout d’un match pour un quiz particulier (connaissant son ID)
8. Requête de modification d’un match
9. Requête de suppression d’un match dont on connaît l’ID (/le code)
10. Requête d’activation (/désactivation) d’un match
11. Requête(s) de « remise à zéro » (RAZ) d’un match
*/
7. INSERT INTO `T_MATCH_MAT` (`MAT_ID`, `MAT_DEBUT`, `MAT_FIN`, `UTI_IDUTILISATEUR`, `QUI_ID`, `MAT_CODE`, `MAT_CORRECTION`, `MAT_ACTIF`) VALUES
(NULL, NULL, NULL, 'quiz_id', 1, 'RUGBYATO', 0, 1);
8. UPDATE T_MATCH_MAT SET MAT_FIN=NOW() WHERE MAT_ID=2;
9. DELETE FROM T_MATCH_MAT WHERE MAT_ID=2;
10. UPDATE T_MATCH_MAT SET MAT_ACTIF=1 WHERE MAT_ID=2;
11. DELETE FROM T_JOUEUR_JOU WHERE MAT_ID=2; UPDATE T_MATCH_MAT SET MAT_FIN=NULL SET MAT_DEBUT=NULL WHERE MAT_ID=2;
