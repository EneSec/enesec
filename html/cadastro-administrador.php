<?php
	SESSION_START();
	if($_SESSION['Permissao'] != "admin")
	{
		include('logout.php');
	}
	?>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>EneSec - Cadastro de novo(a) administrador(a)</title>

		<!-- Bootstrap Core CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom Fonts -->
		<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"
		<!-- Theme CSS -->
		<link href="css/grayscale.min.css" rel="stylesheet">

		<script src="jquery.js" type="text/javascript"></script>
		<script src="jquery.maskedinput.js" type="text/javascript"></script>

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
<?php
	include("config.php");
	include("valida-cpf.php");
    $nome=$_POST['Nome'];
	$sobrenome=$_POST['Sobrenome'];
	$email=$_POST['Email'];
    $senha=$_POST['Senha'];
    $senha2=$_POST['Senha2'];
    $data=$_POST['Data'];
	$identidade=$_POST['Identidade'];
	$orgao=$_POST['Orgao'];
    $cpf=$_POST['CPF'];
    $endereco=$_POST['endereco'];
	$cep=$_POST['CEP'];
	$senha = hash('sha256',$senha);
	$senha2= hash('sha256',$senha2);

	$check = mysqli_query($con,"SELECT * FROM admin WHERE email = '$email'");
	$rows = mysqli_num_rows($check);

	if($senha == $senha2 && valida_cpf($cpf) && $rows == 0)
	{
		mysqli_query($con,"INSERT INTO `admin` (`nome`, `sobrenome`, `data_de_ nascimento`, `email`, `senha`, `cpf`, `identidade`, `orgao_expeditor`, `endereco`, `cep`)
		VALUES('$nome', '$sobrenome', '$data', '$email', '$senha', '$cpf', '$identidade', '$orgao', '$endereco', '$cep')");

	   echo "<h2 class='text-info' style='text-align: center'> Administrador cadastrado com sucesso </h1>";
	   	echo "<div class='container text-center'>";
		echo "<input type = 'button' class='btn btn-info' value = 'Voltar' onclick = 'retornar()' style='text-align: center'>";
	   	echo "</div>";
	}
	else if ($senha != $senha2){
			echo"<script>alert('Senhas incompatíveis.');</script>";
			header('Location: javascript:window.history.go(-1)');
	}
	else if (!valida_cpf($cpf)){
			echo"<script>alert('CPF inválido.');</script>";
			header('Location: javascript:window.history.go(-1)');
	}
	else
	{
		echo"<script>alert('Email já cadastrado.');</script>";
		header('Location: javascript:window.history.go(-1)');
	}
	
?>
		<script>
			function retornar() {
				window.location.replace("usuario-administrador.php");
			}
		</script>
	</body>

</html>

