<!--===============================================================
// Nom du fichier : .php
// Auteur : A.GOUHIER-DUPUIS
// Date de création : Decembre 2022
// Version : V2_2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// tentative d'aafichage du score du jouer
//-------------------------------------------------------------
// A noter :
// je ne parvient pas encore à récupérer les données du formulaire pour calculer le score
//===============================================================-->
<div class="colr-area">
    <div class="container">
        <div class="section-content">
            <h3>Redirection</h3>
            <?php
            if($des!=null){
                echo "<p> Le match de code ".$des." va être désactiver";

            }
            header('Refresh: 15; '.base_url().'index.php/formateur/gestion');
                    ?> 
                    
            </div>
        </div>
    </div>