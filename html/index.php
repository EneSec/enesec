<?php
	include('config.php');
	session_destroy();
	$email = $_POST["Email"];
	$senha = $_POST["Senha"];
	$senha = hash ('sha256',$senha);
	
	$sql1 = mysqli_query($con,"SELECT * FROM `admin` WHERE Email = '$email' AND Senha = '$senha'");
	$sql2 = mysqli_query($con,"SELECT * FROM `secretaria` WHERE Email = '$email' AND Senha = '$senha'"); 
	$sql3 = mysqli_query($con,"SELECT * FROM `professores` WHERE Email = '$email' AND Senha = '$senha'");
	$sql4 = mysqli_query($con,"SELECT * FROM `alunos` WHERE Email = '$email' AND Senha = '$senha'");
	
	
	$rows1 = mysqli_num_rows($sql1);
	$rows2 = mysqli_num_rows($sql2);
	$rows3 = mysqli_num_rows($sql3);
	$rows4 = mysqli_num_rows($sql4);
	
	if($rows1 > 0 )
	{												//se o usuário for ADMIN
		session_start();
		$result = mysqli_fetch_assoc($sql1);
		
		$_SESSION["Email"] =$email;								//variáveis de sessão setadas
		$_SESSION["Senha"] = $senha;
		$_SESSION["Nome"]=$result['nome'];
		$_SESSION["Sobrenome"]=$result['sobrenome'];
		$_SESSION["Data_de_Nascimento"]= $result['data_de_nascimento'];
		$_SESSION["Identidade"]=$result['identidade'];
		$_SESSION["CPF"]=$result['cpf'];
		$_SESSION["Endereco"]=$result['endereco'];
		$_SESSION["CEP"]=$result['cep'];
		$_SESSION["Orgao"] = $result['orgao_expeditor'];
		$_SESSION["Id"] =$result['id'];
		
		$_SESSION["Permissao"] = "admin";
		
		mysqli_close($con);
		echo "<script>window.location = 'usuario-administrador.php';</script>";
	}

	else if($rows2 > 0 )
	{												//se o usuário for da SECRETARIA
		session_start();
		$result = mysqli_fetch_assoc($sql2);
		
		$_SESSION["Email"] =$email;								//variáveis de sessão setadas
		$_SESSION["Senha"] = $senha;
		$_SESSION["Nome"]=$result['nome'];
		$_SESSION["Sobrenome"]=$result['sobrenome'];
		$_SESSION["Data_de_Nascimento"]=$result['data_de_nascimento'];
		$_SESSION["Data_de_Cadastro"]=$result['data_de_cadastro'];
		$_SESSION["Identificador"]=$result['identificador'];
		$_SESSION["Identidade"]=$result['identidade'];
		$_SESSION["CPF"]=$result['cpf'];
		$_SESSION["Endereco"]=$result['endereco'];
		$_SESSION["CEP"]=$result['cep'];
		
		$_SESSION["Permissao"] = "secretaria";
		mysqli_close($con);
		echo "<script>window.location = 'usuario-secretaria.php';</script>";
	}

	else if($rows3 > 0 )
	{												//se o usuário for PROFESSOR
		session_start();
		$result = mysqli_fetch_assoc($sql3);
		
		$_SESSION["Email"] =$email;								//variáveis de sessão setadas
		$_SESSION["Senha"] = $senha;
		$_SESSION["Nome"]=$result['nome'];
		$_SESSION["Sobrenome"]=$result['sobrenome'];
		$_SESSION["Data_de_Nascimento"]=$result['data_de_nascimento'];
		$_SESSION["Data_de_Cadastro"]=$result['data_de_cadastro'];
		$_SESSION["Identificador"]=$result['identificador'];
		$_SESSION["Identidade"]=$result['identidade'];
		$_SESSION["Tipo"]=$result['tipo'];
		$_SESSION["CPF"]=$result['cpf'];
		$_SESSION["Endereco"]=$result['endereco'];
		$_SESSION["CEP"]=$result['cep'];
		
		$_SESSION["Permissao"] = "professor";
		mysqli_close($con);
		echo "<script>window.location = 'usuario-professor.php';</script>";
	}

	else if($rows4 > 0 )
	{												//se o usuário for ALUNO
		session_start();
		$result = mysqli_fetch_assoc($sql4);
		
		$_SESSION["ID"] = $result['id'];
		$_SESSION["Email"] =$email;								//variáveis de sessão setadas
		$_SESSION["Senha"] = $senha;
		$_SESSION["Nome"]=$result['nome'];
		$_SESSION["Sobrenome"]=$result['sobrenome'];
		$_SESSION["Data_de_Nascimento"]=$result['data_de_nascimento'];
		$_SESSION["Data_de_Cadastro"]=$result['data_de_cadastro'];
		$_SESSION["Identidade"]=$result['identidade'];
		$_SESSION["CPF"]=$result['cpf'];
		$_SESSION["Status"]=$result['status'];
		$_SESSION["Curso"]=$result['curso'];
		$_SESSION["Matricula"]=$result['matricula'];
		$_SESSION["Grau"]=$result['grau'];
		$_SESSION["Turno"]=$result['turno'];
		$_SESSION["Ingresso"]=$result['ingresso'];
		$_SESSION["Endereco"]=$result['endereco'];
		$_SESSION["CEP"]=$result['cep'];
		
		$_SESSION["Permissao"] = "aluno";
		mysqli_close($con);
		echo "<script>window.location = 'usuario-aluno.php';</script>";
	}

	else
	{
		mysqli_close($con);
		echo"<script>alert('Login e senha não compatíveis ou usuário não cadastrado.');</script>";
		echo "<script>window.location = 'index.html';</script>";
	}

			
?>
