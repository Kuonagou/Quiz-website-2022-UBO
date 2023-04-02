<!--===============================================================
// Nom du fichier : pseudo_match.php
// Auteur : A.GOUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V2_2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// affichage du formulaire pour rentrer son pseudo
// recupération et transmission caché du code du match saisie précédement
//-------------------------------------------------------------
// A noter :
// la partie en php avec isset et traiter permet de ne pas boucler et de récupérer une seule fois le code du match
//===============================================================-->

<section id="features" class="bg-white">
    <div class="container">
        <div class="section-content">
            <div class="col-md-4 form-group" data-aos="fade-up">
                
                <?php echo validation_errors(); ?>
                <?php echo form_open('pseudo_match'); ?>
                <div class="row">
                    <div class="col-md-10 form-group">
                        <label for="pseudo">Entrer votre Pseudo</label>
                        <input class="form-control" type="input" id="pseudo" name="pseudo" placeholder="Entrer un pseudo" /><br />
                        <input class="form-control" type="hidden" id="code_match" name="code_match" value="<?php 
                        if ($match != NULL){ 
                            foreach($match as $m) {  
                                if (!isset($traiter[$m["MAT_CODE"]])){ 
                                    echo $m['MAT_CODE'];
                                } 
                                $traiter[$m["MAT_CODE"]]=1;
                            } 
                        }?>" /><br />
                    </div>
                    <div class="col-md-1 form-group">
                        <h6><br></h6>
                        <input class="btn btn-primary btn-shadow btn-lg" type="submit" name="submit" value="Valider" />
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>