<?php
	SESSION_START();
	include('config.php');
	include('mensagem_email.php');
	if($_SESSION['Permissao'] != "secretaria" && $_SESSION['Permissao'] != "admin")
	{
		include('logout.php');
	}
?>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>EneSec - Aprovação de cadastros</title>

  <link rel="stylesheet" href="css/barra_do_governo.css">

	<!-- Bootstrap Core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"
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

	<?php
	$id = $_GET['id'];
	$value = $_GET['value'];
		$sql = mysqli_query($con, "SELECT * FROM `professores_pendentes` WHERE id = $id");
		$row = $sql->fetch_assoc();

		$nome=$row['nome'];
		$sobrenome=$row['sobrenome'];
		$matricula=$row['identificador'];
		$email=$row['email'];
		$senha=$row['senha'];
		$data=$row['data_de_nascimento'];
		$identidade=$row['identidade'];
		$orgao=$row['orgao_expeditor'];		//tava $row['orgao']
		$cpf=$row['cpf'];
		$tipo=$row['tipo'];
		$cadastro=date('d/m/Y');
		$endereco=$row['endereco'];
		$cep=$row['cep'];
		
		$send_email = false;

		if($value == "1")
		{
				 $sql = mysqli_query($con, "INSERT INTO `professores` (`nome`, `sobrenome`, `data_de_nascimento`, `email`, `cpf`, `senha`, `tipo`, `data_de_cadastro`, `identificador`, `identidade`, `orgao_expeditor`, `endereco`, `cep`)
		VALUES ('$nome', '$sobrenome', '$data', '$email', '$cpf', '$senha', '$tipo', '$cadastro', '$matricula', '$identidade', '$orgao', '$endereco', '$cep')");
			
			if($sql)
			{
				$send_email = true;		// Libera envio do email
				echo "<script type='text/javascript'>";
				echo "alert('Usuário cadastrado com sucesso.')";
				echo "</script>";	
				//deleta
				$sql = mysqli_query($con, "DELETE FROM `professores_pendentes` WHERE `id` = $id"); //Não exclui ;-; - Agora exclui por id
			}
			else{
				echo "<script type='text/javascript'>";
				echo "alert('Erro ao cadastrar usuário. Por favor tente novamente.')";
				echo "</script>";	
			}
		}

		$to = $email;
		if($value == "1") //email dizendo que o cadastro foi aceito
		{
			$texto = "Seu cadastro foi concluído com sucesso! <br><br> Qualquer problema, basta entrar em contato através de nossos telefones ou pessoalmente.";
		}
		else if($value == "0") //email dizendo que o cadastro foi rejeitado
		{
			$send_email = true;
			$texto = "Ocorreu um erro na realização do seu cadastro. Por favor, entre em contato conosco.";
			echo "<script type='text/javascript'>";
			echo "alert('Usuário rejeitado com sucesso.')";
			echo "</script>";
			$sql = mysqli_query($con, "DELETE FROM `professores_pendentes` WHERE `id` = $id"); 
		}
		$objeto_mensagem = new mensagem;
		$message = $objeto_mensagem->get_mensagem($nome,$texto);

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// main header
$headers  = "From: EneSec <ptr012017a@redes.unb.br>".$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
//$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;
		
		if($send_email)
			$envio = mail($to, "Solicitação de cadastro", $body, $headers);

		?>

		<script>
			window.location.replace("aprovar-cadastro-professor.php"); //substituindo o header
		</script>

</body>
</html>



