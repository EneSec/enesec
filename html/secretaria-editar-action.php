<?php
    SESSION_START();
  	include('config.php');
  	include('valida-cpf.php');
    $nome=$_POST['Nome'];
  	$sobrenome=$_POST['Sobrenome'];
  	$email=$_POST['Email'];
  	$identidade=$_POST['Identidade'];
  	$orgao=$_POST['Orgao'];
    $cpf=$_POST['CPF'];

    $id = $_GET['id'];
    $tbName = $_GET['tb'];

    if($tbName == 'alunos'){
    	$identificador = $_POST['Identificador'];
      $identificadorName = 'matricula';
    }
    else{
    	$identificador = $_POST['Identificador'];
      $identificadorName = 'identificador';
    }

  	if(valida_cpf($cpf)){
      $sqlquery = "UPDATE `$tbName` SET `nome` = '$nome', `sobrenome` = '$sobrenome', `$identificadorName` = '$identificador',
                            `email` = '$email', `identidade` = '$identidade', `orgao_expeditor` = '$orgao', `cpf` = '$cpf'
                            WHERE `id` = '$id'";

      $sql = mysqli_query($con, $sqlquery);
      echo "<script type='text/javascript'>alert('Usuario editado com sucesso!');";
	  echo "window.location.href='usuario-secretaria.php';";
	  echo "</script>";
    }
  		else {
        echo"<script type='text/javascript'>alert('CPF inválido. Digite no seguinte formato: 999.999.999-99');";
		echo "window.location.href='secretaria-editar.php?tb=$tbName';";
		echo "</script>";
      }
	  
  ?>
  <html>

    <body style="background-color: #FFFFFF">
    </body>

</html>

