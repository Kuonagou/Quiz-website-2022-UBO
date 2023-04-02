<!--===============================================================
// Nom du fichier : connexion_succes.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// affichage du succès de la connexion dans la partie admin
//-------------------------------------------------------------
// A noter :
// affiche aussi une partie de la page admin de base pour l'instant inutile sert juste à avoir une iddé de ce à quoi ça peut ressembler
// sinon vue très vide et sans grand intéret puisque pour l'intant la connexion n'est absolument pas vérifiée il suffit de taper des choses dans les champs
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
