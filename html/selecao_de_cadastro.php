<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<title>EneSec - Seleçao de usuário</title>
	</head>
	
	<body>
<?php
	$tipo = $_POST['tipo'];
	
	if($tipo == "Aluno")
		echo "<script>window.location = 'cadastro-aluno.html';</script>";
		else if($tipo == "Professor")
			echo "<script>window.location = 'cadastro-professor.html';</script>";
			else if($tipo == "Secretaria")
				echo "<script>window.location = 'cadastro-secretaria.html';</script>";
					else echo "<script>window.location = 'selecao_de_cadastro.html';</script>";
				
?>
	</body>

</html>