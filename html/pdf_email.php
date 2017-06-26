<?php
	SESSION_START();
	include('config.php');
	if($_SESSION['Permissao'] != "secretaria")
	{
		include('logout.php');
	}


require_once(__DIR__ ."/FPDI/fpdf.php");
require_once(__DIR__ ."/FPDI/fpdi.php");

$servername = "localhost";
$username = "root";
$password = "cgdl17PT01.@";
$dbname = "enesecof";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'];
$id = $_GET['id'];

$sql = "SELECT * FROM alunos WHERE email='$email' ";
$aluno = $conn->query($sql);
$aluno = $aluno->fetch_assoc();


// initiate FPDI
$pdf = new FPDI();
// add a page
$pdf->AddPage();
// set the sourcefile
$pdf->setSourceFile('aluno_regular.pdf');
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, 0, 0, 210);

$nome = $aluno["nome"] ." " . $aluno["sobrenome"];
$matricula = $aluno["matricula"];
$curso = $aluno["curso"];
$habilitacao =  $aluno["curso"];
$grau =  $aluno["grau"];
$identidade =  $aluno["identidade"];
$turno =  $aluno["turno"];
$ingresso =  $aluno["ingresso"];
$nivel =  $aluno["nivel"];
$email = $aluno["email"];


//Mudar codificação para o PDF
$nome = iconv('UTF-8', 'windows-1252', $nome);
$matricula = iconv('UTF-8', 'windows-1252', $matricula);
$curso = iconv('UTF-8', 'windows-1252', $curso);
$habilitacao =  iconv('UTF-8', 'windows-1252', $habilitacao);
$grau =  iconv('UTF-8', 'windows-1252', $grau);
$identidade =  iconv('UTF-8', 'windows-1252', $identidade);
$turno =  iconv('UTF-8', 'windows-1252', $turno);
$ingresso =  iconv('UTF-8', 'windows-1252', $ingresso);
$nivel =  iconv('UTF-8', 'windows-1252', $nivel);
$email = iconv('UTF-8', 'windows-1252', $email);

$conn->close();

$pdf->SetFont('Arial','',10);
$pdf->SetXY(37, 47.9);
$pdf->Write(26, $nome);
$pdf->SetXY(42, 52.6);
$pdf->Write(26, $matricula);
$pdf->SetXY(37, 57.3);
$pdf->Write(26, $curso);
$pdf->SetXY(46, 62);
$pdf->Write(26, $habilitacao);
$pdf->SetXY(35, 66.8);
$pdf->Write(26, $grau);
$pdf->SetXY(132, 47.9);
$pdf->Write(26, $identidade);
$pdf->SetXY(132, 52.6);
$pdf->Write(26, $turno);
$pdf->SetXY(132, 57.3);
$pdf->Write(26, $ingresso);
$pdf->SetXY(132, 62);
$pdf->Write(26, $nivel);

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$pdf->SetXY(63, 90.7);
$pdf->Write(26, strftime('%A, %d de %B de %Y.', strtotime('today')));
$pdf->SetXY(94, 210);
$pdf->SetFont('Arial', '', 14);
$pdf->Write(26, date("d/m/y"));

$pdf->Image('unb.png', 33, 210, -600);
$pdf->Image('unb.png', 148, 210, -600);
//$pdf->Output(D,'result.pdf');

//Voltar codificação para o email
$nome = $aluno["nome"] ." " . $aluno["sobrenome"];
$matricula = $aluno["matricula"];
$curso = $aluno["curso"];
$habilitacao =  $aluno["curso"];
$grau =  $aluno["grau"];
$identidade =  $aluno["identidade"];
$turno =  $aluno["turno"];
$ingresso =  $aluno["ingresso"];
$nivel =  $aluno["nivel"];
$email = $aluno["email"];


// email stuff (change data below)
$to = $email;
$subject = "EneSec - Declaração de aluno regular";
$message = '
<!DOCTYPE html PUBLIC>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>EneSec Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body style="margin: 0; padding: 0;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc;">


      <tr>
        <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0;">
          <a href="https://
		  .redes.unb.br/enesec/"><img src="https://homol.redes.unb.br/enesec/img/logo.png" alt="EneSec logo" width="242" height="76" style="display: block;" />
        </td>
      </tr>



      <tr>
        <td bgcolor="#003366" style="padding: 40px 30px 40px 30px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">

            <tr>
              <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 24px;">
                <b>Olá, ' . $nome . '!</b>
                <br><br>
              </td>
            </tr>

            <tr>
              <td align="justify" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                Você solicitou uma declaração de aluno regular em seu nome para a secretaria do Departamento de Engenharia Elétrica da UnB. Ela encontra-se em anexo.
                <br><br>

                Qualquer problema, basta entrar em contato através de nossos telefones ou pessoalmente.
                <br><br>
                
                Atenciosamente,<br>
                Equipe da EneSec e Secretaria do Departamento de Engenharia Elétrica
              </td>
            </tr>

          </table>
        </td>
      </tr>



      <tr>
        <td bgcolor="#006633" style="padding: 30px 30px 30px 30px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">

            <tr>
              <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                &reg; EneSec, 2017<br/>
                
                Você está recebendo esse e-mail porque está cadastrado em nosso site. Caso deseje parar de receber nossos e-mails, é necessário que delete sua conta <a href="https://homol.redes.unb.br/enesec/" style="color: #ffffff;"><font color="#ffffff">clicando aqui</font></a>.
              </td>

              <td align="right">
                <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
                      <a href="http://www.twitter.com/">
                        <img src="https://homol.redes.unb.br/enesec/img/twitter.jpg" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                      </a>
                    </td>
                    <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                      <td>
                        <a href="http://www.facebook.com/">
                          <img src="https://homol.redes.unb.br/enesec/img/facebook.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                      </a>
                    </td>
                  </tr>
                </table>
              </td>
            
          </table>
        </td>
      </tr>

    </table>
  </body>

</html>
';

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "Declaração de aluno regular.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

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

////// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
$mail_sent = mail($to, $subject, $body, $headers);



if ($mail_sent) {
	//exclui da tabela
	$query = mysqli_query($con, "DELETE FROM `documentos` id email='$id'");

	echo "<script>";
	echo "alert('Email enviado com sucesso');";
	echo "window.location.href='aprovar-documentos.php';";
	echo "</script>";
}

else {
	echo "<script>";
	echo "alert('Erro ao enviar o email!');";
	echo "window.location.href='aprovar-documentos.php';";
	echo "</script>";
}

?>

