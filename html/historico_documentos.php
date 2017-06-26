<?php
	SESSION_START();
	include('config.php');
	if($_SESSION['Permissao'] != "secretaria")
	{
		include('logout.php');
	}

	$listaSQL = "SELECT * FROM `historico` ORDER BY `id`";

	// Executa a query (o recordset $rs contém o resultado da query)
	$rs = mysqli_query($con,$listaSQL);
?>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EneSec - Histórico de documentos</title>

    <link rel="stylesheet" href="css/barra_do_governo.css">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"
    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="vendor/DataTables/media/js/jquery.js"></script>
	<script src="vendor/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function()
		{
			$('#documento').dataTable({
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

	<div class="container" style="color: #000000">
		<table id="documento" class="table table-hover" style="color: #000000">
			<thead id="header">
				<tr class="info">
					<th> Nº de Protocolo </th>
					<th> Data de avaliação </th>
					<th> Matrícula </th>
					<th> Nome </th>
					<th> Curso </th>
					<th> Documento </th>
					<th> Modo</th>
					<th> Motivo de Rejeição </th>
				</tr>
			</thead>

			<tbody id="fileira">
				
					<?php 
					if($rs->num_rows > 0) {
					while($row = mysqli_fetch_assoc($rs))
					{
						echo "<tr>";
						echo "<td id='fileira'>" .$row['protocolo']  ."</td>" ;
						echo "<td id='fileira'>" .$row['data_de_atendimento']  ."</td>" ;
						echo "<td id='fileira'>" .$row['matricula'] ."</td>";
						echo "<td id='fileira'>" .$row['nome'] ."</td>";
						echo "<td id='fileira'>" .$row['curso']  ."</td>";
						echo "<td id='fileira'>" .$row['documento'] ."</td>";
						echo "<td id='fileira'>" .$row['modo']  ."</td>";
						echo "<td id='fileira'>" .$row['motivo'] ."</td>";
						echo "</tr>";
					}
					}
					else {
							echo "<tr>";
							echo "<td>";
							echo "Nenhum resultado encontrado.";
							echo "<tr>";
							echo "</tr>";
						}
					?>
				
			</tbody>
		</table>

		<input class="btn btn-danger" value="Voltar" onclick="voltar()">
	</div>

</body>

<script>
	function voltar(){
		window.location.replace("usuario-secretaria.php");
	}
</script>

</html>

