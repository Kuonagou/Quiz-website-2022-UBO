<!--===============================================================
// Nom du fichier : page_accueil.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// tableau des actualité présent sur la page d'accueil du site
// affichage si jamais aucune actualité n'est présente dans la base
//-------------------------------------------------------------
// A noter :
// lien hypertexte dans le première case permettant d'accéder à l'actualité dans une page seule
//===============================================================-->

<section id="features" class="bg-white">
    <div class="container">
            <div class="section-content">
                <h2>Actualités</h2>
                <?php if ($actu != NULL){  ?>          
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Titre</th>
                      <th>Contenu</th>
                      <th>Date Publication</th>
                      <th>Auteur</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach($actu as $a) {?>
                    <tr>
                      <td><a href="<?php echo base_url();?>index.php/accueil/afficher/<?php echo $a["ACT_ID"];?>"><?php echo$a["ACT_TITRE"];?></a></td>
                      <!--affichage des information des actualités-->
                      <td><?php echo $a["ACT_CONTENU"]?></td>
                      <td><?php echo $a["ACT_NEWDATE"]?></td>
                      <td><?php echo $a["UTI_PSEUDO"]?></td>
                    </tr>
                    <?php }}
                    else{
                      echo "Aucune actualité pour l'instant";
                    } ?>
                  </tbody>
                </table>
                
            </div>
    </div>
</section>
