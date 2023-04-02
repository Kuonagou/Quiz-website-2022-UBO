<section id="features" class="bg-white">
    <div class="container">
            
    <?php
        if($match != NULL) {
    ?>
        <div class="section-content">
            <h2>
            <?php
                foreach ($match as $intitule) {
                    if(!isset($traite[$intitule['QUI_INTITULE']])) {
                        echo $intitule['QUI_INTITULE'];
                        $traite[$intitule['QUI_INTITULE']]=1;
                    }
                }
            ?>
            </h2>
        </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Numéro de question</th>
                            <th>Question</th>
                            <th>Réponse</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo validation_errors();
                            echo form_open('reponse_match');
                            foreach($match as $info){
                                if (!isset($traite[$info['QUE_ID']])) {
                                    $id_qst=$info['QUE_ID'];
                        ?>
                                    <tr>
                                        <td><?php echo $info['QUE_ORDRE']?></td>
                                        <td><?php echo $info['QUE_INTITULEQUESTION']?></td>
                                        <td>
                                                <select class="form-control" name="<?php echo $id_qst; ?>">
                                                <?php
                                                    foreach($match as $m){
                                                        if(strcmp($id_qst,$m['QUE_ID'])==0) {
                                                            echo "<option value='".$m['REP_VRAI']."'>".$m['REP_REPONSE']."</option>";
                                                        }
                                                    }
                                                ?>
                                                </select>
                                        </td>
                                        <?php
                                            $traite[$info['QUE_ID']]=1;
                                        ?>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <input type="hidden" value="<?php echo $pseudo;?>" name="pseudo">
                <input type="hidden" value="<?php echo $code;?>" name="code">
                <button type="submit" class="btn btn-primary">Valider</button>
                <br>
                </form>
    <?php
        } else {
            echo "Aucun résultat !";
        }
    ?>
</div>
</div>
</section>