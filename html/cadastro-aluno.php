<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>EneSec - Cadastro de novo(a) aluno(a)</title>

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
	include('config.php');
	include('valida-cpf.php');
	date_default_timezone_set('America/Sao_Paulo');
	$cadastro = date('d,m,Y');
    $nome=$_POST['Nome'];
	$sobrenome=$_POST['Sobrenome'];
	$matricula=$_POST['Matricula'];
	$email=$_POST['Email'];
    $senha=$_POST['Senha'];
    $senha2=$_POST['Senha2'];
    $data=$_POST['Data'];
	$identidade=$_POST['Identidade'];
	$orgao=$_POST['Orgao'];
    $cpf=$_POST['CPF'];
    $curso=$_POST['Curso'];
	$nivel=$_POST['Nivel'];
	$grau="Bacharelado";
	$periodo=$_POST['Periodo'];
	$endereco=$_POST['endereco'];
	$cep=$_POST['CEP'];
	$prova=$_POST['Prova'];
	$ingresso=$periodo." - ".$prova;
	$turno="Diurno";
	$status="Aluno regular";
	$senha = hash('sha256',$senha);
	$senha2= hash('sha256',$senha2);


	$check = mysqli_query($con,"SELECT * FROM alunos WHERE matricula = '$matricula' AND email = '$email'");
	$rows = mysqli_num_rows($check);

	if($nivel != "Graduação" && $curso != "Engenharia Elétrica")
	{
		echo"<script>alert('Opções de mestrado e doutorado só podem ser realizados em engenharia elétrica');</script>";
	}
	else if($senha == $senha2 && valida_cpf($cpf) && $rows == 0){

		   $sql = mysqli_query($con, "INSERT INTO `alunos_pendentes` (`nome`, `sobrenome`, `data_de_nascimento`, `email`, `cpf`, `senha`, `status`, `curso`, `data_de_cadastro`, `matricula`, `grau`, `nivel`, `identidade`, `orgao_expeditor`, `turno`, `ingresso`, `endereco`, `cep`)
												VALUES ('$nome', '$sobrenome', '$data', '$email', '$cpf', '$senha', '$status', '$curso', '$cadastro', '$matricula', '$grau', '$nivel', '$identidade', '$orgao', '$turno', '$ingresso', '$endereco', '$cep')");

// a random hash will be necessary to send mixed content
$separator = md5(time());
// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;
																							
			$to = $email;
			$subject = "Solicitação de cadastro enviada";
			$headers  = "From: EneSec <ptr012017a@redes.unb.br>".$eol;
			$headers .= "MIME-Version: 1.0".$eol;
			$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";	
			

$message = '
<!DOCTYPE html PUBLIC>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>EneSec Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body style="margin: 0; padding: 0;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc;">
      <tr>
        <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0;">
          <a href="https://homol.redes.unb.br/enesec/"><img src="https://homol.redes.unb.br/enesec/img/logo.png" alt="EneSec logo" width="242" height="76" style="display: block;" />
        </td>
      </tr>
      <tr>
        <td bgcolor="#003366" style="padding: 40px 30px 40px 30px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 24px;">
                <b>Olá, ' . $nome . '!</b>
                <br><br>
              </td>
            </tr>
            <tr>
              <td align="justify" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                Recebemos uma solicitação de cadastro. Aguarde até que seu cadastro seja avaliado.
                <br><br>
                Qualquer problema, basta entrar em contato através de nossos telefones ou pessoalmente.
                <br><br>    
                Atenciosamente,<br>
                Equipe da EneSec e Secretaria do Departamento de Engenharia Elétrica
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td bgcolor="#006633" style="padding: 30px 30px 30px 30px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                &reg; EneSec, 2017<br/>
                
                Você está recebendo esse e-mail porque está cadastrado em nosso site. Caso deseje parar de receber nossos e-mails, é necessário que delete sua conta <a href="https://homol.redes.unb.br/enesec/deletar_conta.html"" style="color: #ffffff;"><font color="#ffffff">clicando aqui</font></a>.
              </td>
              <td align="right">
                <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
                      <a href="http://www.twitter.com/">
                        <img src="https://homol.redes.unb.br/enesec/img/twitter.jpg" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                      </a>
                    </td>
                    <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                      <td>
                        <a href="http://www.facebook.com/">
                          <img src="https://homol.redes.unb.br/enesec/img/facebook.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                      </a>
                    </td>
                  </tr>
                </table>
              </td>  
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
';


	
$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
//$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

			$envio = mail($to, $subject, $body, $headers);



		   echo "<h2 class='text-info' style='text-align: center'> Cadastro enviado para avaliação </h1>";
		   echo "<h3 class='text-info' style='text-align: center'> Retorne à página de login e espere uma confirmação por e-mail para começar a utilizar o nosso sistema </h2>";
		   echo "<div class='container text-center'>";
	   		echo "<input type = 'button' class='btn btn-info' value = 'Voltar' onclick = 'retornar()'>";
	   		echo "</div>";
	}else{

		if($senha != $senha2 )
			echo"<script>alert('Senhas diferentes');</script>";
		else if(!valida_cpf($cpf))
				echo"<script>alert('CPF inválido.');</script>";
		else if($rows != 0)
			echo"<script>alert(Matrícula ou email já cadastrado.');</script>";

		header('Location: javascript:window.history.go(-1)');
	}
?>



		<script>

			function retornar() {
				window.location.replace("index.html");
			}
		</script>
	</body>

</html>


