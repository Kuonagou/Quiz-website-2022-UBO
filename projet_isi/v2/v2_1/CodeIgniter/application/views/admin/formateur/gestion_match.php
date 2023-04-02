<div class="colr-area">
    <div class="container">
        <div class="section-content">
            <h3>Mes quiz et Match</h3>
             <table class="table">
                <thead>
                    <tr>
                   <th>Créateur quiz</th>
                   <th></th>
                  <th>Titre quiz</th>
                  <th>Créateur match</th>
                  <th>Code match</th>
                  <th>Date Début</th>
                  <th>Date Fin</th>
                  <th>Activer/Désactiver (quiz)</th>
                  <th>Remise à zéro</th>
                  <th>Supprimer match</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    // Boucle de parcours de toutes les lignes du résultat obtenu
                    foreach($match1 as $m){
                        // Affichage d’une ligne de tableau pour un pseudo non encore traité
                        if (!isset($traiter[$m["MAT_CODE"]])){
                            $match_code=$m["MAT_CODE"];
                            ?>
                        <tr>
                            <th><?php echo $m["createurquiz"];?><th>
                            <th><?php echo $m["QUI_INTITULE"];?></th>
                            <th><?php echo $m["createurmatch"];?></th>
                            <th><?php echo $m["MAT_DEBUT"];?></th>
                            <th><?php echo $m["MAT_FIN"];?></th>
                            
                            <th><a href="<?php echo base_url();?>index.php/formateur/match/<?php echo $m["MAT_CODE"];?>"><?php echo $m["MAT_CODE"];?></a></th>

                            <?php echo validation_errors(); echo form_open('gestion');?>
                            <th><?php if($m['QUI_ACTIF'] == 1){
                                ?>
                                <input type="hidden" name="code" id="code" value="<?php echo $m["MAT_CODE"];?>"/><button class="btn btn-primary" type="submit" name="activ" value="0">désactiver</button><?php
                            }
                            else{
                                ?> <input type="hidden" name="code" id="code" value="<?php echo $m["MAT_CODE"];?>"/><button class="btn btn-primary" type="submit" name="activ" value="1">activer</button><?php
                            }?></th></form>

                            <?php echo validation_errors(); echo form_open('gestion'); ?>
                            <th><button class="btn" type="submit" name="remise_zero" value="<?php echo $m["MAT_CODE"];?>">RAZ</button></th></form>

                            <?php echo validation_errors(); echo form_open('gestion'); ?>
                            <th><?php if($m['createurmatch']==$_SESSION['username']){?>
                                <button class="btn btn-danger btn-shadow-lg" type="submit" name="supprimer" value="<?php echo $m["MAT_CODE"];?>">Supprimer</button>
                                <?php
                            }else{
                                echo "indisponible";
                            }?></th></form>
                            
                            
                        </tr> 
                    <?php }
                 $traiter[$m["MAT_CODE"]]=1;}?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>