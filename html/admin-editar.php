<?php
  SESSION_START();

  if($_SESSION['Permissao'] != 'admin'){
    include('logout.php');
  }

  $nome = $_SESSION['Nome'];
  $sobrenome = $_SESSION['Sobrenome'];
  $email = $_SESSION['Email'];
  $cpf = $_SESSION['CPF'];
  $orgao = $_SESSION['Orgao'];
  $identidade = $_SESSION['Identidade'];
  $id = $_SESSION['Id'];
  $endereco = $_SESSION['Endereco'];
  $cep = $_SESSION['CEP'];

?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EneSec - Página do administrador</title>

    <!-- CSS da Barra do Governo no topo da página -->
    <link rel="stylesheet" href="css/barra_do_governo.css">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <script language="JavaScript"> 
      function pergunta() {
        if (confirm('Confirme para alterar os dados.')){ 
          document.editar.submit();
        } 
      } 
    </script> 

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

    <h1 class="text-center text-info">Edite os campos e depois clique em confirmar</h1>

    <br><br>

    <div class="container" style="color: #000000">
      <div class="col-md-6 col-md-offset-3">
        <form name="editar" action = "admin-editar-action.php?id=<?php echo $id;?>" method="POST">
          <table class="table table-striped">
            <tbody>
              
              <tr>
                <td><strong> Nome: </strong></td>
                <td><input style="text-align:right;" class="form-control" type="text" value="<?php echo $nome;?>" class="form-control" name="Nome" required/></td>
              </tr>
      
              <tr>
                <td><strong> Sobrenome: </strong></td>
                <td><input style="text-align:right;" class="form-control" type="text" value="<?php echo $sobrenome;?>" class="form-control" name="Sobrenome" required/></td>
              </tr>

              <tr>
                <td><strong> E-mail: </strong></td>
                <td><input style="text-align:right;" class="form-control" type="text" value="<?php echo $email;?>" class="form-control" name="Email" required/></td>
              </tr>

              <tr>
                <td><strong> CPF: </strong></td>
                <td><input style="text-align:right;" class="form-control" type="text" value="<?php echo $cpf;?>" class="form-control" name="CPF" id="boxcep" onBlur="validaCPF" required/></td>
              </tr>

              <tr>
                <td><strong> Identidade: </strong></td>
                <td><input style="text-align:right;" class="form-control" type="text" value="<?php echo $identidade;?>" class="form-control" name="Identidade" required/></td>
              </tr>

              <tr>
                <td><strong> Endereço: </strong></td>
                <td><input style="text-align:right;" class="form-control" type="text" value="<?php echo $endereco;?>" class="form-control" name="Endereco" required/></td>
              </tr>

              <tr>
                <td><strong> CEP: </strong></td>
                <td><input style="text-align:right;" class="form-control" type="text" value="<?php echo $cep;?>" class="form-control" name="CEP" id="boxcep" required/></td>
              </tr>

            </tbody>
          </table>

          <div style="text-align: center">
            <ul class="list-inline banner-social-buttons text-center">
              <li>
                <button type="button" class="btn btn-danger" onclick="Cancelar()">Voltar</button>
              </li>

              <li>
                <button type="button" class="btn btn-success" onclick="pergunta()" id="btn-edit">Confirmar</button>
              </li>
            </ul>

          </div>
        </form>
      </div>
    </div>

    <br>

    <script>

      var campo_cpf = false;

      $("#boxcep").mask("99.999-999");


      function validaCPF() {

        strCPF = $("#boxcpf").val();
        strCPF = strCPF.replace(/[^\d]+/g,'');

        var Soma;
        var Resto;
        var cboll = true;
        Soma = 0;

        if (strCPF.length != 11 ||
        strCPF == "00000000000" ||
        strCPF == "11111111111" ||
        strCPF == "22222222222" ||
        strCPF == "33333333333" ||
        strCPF == "44444444444" ||
        strCPF == "55555555555" ||
        strCPF == "66666666666" ||
        strCPF == "77777777777" ||
        strCPF == "88888888888" ||
        strCPF == "99999999999")
          cboll = false;


        for (i=1; i<=9; i++)
          Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);

        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))
          Resto = 0;

        if (Resto != parseInt(strCPF.substring(9, 10)) )
          cboll = false;

        Soma = 0;
        
        for (i = 1; i <= 10; i++)
          Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);

        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))
          Resto = 0;

        if (Resto != parseInt(strCPF.substring(10, 11) ) )
          cboll = false;

        if(!cboll) {
          $('#boxcpf').css('background-color','#FF7171');
          $('#boxcpf').focus();
          campo_cpf = true;
        }

        else {
          $('#boxcpf').css('background-color','#FFF');
          campo_cpf = false;
          return cboll;
        }

      }

      function Cancelar() {
        window.location.replace("usuario-administrador.php");
      }


      $(document).ready( function(){

        //verificar se os campos de usuário e senha foram devidamente preenchidos
        $('#btn-edit').click(function(){

          if(campo_cpf)
            return false;
        });

      });

    </script>

    <script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"/></script>

    <script type="text/javascript">$(document).ready(function(){$("#boxcpf").mask("999.999.999-99");});</script>

  </body>
</html>


