<?php
  SESSION_START();

  include('config.php');

  if($_SESSION['Permissao'] != "admin") {
  include('logout.php');
  }

  $listaSQL = "SELECT * FROM `secretaria_pendentes` ORDER BY `id`";

  // Executa a query (o recordset $rs contém o resultado da query)
  $rs = mysqli_query($con, $listaSQL);
?>


<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EneSec - Aprovação de cadastros</title>

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
    <script src="vendor/DataTables/media/js/jquery.js"></script>
    <script src="vendor/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#secretaria').dataTable({
                                    "bJQueryUI": true,
                                    "oLanguage": {
                                                    "sProcessing":   "Processando...",
                                                    "sLengthMenu":   "Mostrar _MENU_ registros",
                                                    "sZeroRecords":  "Não foram encontrados resultados",
                                                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                                                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                                                    "sInfoFiltered": "",
                                                    "sInfoPostFix":  "",
                                                    "sSearch":       "Buscar:",
                                                    "sUrl":          "",
                                                    "oPaginate": {
                                                                    "sFirst":    "Primeiro",
                                                                    "sPrevious": "Anterior",
                                                                    "sNext":     "Seguinte",
                                                                    "sLast":     "Último"
                                                                  }
                                                  }
                                  });
        });
    </script>

  </head>

  <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" style="background-color: #FFFFFF">

    <!-- Barra do Governo no topo da página -->
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

    <h1 class="text-info text-center"> Cadastro de funcionários(as) da secretaria </h1>

    <div class="container" style="color: #000000">
      <table id="secretaria" class="table table-hover" style="color: #000000">
        <thead id="header">
          <tr class="info">
            <th> Nome </th>
            <th> Matrícula </th>
            <th> E-mail </th>
            <th> CPF </th>
            <th> Cadastrar </th>
            <th> Rejeitar </th>
          </tr>
        </thead>

        <tbody id="fileira">

          <?php
            if($rs->num_rows > 0) {
              while($row = $rs->fetch_assoc()) {
                echo "<tr>";
                echo "<td id='fileira'>" .$row['nome']  ." " .$row['sobrenome'] ."</td>" ;
                echo "<td id='fileira'>" .$row['identificador'] ."</td>";
                echo "<td id='fileira'>" .$row['email']  ."</td>";
                echo "<td id='fileira'>" .$row['cpf']  ."</td>";
                echo	"<td id='fileira'> <button href='javascript:void(0)' onclick='confirmar({$row['id']});' class='btn btn-success'> <span class='glyphicon glyphicon-ok-sign' aria-hidden='true'></span> </button> </td>";
                echo	"<td id='fileira'> <button href='javascript:void(0)' onclick='rejeitar({$row['id']});' class='btn btn-danger'> <span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span> </button> </td>";
                echo "</tr>";
              }
            }

            else {
              echo "<tr>";
              echo "<td>";
              echo "Não há cadastros pendentes.";
              echo "<tr>";
              echo "</tr>";
            }
          ?>

        </tbody>
      </table>

      <br><br>

      <div class="container text-center">
        <input type = "button" class="btn btn-danger" value = "Voltar" onclick = "retornar()">
      </div>
    </div>

    <script>

      function confirmar(id) {
        var redirect = 'cadastrar-secretaria.php?id=' + id + '&value=1';
        window.location.href = redirect;
      }

      function rejeitar(id) {
        var redirect = 'cadastrar-secretaria.php?id=' + id + '&value=0';
        var x = confirm("Tem certeza que deseja rejeitar?");
        if(x)
          window.location.href = redirect;
      }

      function retornar() {
        window.location.replace("usuario-administrador.php");
      }

    </script>
  </body>
</html>


