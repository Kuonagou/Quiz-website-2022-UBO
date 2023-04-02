<!--===============================================================
// Nom du fichier : compte_liste.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// affichage sous forme d'une liste de tout les pseudo des compte de la base et de leur nombre
// et de aucun compte si la base est vide
//-------------------------------------------------------------
// A noter :
// servia par la suite dans la partie admin pour gérer les comptes
//===============================================================-->

<section id="features" class="bg-white">
    <div class="container">
    	<div class="section-content">
			<h1><?php echo $titre;?></h1>
			<br />
			<p>Il y a actuellement  <?php echo $count->nombreCompte; ?> comptes sur la plateforme.</p>
			<?php
			if($pseudos != NULL) {
				foreach($pseudos as $login){
					echo "<br />";
					echo " -- ";
					echo $login["UTI_PSEUDO"];
					echo " -- ";
					echo "<br />";
				}
			}
			else {
					echo "<br />";
					echo "Aucun compte !";
			}
			?>
		</div>
	</div>
</section>