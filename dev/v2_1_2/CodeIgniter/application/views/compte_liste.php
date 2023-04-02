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
			if($pseudos != NULL) { ?>
			<table class="table">
			    <thead>
			        <tr>
			            <th>Pseudo</th>
			            <th>Nom</th>
			            <th>Prenom</th>
			            <th>Mail</th>
			            <th>Role</th>
			            <th>Actif</th>
			        </tr>
			    </thead>
			    <tbody><?php
				foreach($pseudos as $login){?>
					<tr>
			            <td><?php echo $login["UTI_PSEUDO"];?></td>
			            <td><?php echo $login["PRO_NOM"];?></td>
			            <td><?php echo $login["PRO_PRENOM"];?></td>
			            <td><?php echo $login["PRO_MAIL"];?></td>
			            <td><?php echo $login["UTI_ROLE"];?></td>
			            <td><?php echo $login["UTI_ETAT"];?></td>
			        </tr>
					<?php
				}
				?></tbody>
			</table><?php
			}
			else {
					echo "<br />";
					echo "Aucun compte !";
			}
			?>   
		</div>
	</div>
</section>