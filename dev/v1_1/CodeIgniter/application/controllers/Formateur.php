<!--===============================================================
// Nom du fichier : Compte.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// controller de la partie Compte du site
// 
// - fonction lister:
		appel des fontion get_all_compte et count_all_compte sans parametre qui liste les pseudo des compte et compte leur nombre
		affichage de la page des comptes avec haut menu_visiteur compte_liste et bas
// - fonction creer:
		gestion du formulaire ( vérification et récupération des paramètres)
		affichage de la page d'accueil de départ avec haut menu formulaire compte_creer et bas
		lorsque le formulaire est poste appel de la fonction pour créer le nouveau compte set_compte
		affichage de la page du succès de la démarche
// - fonction connexion:
		gestion du formulaire (vérification et récupération des paramètres)
		affichage d'un message de réussite 
		ou
		retour vers la page de départ si un problème arrive
//-------------------------------------------------------------
// A noter :
// utilisation des fonction du db_model :
//		get_all_compte	--	récupère les infos des compte de la base
//		count_all_compte	--	compte le nombre de compte présent dans la base  
//		set_compte	--	insertion dans la base de a nouvelle ligne de compte avec les info fourni par le formulaire Formateur par default
//===============================================================-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Formateur extends CI_Controller {
public function __construct()
{
	parent::__construct();
	$this->load->model('db_model');
	$this->load->helper('url_helper');
}

public function afficher()
{

	if($this->input->post('deco')=='Déconnexion'){
		
		session_destroy();
		redirect(base_url()."index.php/accueil/afficher");

	}
	else{

		if(isset($_SESSION['username'])){
			//$this->session->mark_as_temp('username', 300);
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']); 
			
			if($data['forma']!=NULL){
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/formateur/menu_formateur');
				$this->load->view('admin/formateur/formateur_accueil',$data);
				$this->load->view('admin/basadmin');
			}
			else{
				session_destroy();
				redirect(base_url()."index.php/compte/connexion");
			}	
			
		}
		else{
			redirect(base_url()."index.php/accueil/afficher");
		}

	}
}

public function info()
{

	if($this->input->post('deco')=='Déconnexion'){
		
		session_destroy();
		redirect(base_url()."index.php/accueil/afficher");

	}
	else{

		if(isset($_SESSION['username'])){
			//$this->session->mark_as_temp('username', 300);
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']); 
			
			if($data['forma']!=NULL){
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/formateur/menu_formateur');
				$this->load->view('admin/formateur/formateur_info',$data);
				$this->load->view('admin/basadmin');
			}
			else{
				session_destroy();
				redirect(base_url()."index.php/compte/connexion");
			}	
			
		}
		else{
			redirect(base_url()."index.php/accueil/afficher");
		}

	}
}

public function match()
{

	if($this->input->post('deco')=='Déconnexion'){
		
		session_destroy();
		redirect(base_url()."index.php/accueil/afficher");

	}
	else{

		if(isset($_SESSION['username'])){
			//$this->session->mark_as_temp('username', 300);
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']); 
			$data['match1']=$this->db_model->get_all_info_match_donne();
			
			if($data['forma']!=NULL){
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/formateur/menu_formateur');
				$this->load->view('admin/formateur/form_match',$data);
				$this->load->view('admin/basadmin');
			}
			else{
				session_destroy();
				redirect(base_url()."index.php/compte/connexion");
			}	
			
		}
		else{
			redirect(base_url()."index.php/accueil/afficher");
		}

	}
}

public function gestion()
{

	if($this->input->post('deco')=='Déconnexion'){
		
		session_destroy();
		redirect(base_url()."index.php/accueil/afficher");

	}
	else{

		if(isset($_SESSION['username'])){
			//$this->session->mark_as_temp('username', 300);
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']); 
			$data['match1']=$this->db_model->get_all_info_match_donne();
			
			if($data['forma']!=NULL){
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/formateur/menu_formateur');
				$this->load->view('admin/formateur/gestion_match',$data);
				$this->load->view('admin/basadmin');
			}
			else{
				session_destroy();
				redirect(base_url()."index.php/compte/connexion");
			}	
			
		}
		else{
			redirect(base_url()."index.php/accueil/afficher");
		}

	}
}
}