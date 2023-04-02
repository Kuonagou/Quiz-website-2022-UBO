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