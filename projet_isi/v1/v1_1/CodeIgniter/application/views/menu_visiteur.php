<!--===============================================================
// Nom du fichier : menu_visiteur.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// menu en haut de page pour la partie visiteurs du site 
//-------------------------------------------------------------
// A noter :
// pour l'instant contient un boutton de connexion vide
// pour l'instant non fonctionnel ne relis à aucune page correcte
//===============================================================-->

<nav id="header-navbar" class="navbar navbar-expand-lg py-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center text-white" href="test.php">
            <h3 class="font-weight-bolder mb-0">QUIZZY</h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav-header" aria-controls="navbar-nav-header" aria-expanded="false" aria-label="Toggle navigation">
            <span class="lnr lnr-menu"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-nav-header">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">Blog</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>index.php/compte/connexion">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin/pages/profile.php">Nouveau</a>
                </li><!--
                <li class="nav-item">
                    <a id="side-search-open" class="nav-link" href="#">
                        <span class="lnr lnr-magnifier"></span>
                    </a>
                </li>
                 <li class="nav-item only-desktop">
                    <a class="nav-link" id="side-nav-open" href="#">
                        <span class="lnr lnr-menu"></span>
                    </a>
                </li>-->
            </ul>
        </div>
    </div>
</nav>