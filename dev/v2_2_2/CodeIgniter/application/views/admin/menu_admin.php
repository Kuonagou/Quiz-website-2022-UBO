<!--===============================================================
// Nom du fichier : menu_admin.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// menu de la partie administrateur
//-------------------------------------------------------------
// A noter :
// la partie en commentaire est une autre forme de menu bcp plus complète à voir si elle est nécessaire plus tard
//===============================================================-->

<!-- Start Header Top Area -->
    <div class="header-top-area nk-purple">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <br>
                    <p><font color="white">Mon espace administrateur</font></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <br>
                        <ul class="nav navbar-nav notika-top-nav">
                            <div class="collapse navbar-collapse" id="navbar-nav-header">
                            <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a href="<?php echo base_url();?>index.php/admin/afficher" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-menus"></i></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
     <div class="main-menu-area mg-tb-40"><font color='purple'>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        
                        <li><a data-toggle="tab" href="#Profil"><i class="notika-icon notika-bar-chart"></i> Profil</a>
                        </li>
                        <li><a data-toggle="tab" href="#Match"><i class="notika-icon notika-windows"></i>Administrateur</a>
                        </li>

                        <li><a data-toggle="tab" href="#Quiz"><i class="notika-icon notika-support"></i> Actualité</a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="Profil" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?php echo base_url();?>index.php/admin/info">Mes informations</a>
                                </li>
                                <li><a href="<?php echo base_url();?>index.php/admin/mdp">Modifier mon mdp</a>
                                </li>
                                <li><a href="">Modifier mes informations</a>
                                </li>
                                <li><a href="">Supprimer mon compte</a>
                                </li>
                            </ul>
                        </div>
                        <div id="Match" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?php echo base_url();?>index.php/admin/lister">Gestion des comptes</a>
                                </li>
                                <li><a href="">...</a>
                                </li>
                                <li><a href="">...</a>
                                </li>
                            </ul>
                        </div>
                        <div id="Quiz" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="">...</a>
                                </li>
                                <li><a href="">...</a>
                                </li>
                                <li><a href="">...</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div></font>
    </div>