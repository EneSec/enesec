<html>
  
  <head>
    <title>Recuperar senha</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type='text/javascript'>

        function index()
        {
            setTimeout("window.location='index.html'",0001);
        }
        

    </script>
  </head>
 
  <body>
<?php
    include('config.php');
	include('mensagem_email.php');
    date_default_timezone_set("America/Sao_Paulo");
 
     if(isset($_POST['acao'])  &&  $_POST['acao'] == 'recuperar')
     {   
            $email = strip_tags(filter_input(INPUT_POST, 'emailrecupera' , FILTER_SANITIZE_STRING));
            $verificar = mysqli_query($con,"SELECT `email` FROM `alunos` WHERE email = '$email'");
            $verificar2 = mysqli_query($con,"SELECT `email` FROM `secretaria` WHERE email = '$email'");
            $verificar3 = mysqli_query($con,"SELECT `email` FROM `professores` WHERE email = '$email'");
            $codigo = base64_encode($email);
            $verificar4=mysqli_query($con,"SELECT `codigo` FROM `recupera_senha` WHERE codigo = '$codigo'");
			$texto = 'Recebemos uma solicitação de mudança de senha vinculada a este email. Caso não tenho solicitado nenhuma mudança, por favor, ignore está mensagem. Clique no link abaixo para a mudança de senha<br>
                                <a href= https://homol.redes.unb.br/enesec/recuperarsenha2.php?codigo='.$codigo.'>Recuperar Senha</a>';
			$objeto_mensagem = new mensagem;					
            if(mysqli_num_rows($verificar4) ==0)
            {
                 if(mysqli_num_rows($verificar) == 1)
				{
                $codigo = base64_encode($email);
                $data_expirar = date('Y-m-d H:i:s', strtotime('+1 day'));
                $tabela = "alunos";
				$message = $objeto_mensagem->mensagem_deletar_recuperar($texto);				

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// main header
$headers  = "From: EneSec <ptr012017a@redes.unb.br>".$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed;boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
//$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;
				
				
                $email_remetente = 'ptr012017a@redes.unb.br';
                $assunto = 'Recuperaçao de senha';
                $inserir =  mysqli_query($con,"INSERT INTO `recupera_senha`(`codigo`, `data`, `tabela`) VALUES('$codigo', '$data_expirar', '$tabela')");
                    
                    if($inserir)
                    {
                      if(mail($email,$assunto,$body, $headers))
                     {
                        echo"<script>alert('Enviamos um e-mail para a recuperação de senha, para o endereço indicado!');</script>";
                        echo"<script>index()</script>";
                            
                     }
                    }
                 }   
                else if(mysqli_num_rows($verificar2) == 1)
                {
                    $codigo = base64_encode($email);
                    $data_expirar = date('Y-m-d H:i:s', strtotime('+1 day'));
                    $tabela = "secretaria";
					$message = $objeto_mensagem->mensagem_deletar_recuperar($texto);				

// a random hash will be necessary to send mixed content
$separator = md5(time());
// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// main header
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
//$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;
                     
                    $email_remetente = 'ptr012017a@redes.unb.br';
                    $assunto = 'Recuperaçao de senha';
     
                    $inserir =mysqli_query($con,"INSERT INTO `recupera_senha`(`codigo`, `data`, `tabela`) VALUES('$codigo', '$data_expirar', '$tabela')");
                    if($inserir)
                    {
     
                       if(mail($email,$assunto,$body, $headers))
                       {
                            echo"<script>alert('Enviamos um e-mail para a recuperação de senha, para o endereço indicado!');</script>";
                            echo"<script>index()</script>";
                        }
                   }
                }
                else if(mysqli_num_rows($verificar3) == 1)
                {
                    $codigo = base64_encode($email);
                    $data_expirar = date('Y-m-d H:i:s', strtotime('+1 day'));
                    $tabela = "professores";
					$message = $objeto_mensagem->mensagem_deletar_recuperar($texto);				

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// main header
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
//$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;
					
					
                    $email_remetente = 'ptr012017a@redes.unb.br';
                    $assunto = 'Recuperaçao de senha';
                    
                    $inserir =  mysqli_query($con,"INSERT INTO `recupera_senha`(`codigo`, `data`, `tabela`) VALUES('$codigo', '$data_expirar', '$tabela')");

                    if($inserir)
                    {
     
                        if(mail($email,$assunto,$body, $headers))
                        {
                            echo"<script>alert('Enviamos um e-mail para a recuperação de senha, para o endereço indicado!');</script>";
                            echo"<script>index()</script>";
                        }
                    }
                }
                else
                {
                            echo"<script>alert('Email não encontrado!');</script>";
                            echo"<script>index()</script>";
                }  
            }
            else
            {
            echo"<script>alert('Requisição negada. Um email de recuperação de senha já foi enviado nas últimas 24hrs.');</script>";
            echo"<script>index()</script>";
            }

    }
?>
 
</body>
 
</html>



