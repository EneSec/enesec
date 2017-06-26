<?php
SESSION_START();
include('config.php');
if($_SESSION['Permissao'] != "secretaria")
{
  include('logout.php');
}
$id= $_GET['id'];
$query = mysqli_query($con, "DELETE FROM `documentos` WHERE id = '$id'");
header("location:aprovar-documentos.php");
?>
