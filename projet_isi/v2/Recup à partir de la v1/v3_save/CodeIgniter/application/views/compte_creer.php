<!--===============================================================
// Nom du fichier : compte_creer.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// formulaire permettant de créer un compte pour l'instant sans aucune vérification
//-------------------------------------------------------------
// A noter :
// il faudra ensuite la relier au bouton de connexion et dans la partie controleur vérifier le passage du mot de passse en sha + sel
//===============================================================-->

<section id="features" class="bg-white">
    <div class="container">
        <div class="section-content">
        	<div class="col-md-4" data-aos="fade-up">

				<?php echo validation_errors(); ?>
				<?php echo form_open('compte_creer'); ?>

				<label for="id">Identifiant</label>
				<input class="form-control" type="input" name="id" /><br />
				<label for="mdp">Mot de passe</label>
				<input class="form-control" type="input" name="mdp" /><br />
				<input class="btn btn-primary btn-shadow btn-lg" type="submit" name="submit" value="Créer un compte" />
				</form>
			</div>
		</div>
	</div>
</section>
