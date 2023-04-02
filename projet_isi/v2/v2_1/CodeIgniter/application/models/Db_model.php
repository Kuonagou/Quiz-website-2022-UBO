<!--===============================================================
// Nom du fichier : Db_model.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// Toutes les fonctions intéragissant directement avec la base de données.
//  -__construct : récupère le chemin de la base de donnée
//
// 	-get_all_actualite : récupère toutes les information sur les 5 dernières actuelités postées
//	-get_actualite : récupère les infos d'une actualité dont l'id est passé en paramètre
//
//	-get_all_match : récupère les id de tout les match présent dans la base
//  -get_all_info_match : récupère toutes les infos d'un match dont le code est récupérer par un formulaire
//  -is_match_actif : appelle la fonction match_actif de la base de données 1 actif 0 desactivé 2 pas avec le code du match récupérer par un formulaire
//	-get_id_match : récupère l'id d'un match à partir de son code fourni par le formulaire (fonctionne avec set_joueur)
//
//  -is_joueur : test si le pseudo passer dans le formulaire est déjà présent dans la base pour le code de match passer aussi par formulaire
//	-set_joueur : fonction qui insert un joueur dans la base à partir du pseudo fourni par le formulaire et de l'id du match récupérer avec fonction get_id_match passe en paramettre
//
//	-get_all_compte : fonction qui récupère toutes les infos de tout les comptes de la base
//	-count_all_compte : fonction qui compte le nombre de compte dans la base
//	-set_compte : fonction qui insert un compte dans la base
//-------------------------------------------------------------
// A noter :
// -SEUL fichier avec des requetes SQL
// -Tout les noms de fonction en anglais pour bien les séparer du reste
//===============================================================-->

<?php 
class Db_model extends CI_Model {
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	}

