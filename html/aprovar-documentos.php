<?php
  SESSION_START();

  include('config.php');

  if($_SESSION['Permissao'] != "secretaria") {
    include('logout.php');
  }

  $listaSQL = "SELECT * FROM `documentos` ORDER BY `id`";

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

    <title>EneSec - Aprovação de documentos</title>

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
        $('#documento').dataTable( {
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

    <h1 class="text-info text-center"> Aprovação de documentos </h1>

    <div class="container" style="color: #000000">
      <table id="documento" class="table table-hover" style="color: #000000">
        <thead id="header">
          <tr class="info">
            <th> Nº de Protocolo </th>
            <th> Modalidade </th>
            <th> Matrícula </th>
            <th> Nome </th>
            <th> Curso </th>
            <th> Documento </th>
            <th> Modo</th>
            <th> Aceitar </th>
            <th> Rejeitar </th>
            <th> Motivo de Rejeição </th>
          </tr>
        </thead>

        <tbody id="fileira">

          <?php
            if($rs->num_rows > 0) {
              while($row = mysqli_fetch_assoc($rs)) {
                echo "<tr>";
                echo "<td id='fileira'>" .$row['protocolo']  ."</td>" ;
                echo "<td id='fileira'>" .$row['modalidade']  ."</td>" ;
                echo "<td id='fileira'>" .$row['matricula'] ."</td>";
                echo "<td id='fileira'>" .$row['nome'] ."</td>";
                echo "<td id='fileira'>" .$row['curso']  ."</td>";
                echo "<td id='fileira'>" .$row['documento'] ."</td>";
                echo "<td id='fileira'>" .$row['modo']  ."</td>";
                echo "<td id='fileira'>". "<button href='javascript:void(0)' onclick='confirmar({$row['id']});'  class='btn btn-success'> <span class='glyphicon glyphicon-ok-sign' aria-hidden='true'></span> </button> </td>";
                echo "<td id='fileira'>". "<button href='javascript:void(0)' onclick='rejeitar({$row['id']});'  class='btn btn-danger'> <span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span> </button> </td>";
                echo "<td id='fileira'> <textarea class='form-control' rows='3' name='motivo'></textarea>";
                echo "</tr>";
              }
            }

            else {
              echo "<tr>";
              echo "<td>";
              echo "Nenhum documento pendente.";
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
  </body>

  <script type="text/javascript">

    function confirmar(id) {
      var redirect = 'finalizar-documentos.php?id=' + id + '&value=1';
      window.location.href = redirect;
    }

    function rejeitar(id) {
      var redirect = 'finalizar-documentos.php?id=' + id + '&value=0';
      var x = confirm("Tem certeza que deseja rejeitar?");
      if(x)
        window.location.href = redirect;
    }

    document.getElementById("aceitar").onsubmit = function() {
      return true;
    };

    function retornar() {
      window.location.replace("usuario-secretaria.php");
    }

  </script>
  
</html>

