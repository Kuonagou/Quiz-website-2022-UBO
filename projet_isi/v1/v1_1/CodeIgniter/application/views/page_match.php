<!--===============================================================
// Nom du fichier : page_match.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// page d'affichage des question d'un match
// première partie avec une phrase donnant les information du match nom créateur utilisateur ect
// deuxième partie affichant dans un tableau question par question les différentes réponses possibles avec la bonne en vert 
//-------------------------------------------------------------
// A noter :
// pour l'instant juste de l'affichage elle sera ensuite transformée pour permettre la gestion du questionnaire et du choix de ses réponses
//===============================================================-->

<section id="features" class="bg-white">
    <div class="container">
            <div class="section-content">            
                <table class="table table-hover">
        <?php
        // Boucle de parcours de toutes les lignes du résultat obtenu
        foreach($match as $m){
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
                foreach($match as $mat){
                    if (!isset($traite[$mat["QUE_INTITULEQUESTION"]])){ 
                        $text_question=$mat["QUE_INTITULEQUESTION"];?>
                    <tr>
                    <td><?php echo $mat["QUE_INTITULEQUESTION"]?></td>
                    <td>
                        <?php
                    foreach($match as $ma){

                        if(strcmp($text_question,$mat["QUE_INTITULEQUESTION"])==0 and $mat["idquestionrep"]==$ma["idrepquestion"]){ ?>
                            <ul>
                                <form>
                                <input type="radio" id="<?php echo $ma["REP_REPONSE"];?>" name="<?php echo $ma["QUE_ID"];?>"" value="<?php echo $ma["REP_REPONSE"];?>" >
                                        <label for="<?php echo $ma["REP_REPONSE"];?>"><?php echo $ma["REP_REPONSE"];?></label>
                                </form>
                            
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
    </div>
    </div>
</section>

