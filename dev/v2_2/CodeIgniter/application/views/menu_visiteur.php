<!--===============================================================
// Nom du fichier : menu_visiteur.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V2_2
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// menu en haut de page pour la partie visiteurs du site 
//-------------------------------------------------------------
// A noter :
//
//===============================================================-->

<nav id="header-navbar" class="navbar navbar-expand-lg py-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center text-white" href="<?php echo base_url();?>index.php/accueil/afficher">
            <h3 class="font-weight-bolder mb-0">QUIZZY</h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav-header" aria-controls="navbar-nav-header" aria-expanded="false" aria-label="Toggle navigation">
            <span class="lnr lnr-menu"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-nav-header">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>index.php/accueil/afficher">Accueil</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">Blog</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>index.php/accueil/afficher">Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>index.php/compte/connexion">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>index.php/accueil/afficher">Nouveau</a>
                </li>
            </ul>
        </div>
    </div>
</nav>