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

public function reponse()
{
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		

		$this->load->view('haut');
		$this->load->view('menu_visiteur');
		//$this->load->view('score',$data);
		$this->load->view('pas_encore_implementer');
		$this->load->view('bas');
}

}
?>

<!--

/*$score=0;
		$this->form_validation->set_rules('match', 'match', 'required', array('required'=>'Problème de transmission du code du match'));


		$nb=0;
		$i=0;
		$data['ques']=$this->db_model->get_count_match_idque($this->input->post('match'));
		$code=$this->input->post('match'); ///ici je récupère le code du match...
		foreach($data['ques'] as $id){
			//print_r($id);
			//var_dump($id);
			$this->form_validation->set_rules($id, $id, 'required', array('required'=>'pas de réponse au question'));
			$liste=$this->input->post($id);/////////je récupère le pseudo et le code du match
			print_r($liste);
			foreach($liste as $value){
				$nb=$nb+$this->db_model->get_player_answer($code,$value);
	            echo "<br>";
	            $i++;
	        }
		}
		   
		 	$liste=$this->input->post(NULL,true);/////////je récupère le pseudo et le code du match
	$nb=0;
	$i=0;
	
	foreach($liste as $value){
		var_dump($value);
	/*echo $this->db_model->vrai_reponse($code,$value);
                           $nb=$nb+$this->db_model->vrai_reponse($code,$value);
                           echo "<br>";
                           $i++;*/
	} 
		/*$liste=$this->input->post(NULL,true);

		$data['nb']=$this->db_model->get_count_match_nbque($this->input->post('match'));
		$data['ques']=$this->db_model->get_count_match_idque($this->input->post('match'));
		foreach($data['ques'] as $id){
			while ( $rep=$this->input->post($id["QUE_ID"]) !=FALSE  ){
				if($rep){
					$score=$score+1;
				}
			}
		}
		echo "on score ".$score;*/
		/*	$data['rep']=$this->db_model->get_player_answer('QUE_ID',3);

		foreach ($data['rep'] as $row)
		{ 
			echo $row->QUE_ID;
		}*/
		
		/*
			echo "\n".$id['QUE_INTITULEQUESTION'];
            $save=array('$id["QUE_INTITULEQUESTION"]' => );
        }*/

/*
        foreach($this->input->post('check_service') as $ser) {
            $data[]['service'] = $ser;
        }

        $checked_services['services'] = $data;
		$data['nb']=$nb;*/ -->