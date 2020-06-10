<html>
<title>User Control Panel</title>
<body align = "center">
<font face = "Verdana">
<?php
include('config.php');
session_start();
if(isset($_POST['login']))
{
	$nome = mysql_real_escape_string($_POST['nome']);
	
	$query = mysql_query("SELECT * FROM player_info WHERE name = '$nome'", $conectar) or die(mysql_error());
	$rows = mysql_num_rows($query);
	if($rows)
	{
		$senha = mysql_real_escape_string($_POST['senha']);
		$query = mysql_query("SELECT * FROM player_info WHERE name = '$nome' AND password = '$senha'", $conectar) or die(mysql_error());
		$rows = mysql_num_rows($query);
		if($rows)
		{
			$dados = mysql_fetch_assoc($query);
			$nome = $dados['name'];
			
			$_SESSION['username'] = $nome;
			header('location: perfil.php');
		}
		else echo "Erro: Senha incorreta.<br>";
	}
	else
	{
		echo "Não há nenhum usuário registrado com este nome.<br>";
		echo "Porém, você pode se registrar clicando <a href = 'registro.php'>aqui</a>.<br>";
	}
}
?>
<form method = "post" action = "">
	Nome:<br><input type = "text" name = "nome"><br>
	Senha:<br><input type = "password" name = "senha"><br><br>
	<input type = "submit" name = "login" value = "Login">
</form>
</font>
</body>
</html>