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
class Admin extends CI_Controller {
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
			$data['admin']=$this->db_model->get_all_info_admin($_SESSION['username']);
			if($data['admin']!=NULL){
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/menu_admin');
				$this->load->view('admin/admin_accueil',$data);
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
			$data['admin']=$this->db_model->get_all_info_admin($_SESSION['username']); 
			
			if($data['admin']!=NULL){
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/menu_admin');
				$this->load->view('admin/admin_info',$data);
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

public function mdp()
{
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$this->form_validation->set_rules('mdp_old', 'mdp_old', 'required', array('required'=>'Votre précédant mot de passe est manquant !'));
	$this->form_validation->set_rules('mdp1', 'mdp1', 'required', array('required'=>'Veuillez saisir un nouveau mot de passe !'));
	$this->form_validation->set_rules('mdp2', 'mdp2', 'required', array('required'=>'Veuillez saisir à nouveau votre nouveau mot de passe !')); 

	if ($this->form_validation->run() == FALSE)
	{
		if($this->input->post('deco')=='Déconnexion'){
			
			session_destroy();
			redirect(base_url()."index.php/accueil/afficher");

		}
		else{

			if(isset($_SESSION['username'])){
				//$this->session->mark_as_temp('username', 300);
				$data['admin']=$this->db_model->get_all_info_admin($_SESSION['username']); 
				if($data['admin']!=NULL){
					$this->load->view('admin/hautadmin');
					$this->load->view('admin/menu_admin');
					$this->load->view('admin/modif_mdp',$data);
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
	else{
		$vieu_mdp=$this->input->post('mdp_old');
		$premier=$this->input->post('mdp1');
		$deuxieme=$this->input->post('mdp2');
		if($vieu_mdp!=$premier && $premier==$deuxieme){
			$data['newmdp']=$this->db_model->change_password();
			$data['admin']=$this->db_model->get_all_info_admin($_SESSION['username']);
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/menu_admin');
				$this->load->view('admin/mdp_succes',$data);
				$this->load->view('admin/modif_mdp');
				$this->load->view('admin/basadmin');			
		}
		else{
			$data['admin']=$this->db_model->get_all_info_admin($_SESSION['username']);
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/menu_admin');
				$this->load->view('admin/mdp_erreur',$data);
				$this->load->view('admin/modif_mdp');
				$this->load->view('admin/basadmin');
		}

	}
}

public function lister() //fonction pour lister et compter tot les comptes de la base
{
	if($this->input->post('deco')=='Déconnexion'){
			
		session_destroy();
		redirect(base_url()."index.php/accueil/afficher");

	}
	else{

		if(isset($_SESSION['username'])){
			//$this->session->mark_as_temp('username', 300);
			$data['admin']=$this->db_model->get_all_info_admin($_SESSION['username']);
			if($data['admin']!=NULL){ 
				$data['titre'] = 'Liste des pseudos :';
				$data['pseudos'] = $this->db_model->get_all_compte(); //appel de la fonction qui récupère tout les comptes
				$data['count'] = $this->db_model->count_all_compte(); //appel de la fonction qui compte ne nombre de compte 

				$this->load->view('admin/hautadmin');
				$this->load->view('admin/menu_admin'); //chargement du menu visiteur pour l'instant changer pour admin plus tard une fois cet affichage place dans la partie admin 
				$this->load->view('compte_liste',$data); //chargement de la page d'affichage des comptes
				$this->load->view('admin/basadmin'); // chargement du bas de page
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