<?php

	SESSION_START();
	include('config.php');
	include('mensagem_email.php');
	if($_SESSION['Permissao'] != "secretaria")
	{
		include('logout.php');
	}

	$target_dir = "/var/www/uploads/";
	$target_file = $target_dir . basename($_FILES["pdf_enviado"]["name"]);
	$tipo_do_arquivo = pathinfo($target_file, PATHINFO_EXTENSION);
	$id=isset($_SESSION["idDoc"])?$_SESSION["idDoc"]:"";
	// Verificando se o arquivo é .pdf:
	if($tipo_do_arquivo != "pdf" ) {
		echo "<script type='text/javascript'>";
	    echo "alert('O arquivo não possui extensão .pdf. Por favor, faça o upload de um arquivo PDF.')";
	    echo "</script>";
		echo "<script type='text/javascript'>";
		echo "window.location.replace('upload.html?id=$id')";
		echo "</script>";
	}

// Check file size
else if ($_FILES["pdf_enviado"]["size"] > 2000000) {
	echo "<script type='text/javascript'>";
	echo "alert('O tamanho do arquivo carregado é grande demais. Por favor, faça o upload de um arquivo menor.')";
	echo "</script>";
	echo "<script type='text/javascript'>";
	echo "window.location.replace('upload.html?id=$id')";
	echo "</script>";
}
	
	else {
            $target_file = $target_dir . "arquivo_carregado.pdf";

	    if (move_uploaded_file($_FILES["pdf_enviado"]["tmp_name"], $target_file)) {
	    	// email stuff (change data below)
			$to = $_SESSION["DocEmail"];
			$nome = $_SESSION["DocNome"];
$subject = "EneSec - Histórico Escolar";
$texto = 'Você solicitou uma declaração de aluno regular em seu nome para a secretaria do Departamento de Engenharia Elétrica da UnB. Ela encontra-se em anexo.';
$objeto_mensagem = new mensagem;		
$message = $objeto_mensagem->get_mensagem($nome,$texto);

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = $_SESSION["Doc"] .".pdf";

// encode data (puts attachment in proper format)
$file = fopen($target_file,'rb');
$pdfdoc = fread($file,filesize($target_file));
fclose($file);
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: EneSec <ptr012017a@redes.unb.br>".$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;

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
			if( !(mail($to, $subject, $body, $headers) ) ) {
				echo "<script type='text/javascript'>";
				echo "alert('Ops, houve um erro no envio do arquivo por email.')";
				echo "</script>";
				unlink('/var/www/uploads/arquivo_carregado.pdf');
			}

			else {
	            $query = mysqli_query($con, "DELETE FROM `documentos` WHERE id = '$id'");
	            echo "<script type='text/javascript'>";
	            echo "alert('O arquivo " . basename( $_FILES["pdf_enviado"]["name"]). " foi enviado com sucesso para " . $to . " .')";
	            echo "</script>";
	            echo "<script type='text/javascript'>";
	            echo "window.location.replace('aprovar-documentos.php')";
	            echo "</script>";
			unlink('/var/www/uploads/arquivo_carregado.pdf');
			}
	        
	    }

	    else {
	    	echo "<script type='text/javascript'>";
	        echo "alert('Ops, houve um erro no carregamento do arquivo.')";
	        echo "</script>";
			echo "<script type='text/javascript'>";
			echo "window.location.replace('upload.html?id=$id')";
			echo "</script>";
	    }
	}
?>

