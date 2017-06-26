<html>
<head>
</head>

<body>
<?php
function selecionarUsuario($tabela, $email){
    include "config.php";//inicia o banco de dados

	$sql = "SELECT * FROM `$tabela` WHERE email = '$email' "; //cria query de seleção por e-mail
	$result = $con->query($sql); //executa a query sql

	//$dbcon->close();//encerra a conexão ao banco de dados
	if ($result->num_rows > 0){//verifica se possui linhas retornadas pela query
	    while($usuarioObjeto = $result->fetch_assoc()){// cria um objeto de tipo usuario a partir da linha selecionada no banco de dados
	        return $usuarioObjeto; //retorna usuário selecionado.
	    }
	}
	else{//se não não retornou linha pela query
		return null; //retorna null se não encontrar usuario no sistema
	}
}

?>

<?php

//seleção de determinada requisição, dependendo da tabela, se é de professores ou alunos.
$tabela    = $_POST['Tipo'];/*colocar o nome do que está no name do radio button do .html */
$emailUsuario = $_POST['email']; /*colocar o nome do que está no name do inputEmail do .html */

$usuario = selecionarUsuario($tabela, $emailUsuario);//executa a função criada acima.

session_start();

if($usuario != null){
	 $_SESSION['usuario_selecionado'] = serialize($usuario);// cria uma sessão por onde será passado o usuário selecionado. Na próxima página deverar o código para selecionar essa sessão e unserializa-la.
	 echo "<script type='text/javascript'>location.href='secretaria-editar.php?tb=$tabela';</script>";/* colocar página que será redirecionada*/
}else{
	echo "<script type='text/javascript'> alert('E-mail não encotnrado no sistema. Tente novamente.');
history.back(); </script>";
}
?>
</body>
</html>
