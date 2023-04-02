<div class="colr-area">
    <div class="container">
<div class="section-content">
 <table class="table table-hover">
        <?php
        // Boucle de parcours de toutes les lignes du résultat obtenu
        foreach($match1 as $m){
            // Affichage d’une ligne de tableau pour un pseudo non encore traité
            if (!isset($traiter[$m["MAT_CODE"]])){
                $match_code=$m["MAT_CODE"];
                ?>
                <h1><?php echo $m["QUI_INTITULE"]?></h1>

                <p>Math de code <b><?php echo $m["MAT_CODE"]?></b> crée par <b><?php echo $m["createurmatch"]?></b> à partir du quiz de <b><?php echo $m["createurquiz"]?></b>.</p> <!--affichage des information du match-->      
                <p><?php if($m["MAT_DEBUT"] == null){echo "Ce match ne possède pas de date de début";}else{ echo "Ce match débute le ".$m["MAT_DEBUT"];}?> et <?php if($m["MAT_FIN"] == null){echo "ne possède pas de date de fin";}else{ echo "se termine le ".$m["MAT_FIN"];}?>, il est actuellement <?php if($m["QUI_ACTIF"] == 0){echo "désactivé .";}else{ echo " activé .";}?></p>
                
                
                <?php
                // Boucle d’affichage des questions des match

            if($m["QUE_INTITULEQUESTION"]!=NULL){ ?>
                <thead>
                    <tr>
                      <th>Question</th>
                      <th>Réponses</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                foreach($match1 as $mat){
                    if (!isset($traite[$mat["QUE_INTITULEQUESTION"]])){ 
                        $text_question=$mat["QUE_INTITULEQUESTION"];?>
                    <tr>
                    <td><?php echo $mat["QUE_INTITULEQUESTION"]?></td>
                    <td>
                        <?php
                    foreach($match1 as $ma){

                        if(strcmp($text_question,$mat["QUE_INTITULEQUESTION"])==0 and $mat["idquestionrep"]==$ma["idrepquestion"]){ ?>
                            <ul>
                            <li> <?php 
                                    if($ma["REP_VRAI"]==1){
                                        echo "- ";
                                        echo $ma["REP_REPONSE"];
                                        echo "";
                                    }
                                    else{
                                        echo "- ".$ma["REP_REPONSE"];
                                    }?>
                            </li>
                            </ul>
                        <?php
                        }
                    }echo "</td>";
             
                                

                    $traite[$mat["QUE_INTITULEQUESTION"]]=1;
                    if($mat['MAT_FIN']==null){
                        $fini=1;
                    }
                    }
                }
            }
            else{
                ?><font color="purple">
                    <h5>Pas encore de question pour ce quiz. Repassez plus tard !</h5></font><?php
            }
            
                
                    // Conservation du traitement du pseudo
                    // (dans un tableau associatif dans cet exemple !)
                    $traiter[$m["MAT_CODE"]]=1;
            }
        ?>
    </tbody>
    </table><?php
}
foreach($match1 as $m){
    if (!isset($traiter[$m["MAT_FIN"]])){

        if($m["MAT_FIN"] != null){
        ?><h5> <?php if($score->scorem != null){
            echo "Score moyen du match : ".$score->scorem.".";
        }else{
            echo "Ce match n'a pas encore de joueur.";
        }  ?></h5><?php
    }
    else{
        ?><button class="btn btn-primary" >Terminer</button><?php
    }
                

    }$traiter[$m["MAT_FIN"]]=1;}?>


    </div></div></div>