/* fonctions qui gèrent les actuactualité */

	public function get_all_actualite()
	{
	$query = $this->db->query("SELECT ACT_ID ,ACT_TITRE, ACT_CONTENU, ACT_NEWDATE, UTI_PSEUDO,UTI_IDUTILISATEUR FROM T_ACTUALITE_ACT join T_UTILISATEUR_UTI USING (UTI_IDUTILISATEUR) limit 5;");
	/*test de bon execution requette*/
	return $query->result_array();
	}

	public function get_actualite($numero)
	{
		$query = $this->db->query("SELECT ACT_ID,ACT_CONTENU FROM T_ACTUALITE_ACT WHERE
		ACT_ID=".$numero.";");
		return $query->row();
	}

/* fonctions qui gère les matchs */

	public function get_all_match(){

	$query = $this->db->query("SELECT * FROM T_MATCH_MAT join T_QUESTION_QUE using(QUI_ID) join T_REPONSE_REP using(QUE_ID);");
	/*test de bon execution requette*/
	return $query->result_array();
	}

	public function new_match($id_quiz,$id_formateur,$code_match){

 	$date = new \DateTime();
 	$new=$date->format('Y-m-d H:i:s');
	$query = $this->db->query("INSERT INTO T_MATCH_MAT VALUES (NULL,'$new',NULL,$id_formateur,$id_quiz,'$code_match',0,0);");
	/*test de bon execution requette*/ 

	}

	public function get_all_info_match_code($donnee){

	$query = $this->db->query("SELECT *,NOM_id(T_QUIZ_QUI.UTI_IDUTILISATEUR) as createurquiz,NOM_id(T_MATCH_MAT.UTI_IDUTILISATEUR) as createurmatch, T_REPONSE_REP.QUE_ID as idquestionrep,T_QUESTION_QUE.QUE_ID as idrepquestion from T_MATCH_MAT join T_QUIZ_QUI using (QUI_ID) left outer join T_QUESTION_QUE using(QUI_ID) left outer join T_REPONSE_REP using (QUE_ID) where MAT_CODE='$donnee';");
	//test de bon execution requette
	return $query->result_array();
	}
	public function get_all_info_match_que($donnee){

	$query = $this->db->query("SELECT *, COUNT(QUE_ID) as nbquestion from T_MATCH_MAT join T_QUESTION_QUE using(QUI_ID) where MAT_CODE='$donnee';");
	//test de bon execution requette
	return $query->result_array();
	}

	public function get_all_info_match_donne(){

	$query = $this->db->query("SELECT *,NOM_id(T_QUIZ_QUI.UTI_IDUTILISATEUR) as createurquiz,NOM_id(T_MATCH_MAT.UTI_IDUTILISATEUR) as createurmatch, T_REPONSE_REP.QUE_ID as idquestionrep,T_QUESTION_QUE.QUE_ID as idrepquestion from T_MATCH_MAT join T_QUIZ_QUI using (QUI_ID) left outer join T_QUESTION_QUE using(QUI_ID) left outer join T_REPONSE_REP using (QUE_ID);");
	//test de bon execution requette
	return $query->result_array();
	}

	public function get_true_rep($rep){

	$query = $this->db->query("SELECT * FROM T_QUESTION_QUE WHERE REP_REPONSE='$rep' and REP_VRAI='1';");
	//test de bon execution requette
	return $query->result_array();
	}

	public function get_all_info_match(){
	
	$code=$this->input->post('code_match');

	$query = $this->db->query("SELECT *,NOM_id(T_QUIZ_QUI.UTI_IDUTILISATEUR) as createurquiz,NOM_id(T_MATCH_MAT.UTI_IDUTILISATEUR) as createurmatch, T_REPONSE_REP.QUE_ID as idquestionrep,T_QUESTION_QUE.QUE_ID as idrepquestion from T_MATCH_MAT join T_QUIZ_QUI using (QUI_ID) left outer join T_QUESTION_QUE using(QUI_ID) left outer join T_REPONSE_REP using (QUE_ID) WHERE MAT_CODE='$code';");
	/*test de bon execution requette*/
	return $query->result_array();
	}

	public function is_match_actif(){
		$code=$this->input->post('code_match');

		$query = $this->db->query("select match_actif('$code') as actif;");
	/*test de bon execution requette*/
	return $query->row();
	}

	public function get_id_match(){
	
	$code=$this->input->post('code_match');
 
	/*test de bon execution requette*/
	$query = $this->db->query("SELECT MAT_ID FROM T_MATCH_MAT WHERE MAT_CODE='$code';");
	return $query->row();
	}

	public function reset($code){

 	$date = new \DateTime();
 	$date->modify("+3 days");
 	$new=$date->format('Y-m-d H:i:s');
	$query = $this->db->query("UPDATE T_MATCH_MAT SET MAT_DEBUT='$new', MAT_FIN=NULL WHERE MAT_CODE='$code';");
	/*test de bon execution requette*/ 

	}

	public function delet($code){
 
	$query1 = $this->db->query("DELETE FROM T_JOUEUR_JOU WHERE MAT_ID=id_match('$code');");
	$query = $this->db->query("DELETE FROM T_MATCH_MAT WHERE MAT_CODE='$code';");
	/*test de bon execution requette*/ 

	}

	public function activ($activ,$code){
 
	
	$query = $this->db->query("UPDATE T_QUIZ_QUI join T_MATCH_MAT using(QUI_ID) SET QUI_ACTIF='$activ' WHERE MAT_CODE='$code'  ;");
	/*test de bon execution requette*/ 
	return ($query);
	}

/* fonctions qui gère les joueurs */

	public function is_joueur(){ /* test si un pseudo est déjà attribuer à un joeur dans ce match */
	
	$code=$this->input->post('code_match');
	$pseudo=$this->input->post('pseudo');

	$query = $this->db->query("SELECT JOU_ID FROM T_JOUEUR_JOU join T_MATCH_MAT using(MAT_ID) WHERE MAT_CODE='ANG456TE' and UPPER(JOU_PSEUDO) like '$pseudo';");/*si pas de retour alors le pseudo n'est pas déjà utiliser */
	/*test de bon execution requette*/
	
	}

	public function set_joueur($idmatch){
	
	$pseudo=$this->input->post('pseudo');

	$query = $this->db->query("INSERT INTO T_JOUEUR_JOU VALUES (NULL,'$pseudo',NULL,'$idmatch');");/*(`JOU_ID`, `JOU_PSEUDO`, `JOU_SCORE`, `MAT_ID`)*/
 
	/*test de bon execution requette*/
	return ($query);
	}

	public function score_match($code){

	$query = $this->db->query("SELECT AVG(JOU_SCORE) as scorem from T_JOUEUR_JOU join T_MATCH_MAT using (MAT_ID) WHERE MAT_CODE='$code' and JOU_SCORE is not null;");
	/*test de bon execution requette*/
	return $query->row();
	}

/* fonctions qui gèrent les comptes */

	public function get_all_compte()
	{
	$query = $this->db->query("SELECT * FROM T_UTILISATEUR_UTI left outer join T_PROFIL_PRO using (UTI_IDUTILISATEUR);");
	return $query->result_array(); //si une seule ligne $query->row() et donc pas de boucle dans l'affichage echo $actu->new_num;
	}

	public function count_all_compte()
	{
		$query = $this->db->query("SELECT count(UTI_PSEUDO) as nombreCompte FROM T_UTILISATEUR_UTI;");
		return $query->row();
	}

	public function set_compte()
	{
		$this->load->helper('url');
		$id=$this->input->post('id');
		$mdp=$this->input->post('mdp');
		$salt = "MOnsel1589647franprotec897";
		$password = hash('sha256', $salt.$mdp);

		$req="INSERT INTO T_UTILISATEUR_UTI VALUES (NULL,'".$id."','".$password."','F','D');"; //UTI_IDUTILISATEUR`, `UTI_PSEUDO`, `UTI_MDP`, `UTI_ROLE`, `UTI_ETAT`
		$query = $this->db->query($req);
		return ($query);
	}

	public function is_compte()
	{
		$pseudo=$this->input->post('pseudo');
		$mdp=$this->input->post('mdp');
		$salt = "MOnsel1589647franprotec897";
		$password = hash('sha256', $salt.$mdp);

		$query = $this->db->query("SELECT * FROM T_UTILISATEUR_UTI WHERE UTI_PSEUDO='$pseudo' and UTI_MDP='$password';");
		return $query->row();
	}

/* fonctions qui gèrent les formateurs */

	public function get_all_info_formateur($donnee)
	{

		$query = $this->db->query("SELECT * FROM T_UTILISATEUR_UTI left outer join T_PROFIL_PRO using(UTI_IDUTILISATEUR) WHERE UTI_PSEUDO='$donnee' and UTI_ROLE='F';");
		return $query->row();
	} 
/* fonctions qui gèrent ce qui concerne les administrateur*/
	
	public function get_all_info_admin($donnee)
	{
		$query = $this->db->query("SELECT * FROM T_UTILISATEUR_UTI left outer join T_PROFIL_PRO using(UTI_IDUTILISATEUR) WHERE UTI_PSEUDO='$donnee' and UTI_ROLE='A';");
		return $query->row();
	}

	public function change_password()
	{
		$vieu_mdp=$this->input->post('mdp_old');
		$premier=$this->input->post('mdp1');
		$deuxieme=$this->input->post('mdp2');
		if($premier==$deuxieme){
			$salt = "MOnsel1589647franprotec897";
			$prem = hash('sha256', $salt.$premier);
			$vieu = hash('sha256', $salt.$vieu_mdp);

			$query = $this->db->query("UPDATE T_UTILISATEUR_UTI SET UTI_MDP='$prem' WHERE UTI_MDP='$vieu'");
		}
	}
}
?>