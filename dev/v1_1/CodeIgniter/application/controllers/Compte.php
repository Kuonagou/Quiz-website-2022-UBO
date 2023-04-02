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
class Compte extends CI_Controller {
public function __construct()
{
	parent::__construct();
	$this->load->model('db_model');
	$this->load->helper('url_helper');
}

public function lister() //fonction pour lister et compter tot les comptes de la base
{
	$data['titre'] = 'Liste des pseudos :';
	$data['pseudos'] = $this->db_model->get_all_compte(); //appel de la fonction qui récupère tout les comptes
	$data['count'] = $this->db_model->count_all_compte(); //appel de la fonction qui compte ne nombre de compte 

	$this->load->view('haut'); //chargement du haut de la page
	$this->load->view('menu_visiteur'); //chargement du menu visiteur pour l'instant changer pour admin plus tard une fois cet affichage place dans la partie admin 
	$this->load->view('compte_liste',$data); //chargement de la page d'affichage des comptes
	$this->load->view('bas'); // chargement du bas de page
}

public function creer()
{
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$this->form_validation->set_rules('id', 'id', 'required', array('required'=>'Veuillez saisir un identifiant !'));
	$this->form_validation->set_rules('mdp', 'mdp', 'required', array('required'=>'Veuillez saisir un mot de passe !'));

	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('haut');
		$this->load->view('menu_visiteur');
		$this->load->view('compte_creer');
		$this->load->view('bas');
	}
	else
	{
		$this->db_model->set_compte();
		$this->load->view('haut');
		$this->load->view('menu_visiteur');
		$this->load->view('compte_succes');
		$this->load->view('bas');
	}
}

public function connexion(){

	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$this->form_validation->set_rules('pseudo', 'pseudo', 'required', array('required'=>'Veuillez saisir un pseudo !'));
	$this->form_validation->set_rules('mdp', 'mdp', 'required', array('required'=>'Veuillez saisir un mot de passe !'));

	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('haut');
		$this->load->view('menu_visiteur');
		$this->load->view('compte_connexion');
		$this->load->view('basco');
	}
	else
	{
		$data['connect']=$this->db_model->is_compte();
		if($data['connect']!=NULL)
		{
			$session_data = array('username' => $this->input->post('pseudo') );
			$this->session->set_userdata($session_data);
			$this->load->view('admin/hautadmin');
			$this->load->view('admin/menu_admin');
			$this->load->view('admin/connexion_succes',$data);
			$this->load->view('admin/basadmin');
			
		}
		else
		{
			$this->load->view('haut');
			$this->load->view('menu_visiteur');
			$this->load->view('mauvaise_connexion');
			$this->load->view('compte_connexion');
			$this->load->view('basco');
		}		
	}
}

}