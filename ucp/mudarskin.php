<html>
<title>User Control Panel</title>
<body align = "center">
<font face = "Verdana">
<?php
include('config.php');
session_start();
if(isset($_SESSION['username']))
{
	if(isset($_POST['confirmar']))
	{
		if(IsValidSkin($_POST['novaskin']))
		{
			$nome = mysql_real_escape_string($_SESSION['username']);
			$query = mysql_query("SELECT * FROM player_info WHERE name = '$nome'", $conectar) or die(mysql_error());
			
			$dado = mysql_fetch_assoc($query);
			$skinAtual = $dado['skin'];
			$skinNova  = $_POST['novaskin'];
		
			if($skinAtual != $skinNova)
			{
				mysql_query("UPDATE player_info SET skin = '$skinNova' WHERE name = '$nome'", $conectar) or die(mysql_error());
				header('location: perfil.php');
			}
			else echo "Erro: Nova skin igual à atual.<br>";
		}
		else echo "Erro: Skin inválida.<br>";
	}
	else if(isset($_POST['cancelar']))
	{
		header('location: perfil.php');
	}
	$form = 
	"<form method = 'post' action = ''>
		Nova Skin:<br><input type = 'text' name = 'novaskin'><br>
		<input type = 'submit' name = 'confirmar' value = 'Alterar'><br>
		<input type = 'submit' name = 'cancelar' value = 'Cancelar'>
	</form>";
	echo $form;
}
else header('location: login.php');

function IsValidSkin($s)
{
	return $s >= 0 && $s <= 299;
}
?>
</font>
</body>
</html>