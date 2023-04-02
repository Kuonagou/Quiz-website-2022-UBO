<!--===============================================================
// Nom du fichier : actualite_afficher.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// affichage d'une actualite en particulier 
// et button de redirection vers la page d'accueil
//-------------------------------------------------------------
// A noter :
// accessible en cliquant sur le lien dans le tableau de la page d'accueil
//===============================================================-->

<section id="features" class="bg-white">
    <div class="container">
        <div class="section-content">
                <h1><?php echo $titre;?></h1>
                <br />
                <?php
                if(isset($actu)) {
                echo $actu->ACT_ID;
                echo(" -- ");
                echo $actu->ACT_CONTENU;
                }
                else {echo "<br />";
                echo "pas d’actualité !";
                }
                ?>

        <div class="col-md-2 text-center">
            <br>
            <a class="btn btn-shadow btn-lg" href="<?php echo base_url();?>index.php/accueil/afficher/">ACCUEIL</a>
        </div>
    </div>
    
</section>