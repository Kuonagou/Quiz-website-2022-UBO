<div class="colr-area">
    <div class="container">
        <div class="col-md-4" data-aos="fade-up">
                <?php echo validation_errors(); ?>
                <?php echo form_open('modif_mdp2'); ?>
                <div class="row">
                    <div class="col-md-10 form-group">
                        <label for="code_match">Modifier mon mot de passe</label>
                        <input class="form-control" type="password" id="mdp_old" name="mdp_old" placeholder="Votre mot de passe actuel" /><br />
                        <input class="form-control" type="password" id="mdp1" name="mdp1" placeholder="Nouveau mot de passe" /><br />
                        <input class="form-control" type="password" id="mdp2" name="mdp2" placeholder="Confirmation du mot de passe" /><br />
                    </div>
                    <div class="col-md-1 form-group">
                    <h6><br></h6>
                    <input class="btn  btn-shadow btn-lg" type="submit" name="submit" value="Valider" /></form>
                    <br>
                    <br>
                    <a class="btn  btn-shadow btn-lg" href="<?php echo base_url();?>index.php/formateur/afficher" value="Annuler">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</div>