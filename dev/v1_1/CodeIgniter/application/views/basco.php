<!--===============================================================
// Nom du fichier : bas.php
// Auteur : A.GOUUHIER-DUPUIS
// Date de création : Novembre 2022
// Version : V1
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Description :
// bas de page de la partie visiteur (non admin)
//-------------------------------------------------------------
// A noter :
// pour l'instant contient un boutton de connexion qui revoie vers la page de connexion
// ne pas toucher aux balises qui permettent d'avoir le beau template boostrap
//===============================================================-->

<section id="cta" class="bg-fixed overlay" style="background-image: url(<?php echo base_url();?>style/img/bg.jpg);">
    <div class="container">
        <div class="section-content" data-aos="fade-up">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="mb-2">Retour à l'accueil</h2><p><br></p>
                    <a class="btn btn-outline-primary btn-lg" href="<?php echo base_url();?>index.php/accueil/afficher">Accueil</a>
                    
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400|Work+Sans:300,400,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/style.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Modernizr JS for IE8 support of HTML5 elements and media queries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>


<!-- End of Features Section--></div>
<footer class="mastfoot my-3">
    <div class="inner container">
         <div class="row">
         	<div class="col-lg-4 col-md-12 d-flex align-items-center">
         		
         	</div>
         	<div class="col-lg-4 col-md-12 d-flex align-items-center">
         		<p class="mx-auto text-center mb-0">&copy; 2022 QUIZZY. Design by Anouk</p>
         	</div>
           
            <div class="col-lg-4 col-md-12">
            	<nav class="nav nav-mastfoot justify-content-center">
	                <a class="nav-link" href="#">
	                	<i class="fab fa-facebook-f"></i>
	                </a>
	                <a class="nav-link" href="#">
	                	<i class="fab fa-twitter"></i>
	                </a>
	                <a class="nav-link" href="#">
	                	<i class="fab fa-instagram"></i>
	                </a>
	                <a class="nav-link" href="#">
	                	<i class="fab fa-linkedin"></i>
	                </a>
	                <a class="nav-link" href="#">
	                	<i class="fab fa-youtube"></i>
	                </a>
	            </nav>
            </div>
            
        </div>
    </div>
</footer>	<!-- External JS -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
	<script src="<?php echo base_url();?>style/vendor/bootstrap/popper.min.js"></script>
	<script src="<?php echo base_url();?>style/vendor/bootstrap/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>style/vendor/select2/select2.min.js "></script>
	<script src="<?php echo base_url();?>style/vendor/owlcarousel/owl.carousel.min.js"></script>

	<script src="<?php echo base_url();?>style/vendor/stellar/jquery.stellar.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url();?>style/vendor/isotope/isotope.min.js"></script>
	<script src="<?php echo base_url();?>style/vendor/lightcase/lightcase.js"></script>
	<script src="<?php echo base_url();?>style/vendor/waypoints/waypoint.min.js"></script>
	 <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	 
	<!-- Main JS -->
	<script src="<?php echo base_url();?>style/js/app.min.js "></script>
	<script src="<?php echo base_url();?>style/localhost:35729/livereload.js"></script>

	 <!-- jquery
		============================================ -->
    <script src="<?php echo base_url();?>style/admin/js/vendor/jquery-1.12.4.min.js"></script>
    <!--  notification JS
		============================================ -->
    <script src="<?php echo base_url();?>style/admin/js/notification/bootstrap-growl.min.js"></script>
    <script src="<?php echo base_url();?>style/admin/js/notification/notification-active.js"></script>

</body>
</html>
