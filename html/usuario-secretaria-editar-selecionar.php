<?php SESSION_START(); ?>
<html>
	<head>

    <?php
    if($_SESSION['Permissao'] != "secretaria")
    {
    	include('logout.php');
    }
    ?>


		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Confirmar Documento</title>



		<!-- Custom Fonts -->
		<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"
		<!-- Theme CSS -->
		<link href="css/grayscale.min.css" rel="stylesheet">

		<script src="jquery.js" type="text/javascript"></script>
		<script src="jquery.maskedinput.js" type="text/javascript"></script>

    <!-- Bootstrap Core CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/barra_do_governo.css">

  </head>
	<body style="background-color: #FFFFFF">
	<div id="barra-brasil">
		<div id="wrapper-barra-brasil">
			<div class="brasil-flag">
				<a href="http://brasil.gov.br" class="link-barra">Brasil</a>
			</div>
			<span class="acesso-info">
				<a href="http://www.servicos.gov.br/?pk_campaign=barrabrasil" class="link-barra" id="barra-brasil-orgao">Serviços</a>
			</span>
			<nav>
				<ul class="list">
					<li><a href="#" id="menu-icon"></a></li>
					<li class="list-item first"><a href="http://brasil.gov.br/barra#participe" class="link-barra">Participe</a></li>
					<li class="list-item"><a href="http://brasil.gov.br/barra#acesso-informacao" class="link-barra">Acesso à informação</a></li>
					<li class="list-item"><a href="http://www.planalto.gov.br/legislacao" class="link-barra">Legislação</a></li>
					<li class="list-item last last-item"><a href="http://brasil.gov.br/barra#orgaos-atuacao-canais" class="link-barra">Canais</a></li>
				</ul>
			</nav>
			<a class="logo-vlibras" href="http://www.vlibras.gov.br/" aria-label="Acessível em Libras"></a>
		</div>
	</div><br><br>



    <div class="container" style="text-align: center;">
		<form action="selecionarUsuarioPorEmail.php" method="post">
    		<fieldset>
				<legend> <h3 class="text-info text-center">Selecione o tipo de conta a ser editada </h3> </legend>
	    		<div style="display: inline-block; text-align: left">
	      			<input type="radio" name="Tipo" id="Aluno" value="alunos" onclick="mostrarEmailBox()"> Aluno <br>
	     			<input type="radio" name="Tipo" id="Professor" value="professores" onclick="mostrarEmailBox()"> Professor <br>
	    		</div>
    		</fieldset>
		
			<br><br>

				<div id="emailBox" style="display:none">
					<h5 id="opcaoEmail"></h5>
					<ul class="list-inline banner-social-buttons text-center">
						<li>
							<input id="email" name = "email" style="text-align:right" class="#">
						</li>
	  					<li>
	  						<input type = "submit" class="btn btn-success text-center btn-xs" value = "Continuar"/>
	  					</li>
	  				</ul>
	  			</div>
	  	</form>
			<br><br>

		<input type = "button" class="btn btn-danger text-center" value = "Voltar" onclick = "cancelar()"/>
	</div>


		<script>
	      	function mostrarEmailBox(){
	        if (document.getElementById("Aluno").checked){
						document.getElementById("opcaoEmail").innerHTML = "Indique o email do Aluno: ";
	        }
	        else if (document.getElementById("Professor").checked){
						document.getElementById("opcaoEmail").innerHTML = "Indique o email do Professor: ";
	        }
	        document.getElementById("emailBox").style.display = 'block';
	        }

			function cancelar() {
				window.location.replace("usuario-secretaria.php");
			}
		</script>
	</body>

</html>
