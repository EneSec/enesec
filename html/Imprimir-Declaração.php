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
// now write some text above the imported page
$pdf->SetFont('Arial','',8);
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

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("Declaracao_Aluno_Regular", "I");

?>
