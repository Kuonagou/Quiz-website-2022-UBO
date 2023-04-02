<!--===============================================================
// Nom du fichier : mauvais_connexion.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V2_2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// affichage d'un message d'erreur lors d'une mauvaise connexion
//-------------------------------------------------------------
// A noter :
// 
//===============================================================-->

    <div class="section-content">
		<div class="row">
			<div class="col-md-1 form-group"></div>
			<div class="col-md-8 form-group"><font color="purple">
				<?php if($connect != null){
					?><h5>Ce compte est actuellement désactivé.</h5><?php
				}else{
					?><h5>Vous n'avez pas de compte chez nous.</h5><?php
				}?>
			</div>
		</div>
	</div>
