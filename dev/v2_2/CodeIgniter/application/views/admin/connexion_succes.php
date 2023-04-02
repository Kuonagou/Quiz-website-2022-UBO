<!--===============================================================
// Nom du fichier : connexion_succes.php
// Auteur : A.GOUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V2_2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// redirige l'admin ou le formateur vers sa page d'accueil dédier
//-------------------------------------------------------------
// A noter :
// n'est jamais vraiment affichée
//===============================================================-->

 <div class="realtime-statistic-area">
    <div class="container">
        <div class="row">
            <?php if($connect->UTI_ROLE == 'F'){
                redirect(base_url()."index.php/formateur/afficher");
            }else{
                redirect(base_url()."index.php/admin/afficher");
            } ?>
            
        </div>     
    </div>
</div>
