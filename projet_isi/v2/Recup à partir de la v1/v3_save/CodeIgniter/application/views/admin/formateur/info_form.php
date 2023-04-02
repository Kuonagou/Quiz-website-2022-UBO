

<!-- <div class="realtime-statistic-area">
    <div class="container">
        <div class="row">
           <?php if(isset($forma)){?>
            <br></br>
            <p><?php echo $forma->UTI_ROLE ?></p>
            <p><?php echo $forma->UTI_IDUTILISATEUR ?></p>
            <p><?php echo $this->session->userdata('username');}  echo '-------'.$_SESSION['username']?></p>
        </div>     
    </div>
</div>

<script language=javascript>
   alert(\'Vous n\'avez pas précisé votre nom');
</script>

<p>Click the button to see line-breaks in an alert box.</p>


<button onclick="myFunction()">Try it</button>

<script>
function myFunction(from, align, icon, type, animIn, animOut){
        $.growl({
            icon: icon,
            title: ' je suis un message ',
            message: 'il faut que ça marche',
            url: ''
        },{
                element: 'body',
                type: type,
                allow_dismiss: true,
                placement: {
                        from: from,
                        align: align
                },
                offset: {
                    x: 20,
                    y: 85
                },
                spacing: 10,
                z_index: 1031,
                delay: 2500,
                timer: 1000,
                url_target: '_blank',
                mouse_over: false,
                animate: {
                        enter: animIn,
                        exit: animOut
                },
                icon_type: 'class',
                template: '<div data-growl="container" class="alert" role="alert">' +
                                '<button type="button" class="close" data-growl="dismiss">' +
                                    '<span aria-hidden="true">&times;</span>' +
                                    '<span class="sr-only">Close</span>' +
                                '</button>' +
                                '<span data-growl="icon"></span>' +
                                '<span data-growl="title"></span>' +
                                '<span data-growl="message"></span>' +
                                '<a href="#" data-growl="url"></a>' +
                            '</div>'
        });
    };
</script>


-->
