<!--===============================================================
// Nom du fichier : formateur_info.php
// Auteur : A.GOUHIER-DUPUIS
// Date de création : Decembre 2022
// Version : V2_2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// page d'affichage des données du profil dans un tableau
//-------------------------------------------------------------
// A noter :
//
//===============================================================-->
    <div class="colr-area">
        <div class="container">
            <font color='purple'>
                    <?php
                    if(isset($forma)) {
                    ?>      <br><br>
                          <h3>Vos information personnelles : </h3>
                          <br><br>
                          <p> Bonjour <?php echo $forma->UTI_PSEUDO;?> !</p>
                          <table class="table table-hover">
                          <tr>
                          <th>Pseudo</th>
                          <th>Nom</td>
                          <th>Prenom</th>
                          <th>Role</th>
                          <th>Etat</th>
                          <th>Mail</th>
                          </tr>
                          <tr>
                          <td><?php echo $forma->UTI_PSEUDO;?></td>
                          <td><?php echo $forma->PRO_NOM;?></td>
                          <td><?php echo $forma->PRO_PRENOM;?></td>
                          <td><?php echo $forma->UTI_ROLE;?></td>
                          <td><?php echo $forma->UTI_ETAT;?></td>
                          <td><?php echo $forma->PRO_MAIL;?></td>
                          </tr>
                    <?php
                }
                else {echo "<br />";
                echo "pas d'info sur le pseudo !";
                }
                ?>

    </font></table></div></div>