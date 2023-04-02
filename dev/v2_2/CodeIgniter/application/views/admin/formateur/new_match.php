<div class="colr-area">
    <div class="container">
        <div class="section-content">
            <h3>Mes quiz et Match</h3>
             <table class="table">
                <thead>
                    <tr>
                   <th>ID quiz</th>
                   <th></th>
                  <th>Titre quiz</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    // Boucle de parcours de toutes les lignes du résultat obtenu
                    foreach($match1 as $m){
                        // Affichage d’une ligne de tableau pour un pseudo non encore traité
                        if (!isset($traiter[$m["QUI_ID"]])){
                            $match_code=$m["QUI_ID"];
                            ?>
                        <tr>
                            <th><?php echo $m["QUI_ID"];?><th>
                            <th><?php echo $m["QUI_INTITULE"];?></th>
  
                        </tr> 
                    <?php }
                 $traiter[$m["QUI_ID"]]=1;}?> 
                    </tbody>
                </table>
                 <?php echo validation_errors(); ?>
                <?php echo form_open('crea_quiz'); ?>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="view-mail-list sm-res-mg-t-30">
                        <div class="view-mail-hd">
                            <div class="view-mail-hrd">
                                <h2>Nouveau match</h2>
                            </div>
                        </div>
                        <div class="cmp-int mg-t-20">
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">

                                        <span>Id du quiz :</span>
                                    
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <input type="input" id="id_quiz" name="id_quiz" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                </div><button type="submit" class="btn btn-primary">Créer</button></form>
            </div>
        </div>
</div></div>