<html>

    <head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"
        <!-- Theme CSS -->
        <link href="css/grayscale.min.css" rel="stylesheet">

        <script src="jquery.js" type="text/javascript"></script>
        <script src="jquery.maskedinput.js" type="text/javascript"></script>

    <title>EneSec - Deletar conta</title>
    
    <link rel="stylesheet" href="css/barra_do_governo.css">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    
	  <script type='text/javascript'>

        function index()
        {
            setTimeout("window.location='index.html'",0001);
        }
		function voltar()
        {
            setTimeout("window.location='deletar_conta.html'",0001);
        }
        
    </script>
	
</head>

<?php
	include('config.php');
	if(isset($_GET['code']))
    {
        $codigo = $_GET["code"];
        $email = base64_decode($codigo);
        $selecionar = mysqli_query($con,"SELECT * FROM `deletar_conta` WHERE codigo = '$codigo' AND data > NOW()");
        
        if(mysqli_num_rows($selecionar) >= 1 )
        {
			
			$query1 = "DELETE  FROM `admin` WHERE email = '$email'";
			$query2 = "DELETE  FROM `alunos` WHERE email = '$email'";
			$query3 = "DELETE  FROM `secretaria` WHERE email = '$email'";
			$query4 = "DELETE  FROM `professores` WHERE email = '$email'";
			
			$sql1 = mysqli_query($con,$query1);
			$sql2 = mysqli_query($con,$query2);
			$sql3 = mysqli_query($con,$query3);
			$sql4 = mysqli_query($con,$query4);
			
			if($sql1 || $sql2 || $sql3 || $sql4)	// Deletou de algum lugar
			{
				$mudar = mysqli_query($con,"DELETE FROM `deletar_conta` WHERE codigo = '$codigo'");
				if($mudar)
				{
					echo"<script>alert('Conta deletada com sucesso!');</script>";
					echo"<script>index()</script>";
				}
				else
				{
					echo"<script>alert('Ocorreu um erro, por favor tente novamente.');</script>";
					echo"<script>index()</script>";
				}
			}
			else{
				echo"<script>alert('Não há nenhum usuário com esse e-mail registrado no sistema.');</script>";
				echo"<script>index()</script>";
			}
		}
		else{
			echo"<script>alert('Link expirado!');</script>";
            echo"<script>index()</script>";
		}
	}
	else{
		echo"<script>alert('Ocorreu um erro, por favor tente novamente.');</script>";
        echo"<script>index()</script>";
	}
?>
