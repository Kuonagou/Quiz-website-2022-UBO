<div class="colr-area">
    <div class="container">
        <div class="section-content">
             <table class="table">
                <thead>
                    <tr>
                   <th>Titre quiz</th>
                  <th>code</th>
                  <th>créateur quiz</th>
                  <th>créateur match</th>
                  <th></th>
                  <th></th>
                  <th></th>
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
                            <th><?php echo $m["QUI_INTITULE"]?></th>
                            <th><?php echo $m["MAT_CODE"]?> + lien vers l'affichage des question du match</th> 
                            <th><?php echo $m["createurmatch"]?></th>
                            <th><?php echo $m["createurquiz"]?><th>
                            <th><button class="btn btn-primary" type="submit" name="submit" value="">Valider</button></th>
                            <th><button class="btn" type="submit" name="submit" value="Valider">RAZ</button></th>
                            <th><button class="btn btn-danger btn-shadow-lg" type="submit" name="submit" value="Valider">Supprimer</button></th>

                        </tr><!--affichage des information du match-->     
                    <?php }
                 $traiter[$m["MAT_CODE"]]=1;}?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>