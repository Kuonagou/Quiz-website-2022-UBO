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
                                        echo "<font color='green'>";
                                        echo $ma["REP_REPONSE"];
                                        echo "</font>";
                                    }
                                    else{
                                        echo $ma["REP_REPONSE"];
                                    }?>
                            </li>
                            </ul>
                        <?php
                        }
                    }echo "</td>";
             
                                

                    $traite[$mat["QUE_INTITULEQUESTION"]]=1;
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
        }
        ?>
    </tbody>
    </table>
    </div></div></div>