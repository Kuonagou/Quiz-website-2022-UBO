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

public function match($donnee)
{

	if($this->input->post('deco')=='Déconnexion'){
		
		session_destroy();
		redirect(base_url()."index.php/accueil/afficher");

	}
	else{

		if(isset($_SESSION['username'])){
			//$this->session->mark_as_temp('username', 300);
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']); 
			$data['match1']=$this->db_model->get_all_info_match_code($donnee);
			$data['score']=$this->db_model->score_match($donnee);
			
			if($data['forma']!=NULL){
				if($data['match1']!=null){
					$this->load->view('admin/hautadmin');
					$this->load->view('admin/formateur/menu_formateur');
					$this->load->view('admin/formateur/form_match',$data);
					$this->load->view('admin/basadmin');
				}
				else{
					$this->load->view('admin/hautadmin');
					$this->load->view('admin/formateur/menu_formateur');
					$this->load->view('admin/formateur/gestion_match',$data);
					$this->load->view('admin/basadmin');
				}
				
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
	$this->load->library('form_validation');
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

public function crud_match()
{	
	$this->load->library('form_validation');
	if($this->input->post('deco')=='Déconnexion'){
		
		session_destroy();
		redirect(base_url()."index.php/accueil/afficher");

	}
	else{

		if(isset($_SESSION['username'])){
			$code=$this->input->post('code');
			$actif=$this->input->post('activ');
			$zero=$this->input->post('remise_zero');
			$sup=$this->input->post('supprimer');
			//$this->session->mark_as_temp('username', 300);
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']); 
			

			if($data['forma']!=NULL){

					if($actif!=null){
						$this->db_model->activ($actif,$code);
						$data['act']=$actif;
					}else{
						if($zero!=null){
							$this->db_model->reset($zero);
							$data['raz']=$zero;
						}else{
							if($sup!=null){
								$this->db_model->delet($sup);
								$data['sup']=$sup;
							}
						}
				}
				$data['match1']=$this->db_model->get_all_info_match_donne();
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

public function creation_match()
{
	
	$this->load->library('form_validation');

	if($this->input->post('deco')=='Déconnexion'){
		
		session_destroy();
		redirect(base_url()."index.php/accueil/afficher");

	}
	else{

		if(isset($_SESSION['username'])){
			//$this->session->mark_as_temp('username', 300);
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']); 
			

			if($data['forma']!=NULL){

				$data['match1']=$this->db_model->get_all_info_match_donne();
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/formateur/menu_formateur');
				$this->load->view('admin/formateur/new_match',$data);
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
				$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']); 
				if($data['forma']!=NULL){
					$this->load->view('admin/hautadmin');
					$this->load->view('admin/formateur/menu_formateur');
					$this->load->view('admin/formateur/modif_mdp_form');
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
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']);
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/menu_formateur');
				$this->load->view('admin/mdp_succes_form',$data);
				$this->load->view('admin/modif_mdp_form');
				$this->load->view('admin/basadmin');

			
		}
		else{
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']);
				$this->load->view('admin/hautadmin');
				$this->load->view('admin/formateur/menu_formateur');
				$this->load->view('admin/formateur/mdp_erreur',$data);
				$this->load->view('admin/formateur/modif_mdp');
				$this->load->view('admin/basadmin');
		}

	}
}

public function crea()
{
	$this->load->library('form_validation');
	$data['match1']=$this->db_model->get_all_info_match_donne();
	$this->form_validation->set_rules('id_quiz', 'id_quiz', 'required|in_list[1,3,4,7,8,9]', array('required'=>'Veuillez saisir un identifiant !'));

	if($this->input->post('deco')=='Déconnexion'){
		
		session_destroy();
		redirect(base_url()."index.php/accueil/afficher");

	}
	else{

		if(isset($_SESSION['username'])){
			//$this->session->mark_as_temp('username', 300);
			$data['forma']=$this->db_model->get_all_info_formateur($_SESSION['username']); 
			
			if($data['forma']!=NULL){
				if ($this->form_validation->run() == FALSE)
					{	
						$this->load->view('admin/hautadmin');
						$this->load->view('admin/formateur/menu_formateur');
						$this->load->view('admin/formateur/new_match',$data);
						$this->load->view('admin/basadmin');
					}
					else
					{	
						$code_match=rand(20, 30).substr($_SESSION['username'], 0, 3).rand(100, 500);
						$id=$this->input->post('id_quiz');
								$this->db_model->new_match($id,$data['forma']->UTI_IDUTILISATEUR,$code_match);
								$this->load->view('admin/hautadmin');
								$this->load->view('admin/formateur/menu_formateur');
								$this->load->view('admin/match_succes');
								$this->load->view('admin/formateur/new_match',$data);
								$this->load->view('admin/basadmin');
						
					}			
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