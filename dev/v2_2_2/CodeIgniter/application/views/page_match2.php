<!--===============================================================
// Nom du fichier : page_match.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// page d'affichage des question d'un match
// première partie avec une phrase donnant les information du match nom créateur utilisateur ect
// deuxième partie affichant dans un tableau question par question les différentes réponses possibles disponible dans un formulaire à choix
//-------------------------------------------------------------
// A noter :
// elle n'est pas jouable acutellement
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
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('jou_match'); ?>
                    <input type="hidden" name="code" value="<?php echo $m['MAT_CODE'];?>"/>
                    <input type="hidden" name="pseudo" value="<?php echo $pseudo;?>"/>
                    <?php
                    foreach($match as $mat){
                        if (!isset($traite[$mat["QUE_INTITULEQUESTION"]])){ 
                            $text_question=$mat["QUE_INTITULEQUESTION"];?>
                            <select class="form-control" name="<?php echo $mat['QUE_ID']; ?>">
                                <tr>
                            <td><?php echo $mat["QUE_INTITULEQUESTION"]?></td>
                            <td>
                             
                                <?php
                            foreach($match as $ma){

                                if(strcmp($text_question,$mat["QUE_INTITULEQUESTION"])==0 and $mat["idquestionrep"]==$ma["idrepquestion"]){ ?>
                                       
                                    <option id="<?php echo $ma["QUE_ID"];?>"value="<?php echo $ma["REP_REPONSE"];?>"><?php echo $ma["REP_REPONSE"];?></option>
                                <?php
                                }
                            }
                            echo "</td></select>";
                     
                                        

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
    </table><button type="submit" class="btn btn-primary">Valider</button></form>
    </div>
    </div>
</section>