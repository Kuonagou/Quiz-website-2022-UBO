<!--===============================================================
// Nom du fichier : Accueil.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// controller de la partie Accueil du site
// 
// - fonction afficher:
		gestion du formulaire ( vérification et récupération des paramètres)
		affichage de la page d'accueil de départ avec haut menu formulaire page_accueil et bas
		lorsque le formulaire est poster vérification si le quiz est actif ou non ( si oui, passge au formulaire suivant géré par Match - si non, retour avec message d'erreur avec la view mauvais_code_match )
		affichage si on passe l'id de l'actualité en paramètre à la description d'une actualité en particulier
//-------------------------------------------------------------
// A noter :
// utilisation des fonction du db_model :
		get_all_actualite	--	récupère toutes les infos des 5 dernière actulité de la base
		get_all_match	--	récupère les id de tout les match de la base  
		get_all_info_match	--	récupère toutes les info d'un match en particulier dont le code est fourni par le formulaire
		is_match_actif	--	verifie si oui ou non le code du match fourni par le formulaire est actif
		get_actualite($act_id)	--	recupère les infos d'une actualite en particulier à partir de son id
//===============================================================-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accueil extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('db_model');
		$this->load->helper('url');
	}
	
	public function afficher($numero=FALSE)
	{
		if ($numero==FALSE)
		{	
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('code_match', 'code_match', 'required', array('required'=>'Veuillez saisir un code de match !'));
			$data['idmatch']=$this->db_model->get_all_match();

			if ($this->form_validation->run() == FALSE)
			{
				$data['actu']=$this->db_model->get_all_actualite();
				
		
				$this->load->view('haut');
				$this->load->view('menu_visiteur');
				$this->load->view('formulaire_match',$data);
				$this->load->view('page_accueil',$data);
				$this->load->view('bas');
			}
			else
			{	
					$data['match']=$this->db_model->get_all_info_match();
					$data['match_actif']=$this->db_model->is_match_actif();

					if($data['match']!=NULL && $data['match_actif']->actif==1){

						$this->load->view('haut');
						$this->load->view('menu_visiteur');
						$this->load->view('pseudo_match',$data);
						$this->load->view('bas');
					}
					else{

						$data['actu']=$this->db_model->get_all_actualite();
						$data['actif']=$this->db_model->is_match_actif();
		
						$this->load->view('haut');
						$this->load->view('menu_visiteur');
						$this->load->view('formulaire_match',$data);
						$this->load->view('mauvais_code_match',$data);
						$this->load->view('page_accueil',$data);
						$this->load->view('bas');
					}
			}
		}
		else{
			$data['titre'] = 'Actualité :';
			$data['actu'] = $this->db_model->get_actualite($numero);
			$this->load->view('haut');
			$this->load->view('actualite_afficher',$data);
			$this->load->view('bas');
		}
	}
}
?>