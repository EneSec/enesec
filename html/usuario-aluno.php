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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
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
			<?php
				$email = $_SESSION['Email'];

				$espera = mysqli_query($con, "SELECT * FROM `documentos` WHERE email = '$email'");
				$aceito = mysqli_query($con, "SELECT * FROM `historico` WHERE email = '$email' AND status = 'Aceito'");
				$rejeitado = mysqli_query($con, "SELECT * FROM `historico` WHERE email = '$email' AND status = 'Rejeitado'");

				$row_espera = mysqli_num_rows($espera);
				$row_aceito = mysqli_num_rows($aceito);
				$row_rejeitado = mysqli_num_rows($rejeitado);
				//documentos pendentes
				if($row_espera == 0){
					echo "<p class='text-info text-center'> <strong> Não há solicitações de documentos pendentes na secretaria. </p> <br>";
				}
				if($row_espera == 1){
					echo "<p class='text-info text-center'> <strong> Há $row_espera solicitação de documentos pendente na secretaria. Espere até que seu pedido seja avaliado. </p> <br>";
				}
				if ($row_espera > 1) {
					echo "<p class='text-info text-center'> <strong> Há $row_espera solicitações de documentos pendentes na secretaria. Espere até que seu pedido seja avaliado. </p> <br>";
				}
				//documentos aceitos
				if ($row_aceito == 0) {
					echo "<p class='text-info text-center'> Não há solicitações de documentos aceitas. </p> <br>";
				}
				if ($row_aceito == 1) {
					echo "<p class='text-info text-center'> Há $row_aceito solicitação de documentos aceita. </p> <br>";
				}
				if ($row_aceito > 1) {
					echo "<p class='text-info text-center'> Há $row_aceito solicitações de documentos aceitas. </p> <br>";
				}
				//solicitações rejeitadas
				if ($row_rejeitado == 0) {
					echo "<p class='text-info text-center'> Não há solicitações de documentos rejeitadas. </p> <br>";
				}
				if ($row_rejeitado == 1) {
					echo "<p class='text-info text-center'> Há $row_rejeitado solicitação de documentos rejeitada. </p> <br>";
				}
				if ($row_rejeitado > 1) {
					echo "<p class='text-info text-center'> Há $row_rejeitado solicitações de documentos rejeitadas. </p> <br>";
				}
				//mensagem de aviso
				echo "<p class='text-info text-center'> Caso haja algum problema com uma das solicitações, compareça à secretaria para esclarecimento. </strong></p> <br><br>";
			?>
		</div>
	</div>
	<br>
	<ul class="list-inline banner-social-buttons text-center">
		<li>
			<button type="button" class="btn btn-warning" onclick="dados()"> Dados pessoais </button>
		</li>
		<li>
			<form action="solicitar-documentos-aluno.php">
				<input type="submit" class="btn btn-warning" value="Solicitar documentos">
			</form>	
		</li>
		<li>
			<form action="logout.php">
				<input type="submit" class="btn btn-danger" value="Sair">
			</form>	
		</li>
	</ul>

	<script>
		function dados(){
			window.location.replace("dados-aluno.php");
		}
	</script>

				<!-- jQuery -->
		    <script src="vendor/jquery/jquery.js"> </script>

		    <!-- Bootstrap Core JavaScript -->
		    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

		    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		    <!-- Plugin JavaScript -->
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

		    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/
		    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>-->

		    <script src ="js/bootstrap-select.js" type="text/javascript"></script>
		    <script src ="js/bootstrap-select.min.js" type="text/javascript"></script>
		    <script type="text/javascript">
</body>
</html>

