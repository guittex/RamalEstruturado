<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ramais</title>
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <meta name="author" content="Guilherme Felipe de Oliveira">
    <link rel="stylesheet" href="css/style.css">
    <link href="{{ asset('css/fonts_krub.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo2.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}">
</head>
<body>
<header class="cabecalho">
        <div class="row">	
        <div class="col-8">
            <a href="listar_ramais_modal.php">  
                <img alt="logo da impacta" id='LogoFresadora' src="img/logo-fresadora.jpg">
            </a>    
        </div>  
        <div class="col-4">     
            <nav class="menu">
                <a href="https://webmail.fresadorasantana.com.br/?_task=mail&_mbox=INBOX"><img id='ImgHome' src="{{ asset('img/email.png') }}" alt="" style="float:right;width:40px;margin-left:25px"></a>                            
                <a href="{{ route('ramal') }}"><img id='ImgHome' src="{{ asset('img/home.png') }}" alt="" style="float:right;width:40px"></a>                
            </nav>
        </div>
        </div>
        @if(Session::has('flash_message'))
        <div class="container-fluid m-t-20">
            <div class="row">
                <div class="col-md-12">
                    <div align='center' class="alert {{ Session::get('flash_message')['class'] }}">
                        {{ Session::get('flash_message')['msg'] }}
                    </div>
                </div>
            </div>
        </div>
        @endif
</header>


    @yield('content')



<footer class="rodape">
    <div class="social-icon" style="margin-bottom:15px;">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="contato.php"><i class="fa fa-envelope"></i></a>
    </div>
    <div class="footer" style="font-size: 15px">
		<a href="http://www.fresadorasantana.com.br/site/index.html">Home</a>
        <a href="http://www.fresadorasantana.com.br/site/empresa.html">Sobre Nós</a>
        <a href="http://www.fresadorasantana.com.br/site/produtos.html">Produtos</a>        
        <a href="http://www.fresadorasantana.com.br/site/contato.html">Contato</a>
    </div>         
    <p class="copyright" style="font-size: 15px;">Copyright Fresadora Santana 2018. Todos os direitos reservados.</p>    
</footer>


<script src="{{ asset('js/jquery_min.js') }}"></script>
<script src="{{ asset('js/popper_min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>

<!--SCRIPT EDITAR MODAL-->
<script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var recipientnome = button.data('whatevernome')
        var recipientdepartamento = button.data('whateverdepartamento')
        var recipientramal = button.data('whateverramal')
        var recipientemail = button.data('whateveremail')
        var recipientcorporativo = button.data('whatevercorporativo')
        $("#TituloEditar").val(recipientnome);
        
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('ID ' + recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-name').val(recipientnome)
        modal.find('#recipient-departamento').val(recipientdepartamento)
        modal.find('#recipient-ramal').val(recipientramal)
        modal.find('#recipient-email').val(recipientemail)
        modal.find('#recipient-corporativo').val(recipientcorporativo)

    })
</script>

</body>
</html>