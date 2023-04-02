<!--===============================================================
// Nom du fichier : mauvais_code_match.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V2_2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// affichage des differents messages d'erreur suite à la saisie du code du match
//-------------------------------------------------------------
// A noter :
// fonctionne grace au retour de la fonction is_match_actif dans Match
//===============================================================-->
<?php 
foreach ($match_actif as $desactiver) {
		if ( $desactiver == NULL){  ?> 
			<div class="row">
			<div class="col-md-2 form-group"></div>
			<div class="col-md-8 form-group"><font color="purple">
			<h5>Code de match inexistant, veuillez saisir le code fourni par votre formateur !</h5></font>
			</div>
			</div>
		<?php }
			else{
				if($desactiver==0){ ?>
					<div class="row">
					<div class="col-md-2 form-group"></div>
					<div class="col-md-8 form-group"><font color="purple">
					<h5>Match désactivé ou non démarré</h5></font>
					</div>
					</div>
        
				<?php
				}
				else if ($desactiver==2){ ?>
					<div class="row">
					<div class="col-md-2 form-group"></div>
					<div class="col-md-8 form-group"><font color="purple">
					<h5>Match désactivé ou non démarré</h5></font>
					</div>
					</div>
				<?php
				}

			}
} ?>


