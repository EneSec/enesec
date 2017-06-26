<?php
SESSION_START();
include("config.php");
if($_SESSION['Permissao'] != "secretaria")
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

    <title>EneSec - Página da secretaria</title>

    <link rel="stylesheet" href="css/barra_do_governo.css">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" >
    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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

	<div class="container text-center" style="color: #000000">
		<div class="col-md-6 col-md-offset-3">
			<?php
				$check_aluno = mysqli_query($con, "SELECT * FROM `alunos_pendentes` ORDER BY `id`");
				$check_prof = mysqli_query($con, "SELECT * FROM `professores_pendentes` ORDER BY `id`");
				$check_doc = mysqli_query($con, "SELECT * FROM `documentos` ORDER BY `id`");

				$row_aluno = mysqli_num_rows($check_aluno);
				$row_prof = mysqli_num_rows($check_prof);
				$row_doc = mysqli_num_rows($check_doc);


				//ALUNOS ESPERANDO AVALIAÇÃO
				if ($row_aluno == 0) {
					echo "<p class='text-info'><strong> Não há alunos(as) esperando avaliação de cadastro </p> <br>";
				}
				if ($row_aluno == 1) {
					echo "<p class='text-info'><strong> Há $row_aluno aluno(a) esperando avaliação de cadastro </p> <br>";
				}
				if ($row_aluno > 1) {
					echo "<p class='text-info'><strong> Há $row_aluno alunos(as) esperando avaliação de cadastro </p> <br>";
				}
				//PROFESSORES ESPERANDO AVALIACAO
				if ($row_prof == 0) {
					echo "<p class='text-info'> Não há professores(as) esperando avaliação de cadastro </p> <br>";
				
				}
				if ($row_prof == 1) {
					echo "<p class='text-info'> Há $row_prof professor(a) esperando avaliação de cadastro </p> <br>";
				
				}
				if ($row_prof > 1) {
					echo "<p class='text-info'> Há $row_prof professores(as) esperando avaliação de cadastro </p> <br>";
				
				}
				//DOCUMENTOS ESPERANDO AVALIACAO
				if ($row_doc == 0) {
					echo "<p class='text-info'> Não há documento(s) esperando avaliação de solicitação</strong> </p> <br><br>";
				}
				if ($row_doc == 1) {
					echo "<p class='text-info'> Há $row_doc documento esperando avaliação de solicitação</strong> </p> <br><br>";
				}
				if ($row_doc > 1) {
					echo "<p class='text-info'> Há $row_doc documentos esperando avaliação de solicitação</strong> </p> <br><br>";
				}
				
			?>
		</div>
	</div>
	<br>
	<ul class="list-inline banner-social-buttons text-center">
		<li>
			<button type="submit" class="btn btn-warning" onclick="dados()">Dados pessoais</button>
		</li>
		<li>
			<button type="submit" class="btn btn-warning" onclick="cadastrados()">Usuários cadastrados</button>
		</li>
		<li>
			<button type="submit" class="btn btn-warning" onclick="editar()">Editar Cadastro</button>
		</li>
		<li>
			<button type="submit" class="btn btn-warning" onclick="historico()">Histórico</button>
		</li>
		<li>
			<button type="submit" class="btn btn-success" onclick="cadastrar()">Avaliar alunos(as)</button>
		</li>
        <li>
            <button type="submit" class="btn btn-success" onclick="cadastrar_prof()">Avaliar professores(as)</button>
        </li>
		<li>
			<button type="submit" class="btn btn-success" onclick="documentos()">Avaliar documentos</button>
		</li>
	</ul>
		<ul class="list-inline banner-social-buttons text-center">
		<li>
			<button type="submit" class="btn btn-danger" onclick="sair()">Sair</button>
		</li>
		</ul>

	<script>
		function dados() {
			window.location.replace("dados-secretaria.php");
		}

		function historico() {
			window.location.replace("historico_documentos.php");
		}

		function editar() {
			window.location.replace("usuario-secretaria-editar-selecionar.php");
		}

		function cadastrados() {
			window.location.replace("usuarios-cadastrados.php");
		}		

		function cadastrar() {
			window.location.replace("aprovar-cadastro-aluno.php");
		}

        function cadastrar_prof() {
            window.location.replace("aprovar-cadastro-professor.php");
        }

		function documentos() {
			window.location.replace("aprovar-documentos.php");
		}

		function sair() {
			window.location.replace("logout.php");
		}
	</script>
</body>
</html>

