<html>
  
  <head>
    <title>Enesec - Deletar conta</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type='text/javascript'>

        function index()
        {
            setTimeout("window.location='index.html'",0001);
        }
		function voltar()
        {
            setTimeout("window.location='deletar_conta.html'",0001);
        }
        
    </script>
  </head>


<?php 
	include('config.php');
	include('mensagem_email.php');
	$email = $_POST['email'];
	$codigo = base64_encode($email);
	$texto = 'Recebemos uma solicitação de exclusão de conta. Clique no link abaixo para deletar a conta vinculada a esse e-mail.<br>
                                <a href= https://homol.redes.unb.br/enesec/deletar_conta2.php?code='.$codigo.'>Deletar conta</a>';
	$objeto_mensagem = new mensagem;
	$message = $objeto_mensagem->mensagem_deletar_recuperar($texto);							
	

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// main header
$headers  = "From: EneSec <ptr012017a@redes.unb.br>".$eol;
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

				$codigo = base64_encode($email);
                $data_expirar = date('Y-m-d H:i:s', strtotime('+1 day'));				
				
                $email_remetente = 'ptr012017a@redes.unb.br';
                $assunto = 'Deletar conta';
				$inserir =  mysqli_query($con,"INSERT INTO `deletar_conta`(`codigo`, `data`) VALUES('$codigo', '$data_expirar')");
				
				if($inserir)
                {
                      if(mail($email,$assunto,$body, $headers))
                     {
                        echo"<script>alert('Enviamos um e-mail com um link para deletar sua conta.');</script>";
                        echo"<script>index()</script>";      
                     }
					 else{
						 echo"<script>alert('Erro ao enviar o e-mail. Por favor tente novamente.');</script>";
                         echo"<script>voltar()</script>"; 
					 }
                }
				else{
					echo"<script>alert('Ocorreu um erro. Por favor tente novamente.');</script>";
                    echo"<script>voltar()</script>"; 
				}
?>


