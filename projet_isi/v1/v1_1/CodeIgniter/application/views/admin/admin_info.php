    <div class="colr-area">
        <div class="container">
            <font color='purple'>
                    <?php
                    if(isset($forma)) {
                    ?>      <br><br>
                          <p>Vos information personnelles : </p>
                          <br><br>
                          <h3> Bonjour <?php echo $forma->UTI_PSEUDO;?> !</h3>
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
                echo "Vous n'avez aucune information dans votre profil !";
                echo "<br>Si vous voulez en rajouter aller dans l'onglet modifier mes information<br><br><br><br><br></font>";
                }
                ?>

    </table></div></div>
