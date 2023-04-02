<!--===============================================================
// Nom du fichier : formulaire_match.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V2_2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// formulaire de saisie du code du match présent sur la page d'acceuil
// et affichage si jamais aucun match n'est présent dans la base
//-------------------------------------------------------------
// A noter :
//
//===============================================================-->

<section id="features" class="bg-white">
    <div class="container">
        <div class="section-content">
            <div class="col-md-4" data-aos="fade-up">
            <?php if(isset($idmatch)){ ?>

                
                <?php echo validation_errors(); ?>
                <?php echo form_open('formulaire_match'); ?>
                <div class="row">
                    <div class="col-md-10 form-group">
                        <label for="code_match">Participer à un match</label>
                        <input class="form-control" type="input" id="code_match" name="code_match" placeholder="Code du match" /><br />
                    </div>
                    <div class="col-md-1 form-group">
                        <h6><br></h6>
                        <input class="btn btn-primary btn-shadow btn-lg" type="submit" name="submit" value="Valider" />
                                </form>
                    </div>
                </div>
            <?php }
            else { ?> 
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-1 form-group"></div>
                        <div class="col-md-8 form-group"><font color="purple">
                            <h5>Aucun match pour l'instant !</h5></font>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</section>