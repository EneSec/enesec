<?php
SESSION_START();
include("config.php");
if($_SESSION['Permissao'] != "aluno" || !isset($_POST['doc']))
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

		<title>EneSec - Solicitação de documentos</title>

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
if($_SESSION['Permissao'] != "aluno" || !isset($_POST['doc']))
{
	include('logout.php');
}
else{

    date_default_timezone_set('America/Sao_Paulo');
    $pedido = date('d/m/Y');
    $modalidade = $_SESSION['Permissao'];
    $matricula = $_SESSION['Matricula'];
    $nome = $_SESSION['Nome'] ." " .$_SESSION['Sobrenome'];
    $email = $_SESSION['Email'];
    $curso = $_SESSION['Curso'];
    $documento = $_POST['doc'];
    $modo = $_POST['modo'];
    $id=$_SESSION['ID'];
    $protocolo = date('d').date('m').date('y').date('s').$id;
    
    $verificar = mysqli_query($con, "SELECT * FROM `documentos` WHERE matricula = '$matricula' AND documento = '$documento'");
	
     if(mysqli_num_rows($verificar) != 0){
     echo "<h2 class='text-info' style='text-align: center'> Você já solicitou este documento!</br></br> Pedido negado </h1>";
	 echo " <div class='container text-center'>
            <input type = 'button' class='btn btn-info' value = 'Voltar' onclick = 'retornar()'>
        	</div> ";
     }
     else{
        $sql = mysqli_query($con, "INSERT INTO `documentos` (`modalidade`, `matricula`, `nome`, `email`, `curso`, `modo`, `documento`, `data_de_pedido`,`protocolo`) VALUES ('$modalidade', '$matricula', '$nome', '$email', '$curso', '$modo', '$documento', '$pedido','$protocolo')");
        
		if($sql)
		{
		echo "<h2 class='text-info' style='text-align: center'> Documento solicitado </h1>";
		echo " <div class='container text-center'>
            <input type = 'button' class='btn btn-info' value = 'Voltar' onclick = 'retornar()'>
        	</div> ";
		}
		else
		{
			echo "<h2 class='text-info' style='text-align: center'>Erro ao solicitar documento, por favor tente novamente. </h1>";
			echo " <div class='container text-center'>
            <input type = 'button' class='btn btn-info' value = 'Voltar' onclick = 'retornar()'>
        	</div> ";
			
		}
	}
    		
  }
?>
     

        <script>
            function retornar() {
                window.location.replace("usuario-aluno.php");
            }
        </script>
    </body>

</html>


