<?php
SESSION_START();
include("config.php");
if($_SESSION['Permissao'] != "aluno")
{
	include('logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EneSec - Página do aluno</title>

    <link rel="stylesheet" href="css/barra_do_governo.css">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"
    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

		<script src="jquery.js" type="text/javascript"></script>
		<link href="css/bootstrap-select.min.css" rel="stylesheet">
		<link href="css/bootstrap-select.css" rel="stylesheet">

		<!-- Bootstrap Core CSS -->

		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
		<script src="jquery.maskedinput.js" type="text/javascript"></script>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" style="background-color: #FFFFFF">
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
	</div>

	<br><br>
	<h1 class="text-center text-info"> Olá, <?php echo $_SESSION["Nome"]; ?>! </h1> <br><br>

	<div class="container" style="color: #000000">
		<div class="col-md-6 col-md-offset-3">
			<table class="table table-striped">
				<tbody>
					<tr>
						<td><strong> Nome: </strong></td>
						<td> <?php echo $_SESSION["Nome"]." ".$_SESSION["Sobrenome"]; ?></td>
					</tr>
					<tr>
						<td><strong> E-mail: </strong></td>
						<td> <?php echo $_SESSION["Email"]; ?> </td>
					</tr>
					<tr>
						<td><strong> CPF: </strong></td>
						<td> <?php echo $_SESSION["CPF"]; ?> </td>
					</tr>
					<tr>
						<td><strong> Identidade: </strong></td>
						<td> <?php echo $_SESSION["Identidade"]; ?> </td>
					</tr>
					<tr>
						<td><strong> Matrícula: </strong></td>
						<td> <?php echo $_SESSION["Matricula"]; ?> </td>
					</tr>
					<tr>
						<td><strong> Curso: </strong></td>
						<td> <?php echo $_SESSION["Curso"]; ?> </td>
					</tr>
					<tr>
						<td><strong> Grau: </strong></td>
						<td> <?php echo $_SESSION["Grau"]; ?> </td>
					</tr>
					<tr>
						<td><strong> Ingresso: </strong></td>
						<td> <?php echo $_SESSION["Ingresso"]; ?> </td>
					</tr>
					<tr>
						<td><strong> Turno: </strong></td>
						<td> <?php echo $_SESSION["Turno"]; ?> </td>
					</tr>
					<tr>
						<td><strong> Endereço: </strong></td>
						<td> <?php echo $_SESSION["Endereco"]; ?> </td>
					</tr>
					<tr>
						<td><strong> Cep: </strong></td>
						<td> <?php echo $_SESSION["CEP"]; ?> </td>
					</tr>
				</tbody>
			</table>
			<div class="text-center">
				<button type="button" class="btn btn-danger" onclick="voltar()"> Voltar </button>
			</div>
		</div>
	</div>

	<script>
		function voltar()
		{
			window.location.replace("usuario-aluno.php");
		}
	</script>
</body>
</html>
