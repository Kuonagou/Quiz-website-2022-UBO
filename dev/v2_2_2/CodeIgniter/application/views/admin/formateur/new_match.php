

<div class="colr-area">
    <div class="container">
        <div class="section-content">
            <h3>Créer un match</h3> 
            <p>Les quiz incomplets ne sont pas selectionnable ici pour empécher la création d'un match vide.</p>
                <?php echo validation_errors(); ?>
                <?php echo form_open('crea_quiz'); ?>
                <label>Sélection du quiz</label>
                <select class="form-control" name="quiz">
                <?php
                // Boucle de parcours de toutes les lignes du résultat obtenu
                foreach($match1 as $m){
                    // Affichage d’une ligne de tableau pour un pseudo non encore traité
                     if (!isset($traiter[$m["QUI_ID"]])){
                        if($m['QUE_ID']!=null){
                            ?>
                        <option value="<?php echo $m["QUI_ID"];?>"><?php echo $m["QUI_ID"];?> - <?php echo $m["QUI_INTITULE"];?></option>
                    <?php }}
                    $traiter[$m["QUI_ID"]]=1;
                }?> 
             </select>
             <br>
                 <button type="submit" class="btn btn-primary">Créer</button></form>
                </div>
            </div>
        </div>
</div></div>