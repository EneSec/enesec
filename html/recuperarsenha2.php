<html>

    <head>
    <script type='text/javascript'>

        function index()
        {
            setTimeout("window.location='index.html'",0001);
        }
        function recupera()
        {
            setTimeout("window.location='recuperarsenha2.php'",0001);
        }
        function checkPss()
        {
            if(document.getElementById('senha').value != "" && document.getElementById('senha2').value != "")
            if(document.getElementById('senha').value == document.getElementById('senha2').value){
                document.getElementById('senha2Input').classList.remove('has-warning');
                document.getElementById('senha2Input').classList.add("has-success");
                document.getElementById('glyphiconIcon').classList.remove('glyphicon-warning-sign');
                document.getElementById('glyphiconIcon').classList.add('glyphicon-ok')
                document.getElementById('glyphiconIcon').setAttribute("hidden", false);
             }
            else{
                document.getElementById('senha2Input').classList.remove('has-success');
                document.getElementById('senha2Input').classList.add("has-warning");
                document.getElementById('glyphiconIcon').classList.remove('glyphicon-ok');
                document.getElementById('glyphiconIcon').classList.add('glyphicon-warning-sign')
                document.getElementById('glyphiconIcon').setAttribute("hidden", false);
             }
         }

    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <title>EneSec - Redefinição de senha</title>
    
    <link rel="stylesheet" href="css/barra_do_governo.css">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    
</head>
 

    <body style = "background-color: #FFFFFF;">
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

<legend><h1 class="text-info text-center"><strong>Alteração de Senha</h1></legend><br>
    <form name="recuperaform" method="post" action="" class="text-left">
        <fieldset>
        <div class="col-md-4 col-md-offset-4">
            <label style="color: #000000"><strong>Digite sua nova senha</strong></label> <input required class="form-control" type="password" name="novasenha" minlength="8" maxlength="16" id="senha" onkeyup="checkPss()"/>
                <span id="helpBlock" class="help-block">Obs: mínimo de 8 caracteres e máximo de 16</span><br>
            <div id="senha2Input" class="form-group has-feedback">
                <label style="color: #000000"><strong>Repita a senha</strong></label> <br> <input type = "password" required class="form-control" name = "novasenha2" minlength="8" maxlength="16" id="senha2" onkeyup="checkPss()"><br>
                <span id="glyphiconIcon"class="glyphicon form-control-feedback" hidden="true">
            </div>
            <input type="hidden" name="acao" value="mudar"/>  
            <div style="text-align: center">
                <button type="submit" class="btn btn-success">Alterar senha</button>
            </div>
        </div>
        </fieldset>   
    </form>
<?php
    include('config.php');

    if(isset($_GET['codigo']))
    {
        $codigo = $_GET['codigo'];
        $email_codigo = base64_decode($codigo);

        $selecionar = mysqli_query($con,"SELECT * FROM `recupera_senha` WHERE codigo = '$codigo' AND data > NOW()");
        

        if(mysqli_num_rows($selecionar) >= 1)
        {
            $row = mysqli_fetch_assoc($selecionar);
            
            if(isset($_POST['acao']) && $_POST['acao'] == 'mudar')
            {
                $nova_senha = $_POST['novasenha'];
                $nova_senha2 = $_POST['novasenha2'];
                $nova_senha = hash('sha256',$nova_senha);
                $nova_senha2= hash('sha256',$nova_senha2);
              if($nova_senha == $nova_senha2)  
              {    

                if($row['tabela'] == "alunos")
                {
                     $atualizar = mysqli_query($con,"UPDATE `alunos` SET `senha` = '$nova_senha' WHERE `email` = '$email_codigo'"); 
                        if($atualizar)
                        {
                            $mudar = mysqli_query($con,"DELETE FROM `recupera_senha` WHERE codigo = '$codigo'");
                            echo"<script>alert('Senha alterada com sucesso!');</script>";
                            echo"<script>index()</script>";
             
                        }                  
                }  
                elseif($row['tabela'] == "secretaria")  
                {
                    $atualizar = mysqli_query($con,"UPDATE `secretaria` SET `senha` = '$nova_senha' WHERE `email` = '$email_codigo'"); 
                        if($atualizar)
                        {
                            $mudar = mysqli_query($con,"DELETE FROM `recupera_senha` WHERE codigo = '$codigo'");
                            echo"<script>alert('Senha alterada com sucesso!');</script>";
                            echo"<script>index()</script>";
             
                        }                  
                }
                
                elseif($row['tabela'] == "professor")
                {
                     $atualizar = mysqli_query($con,"UPDATE `professor` SET `senha` = '$nova_senha' WHERE `email` = '$email_codigo'"); 
                        if($atualizar)
                        {
                            $mudar = mysqli_query($con,"DELETE FROM `recupera_senha` WHERE codigo = '$codigo'");
                            echo"<script>alert('Senha alterada com sucesso!');</script>";
                            echo"<script>index()</script>";
             
                        }  
                }
              }
              
            else
            {
                  echo"<script>alert('As senhas não conferem!');</script>";
                    echo"<script>recupera()</script>";
            }

        }
            
        }
        else
        {
            echo"<script>alert('Link expirado!');</script>";
            echo"<script>index()</script>";
        }
    }
?>


</body>





</html>