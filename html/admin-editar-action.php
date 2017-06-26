<?php
  SESSION_START();

  include('config.php');

  include('valida-cpf.php');

  $nome = $_POST['Nome'];
  $sobrenome = $_POST['Sobrenome'];
  $email = $_POST['Email'];
  $identidade = $_POST['Identidade'];
  $endereco = $_POST['Endereco'];
  $cep = $_POST['CEP'];
  $cpf = $_POST['CPF'];

  $_SESSION["Email"] = $email;
  $_SESSION["Nome"] = $nome;
  $_SESSION["Sobrenome"] = $sobrenome;
  $_SESSION["Identidade"] = $identidade;
  $_SESSION["CPF"] = $cpf;
  $_SESSION["Endereco"] = $endereco;
  $_SESSION["CEP"] = $cep;

  $id = $_GET['id'];

  if( valida_cpf($cpf) ) {

    $sqlquery = "UPDATE `admin` SET `nome` = '$nome', `sobrenome` = '$sobrenome', `cpf` = '$cpf', `identidade` = '$identidade', `endereco` = '$endereco', `cep` = '$cep' WHERE `admin`.`id` = $id";

    $sql = mysqli_query($con, $sqlquery);

    if($sqlquery)
      echo "<script type='text/javascript'>alert('Usuario editado com sucesso!');</script>";

    else
      echo "<script type='text/javascript'>alert('Erro ao editar usuario.Por favor tente novamente.');</script>";
    
    echo "<script type='text/javascript'>";
    echo "window.location.href='usuario-administrador.php';";
    echo "</script>";

  }

  else {
    echo "<script type='text/javascript'>alert('CPF inválido. Digite no seguinte formato: 111.111.111-1')";
    echo "window.location.href='admin-editar.php';";
    echo "</script>";
  }
?>


<html>

  <body style="background-color: #FFFFFF">
  </body>

</html>

