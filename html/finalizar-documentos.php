<?php
	SESSION_START();
	include('config.php');
	include('mensagem_email.php');
	if($_SESSION['Permissao'] != "secretaria")
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

    <title>EneSec - Aprovação de documentos</title>

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
		$sql = mysqli_query($con, "SELECT * FROM `documentos` WHERE id = '$id'");
		$row = $sql->fetch_assoc();

		date_default_timezone_set('America/Sao_Paulo');
		$atendimento = date('d/m/Y');
		$email=$row['email'];
		$nome=$row['nome'];
		$modalidade=$row['modalidade'];
		$matricula=$row['matricula'];
		$curso=$row['curso'];
		$modo=$row['modo'];
		$documento=$row['documento'];
		$protocolo=$row['protocolo'];
		$motivo = $_GET['motivo'];
		
		// Email STUFF
		$to = $email;
		$subject = "EneSec - Documento pronto";
		$texto = 'Você solicitou uma declaração de aluno regular em seu nome para a secretaria do Departamento de Engenharia Elétrica da UnB. Ela encontra-se pronta na secretaria.'; 
		$objeto_mensagem = new mensagem;
		$message = $objeto_mensagem->get_mensagem($nome,$texto);

// a random hash will be necessary to send mixed content
$separator = md5(time());
// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

$headers  = "From: EneSec <ptr012017a@redes.unb.br>".$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";	
	
$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
//$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

		if($value == "0")
		{
			$status="Rejeitado";
			if($motivo == "")
				$motivo ="Motivo não especificado";
		}
		else if($value == "1")
		{
			$status="Aceito";
			$motivo="--";
		}

		$historico = mysqli_query($con, "INSERT INTO `historico`(`protocolo`,`modalidade`, `matricula`, `nome`, `email`, `curso`, `modo`, `documento`, `status`, `motivo`, `data_de_atendimento`) VALUES ('$protocolo','$modalidade','$matricula','$nome','$email','$curso','$modo','$documento','$status','$motivo','$atendimento')");
		// Caso va por email, exclui apenas caso email seja enviado com sucesso
		//$query = mysqli_query($con, "DELETE FROM `documentos` WHERE id = '$id'");

		if($value == "1")
		{
			if($documento != "Declaração de aluno regular")
			{
				if($modo == "PDF por e-mail")
				{
					$_SESSION["DocEmail"] = $email;
					$_SESSION["Doc"] = $documento;
					$_SESSION["idDoc"]=$id;
					$_SESSION["DocNome"]=$nome;
					echo "<script>";
					echo	"var redirect = 'upload.html?id=$id';";
					echo	"window.location.href = redirect;";
					echo "</script>";
					//$query = mysqli_query($con, "DELETE FROM `documentos` WHERE id = '$id'");	// Deletar apos confimar upload no outro script
				}
				else {
					$mail_sent = mail($to, $subject, $body, $headers);	// Email avisando documento pronto na secretaria
					if($mail_sent)
					{
						echo "<script language=\"javascript\">";
						echo "var question=confirm(\"Confime caso o documento esteja pronto.\");";
						echo "if(question){ alert(\"Email enviado ao usuário avisando que o documento está pronto.\");
						window.location.href = 'delete_documentos.php?id=$id'  } else { }";
						echo "</script>";
					}
					else{
						echo "<script type='text/javascript'>";
						echo "alert(\"Falha ao enviar email. Por favor, tente novamente.\");";
						echo "</script>";
					}
			}
		}
			else if($modo == "Retirar na secretaria")
			{
					$mail_sent = mail($to, $subject, $body, $headers);	// Email avisando documento pronto na secretaria
					
					if($mail_sent)
					{
						$query = mysqli_query($con, "DELETE FROM `documentos` WHERE id = '$id'");
						echo "<script type='text/javascript'>";
						echo "alert(\"Email enviado ao usuário avisando que o documento está pronto.\");";
						// Abrir em nova aba - Problema com POP UP
						//echo "<script language=\"javascript\">window.open(\"Imprimir-Declaração.php?email=$email&id=$id\",\"_blank\");</script>";  
						echo	"var redirect = 'Imprimir-Declaração.php?email=$email';";
						echo	"window.location.href = redirect;";
						echo "</script>";
						
					}
					else
					{
						echo "<script type='text/javascript'>";
						echo "alert(\"Falha ao enviar email. Por favor, tente novamente.\");";
						echo "</script>";
					}
	
			}
			else if($modo == "PDF por e-mail")
			{
				echo "<script type='text/javascript'>";
				$query = mysqli_query($con, "DELETE FROM `documentos` WHERE id = '$id'");
				echo	"var redirect = 'pdf_email.php?email=$email';";
				echo	"window.location.href = redirect;";
				echo "</script>";
			}
		}
		else if($value == "0")
		{
			$subject = "EneSec - Documento rejeitado";
			$texto = 'Você solicitou um documento em seu nome para a secretaria do Departamento de Engenharia Elétrica da UnB. Seu pedido foi rejeitado, consulte a secretaria para mais detalhes.';
			$message = $objeto_mensagem->get_mensagem($nome,$texto);
			$body = "--".$separator.$eol;
			$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
			//$body .= "This is a MIME encoded message.".$eol;

			// message
			$body .= "--".$separator.$eol;
			$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
			$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
			$body .= $message.$eol;
			$mail_sent = mail($to, $subject, $body, $headers);	// Email avisando documento pronto na secretaria
			$query = mysqli_query($con, "DELETE FROM `documentos` WHERE id = '$id'");
		}
	?>

		<script>
			window.location.replace("aprovar-documentos.php"); //substituindo o header
		</script>
</body>
</html>

