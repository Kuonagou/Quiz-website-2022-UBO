<!--===============================================================
// Nom du fichier : compte_connexion.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// formulaire permettant de se connecter à son compte 
//-------------------------------------------------------------
// A noter :
// il faudra ensuite la relier au bouton de connexion et dans la partie controleur vérifier le passage du mot de passse en sha + sel
//===============================================================-->

<section id="features" class="bg-white">
    <div class="container">
        <div class="section-content"><h3> Connexion</h3><br>
        	<div class="col-md-4" data-aos="fade-up">

				<?php echo validation_errors(); ?>
				<?php echo form_open('compte_connexion'); ?> 

				<label for="pseudo">Identifiant</label>
				<input class="form-control" type="input" name="pseudo" /><br />
				<label for="mdp">Mot de passe</label>
				<input class="form-control" type="password" name="mdp" /><br />
				<input class="btn btn-primary btn-shadow btn-lg" type="submit" name="submit" value="Me connecter" />
				</form>
			</div>
		</div>
	</div>
</section>
