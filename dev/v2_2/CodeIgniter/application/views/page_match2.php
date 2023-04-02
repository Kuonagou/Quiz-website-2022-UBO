<!--===============================================================
// Nom du fichier : page_match.php
// Auteur : A.GOUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V2_2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// page d'affichage des question d'un match
// première partie avec une phrase donnant les information du match nom créateur utilisateur ect
// deuxième partie affichant dans un tableau question par question les différentes réponses possibles avec la possiblité de cocher la case et de jouer le questionnaire
//-------------------------------------------------------------
// A noter :
// la récupération de ce formulaire n'est pas encore oppérationnelle
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
                            <fieldset>
                            <?php $id=0;echo validation_errors(); 
                            echo form_open('joue_match');
                        foreach($match as $ma){
                            
                            if(strcmp($text_question,$mat["QUE_INTITULEQUESTION"])==0 and $mat["idquestionrep"]==$ma["idrepquestion"]){ 
                                ?>
                                <ul>
                                                    <div>
                                                      <input type="radio" type="submit" id="<?php echo $ma["QUE_INTITULEQUESTION"];?>" name="<?php echo $ma["QUE_ID"];?>" value="<?php echo $ma["REP_ID"];?>"></input>
                                                      <label for="<?php echo $ma["REP_REPONSE"];?>"><?php echo $ma["REP_REPONSE"];?></label>
                                                    </div>            
                            </ul>
                     <?php $id=$id+1;
                        }
                    }echo "</form></td></fieldset>";
             
                                

                    $traite[$mat["QUE_INTITULEQUESTION"]]=1;
                    }
                } 
            }
            else{
                ?><font color="purple"><form>
                    <h5>Pas encore de question pour ce quiz. Repassez plus tard !</h5></font>
                    <button class="btn btn-primary btn-shadow btn-lg" href="<?php echo base_url();?>index.php/afficher/accueil" value="Accueil">Accueil</button></form>
                    <?php
            }
            
                
                    // Conservation du traitement du pseudo
                    // (dans un tableau associatif dans cet exemple !)
                   
                    $traiter[$m["MAT_CODE"]]=1;
            }
        }
        ?>
    </tbody>
    </table>
    <?php echo form_open('joue_match');?>
     <input class="btn btn-primary btn-shadow btn-lg" type="submit" id="match" name="match" value="<?php echo $m['MAT_CODE'];?>" /></form>
    </div>
    </div>