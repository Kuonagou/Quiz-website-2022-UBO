<!--===============================================================
// Nom du fichier : Match.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// controller de la partie Match du site
// 
// - fonction afficher:
		gestion du formulaire ( vérification et récupération des paramètres)
		affichage de la page de création du pseudo avec haut menu pseudo_match et bas
		lorsque le formulaire est poster vérification de l'existance du match si aucune correspondance rechargement de la page avec mauvais code de match (possible d'enlever ?? déjà fait dans accueil il me semble)
		si le match à bien une correspondance on verifie si le pseudo du joueur n'est pas présent dans la base et on affiche soit le message d'ereur pour permettre le choix d'un nouveau pseudo soit les données du match choisit
//-------------------------------------------------------------
// A noter :
// utilisation des fonction du db_model : 
//		get_all_info_match	--	récupère toutes les info d'un match en particulier dont le code est fourni par le formulaire
//		is_match_actif	--	verifie si oui ou non le code du match fourni par le formulaire est actif
//		get_id_match	--	recupère l'id d'un match à partir de son code
//		set_joueur	--	insert un joueur dans la base de données avec le pseudo fourni par le formulaire
//===============================================================-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Match extends CI_Controller {
public function __construct()
{
	parent::__construct();
	$this->load->model('db_model');
	$this->load->helper('url');
}
public function afficher()
{


		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('code_match', 'code_match', 'required', array('required'=>'Problème de transmission du code du match'));
		$this->form_validation->set_rules('pseudo', 'pseudo', 'trim|required|alpha_numeric|max_length[10]', array('required'=>'Veuillez saisir un pseudo !'));
		$data['pseudo']=$this->input->post('pseudo');
		$data['code']=$this->input->post('code_match');

		if ($this->form_validation->run() == FALSE)
		{
			$data['match']=$this->db_model->get_all_info_match();
			$this->load->view('haut');
			$this->load->view('menu_visiteur');
			$this->load->view('pseudo_match',$data);
			$this->load->view('bas');
				
		}
		else{
			$data['match']=$this->db_model->get_all_info_match();
			$data['actif']=$this->db_model->is_match_actif();
			if($data['match']==NULL){

				$this->load->view('haut');
				$this->load->view('menu_visiteur');
				$this->load->view('mauvais_code_match',$data);
				$this->load->view('bas');
			}
			else{
				$data['joueur']=$this->db_model->is_joueur();

				if($data['joueur']== NULL){

					$data['idmatch']=$this->db_model->get_id_match();
					$this->db_model->set_joueur($data['idmatch']->MAT_ID);

					$this->load->view('haut');
					$this->load->view('menu_visiteur');
					$this->load->view('page_match',$data);
					$this->load->view('bas');
				}
				else{
					$this->load->view('haut');
					$this->load->view('menu_visiteur');
					$this->load->view('mauvais_pseudo_joueur');
					$this->load->view('pseudo_match',$data);
					$this->load->view('bas');
				}
			}
	}
}

public function jouer()
{

	$score=0;
	$nb=0;
		$this->load->helper('form');
		$this->load->library('form_validation');

		$pseudo=$this->input->post('pseudo');
		$code=$this->input->post('code');
		$data['rep'] = $this->input->post(NULL, true);

		foreach($data['rep'] as $r){
			if($r != $code && $r != $pseudo ){
				$score=$r+$score;
				$nb++;
			}
		}
		if($nb >0){
			$score=$score*100/$nb;
			$score=round($score);
			$this->db_model->set_score_joueur($score,$pseudo);
		}
		$data['score']=$score;

		$this->load->view('haut');
		$this->load->view('menu_visiteur');
		$this->load->view('jou_reussi',$data);
		$this->load->view('bas');

}


}
?>
