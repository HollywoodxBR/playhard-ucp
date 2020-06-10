<html>
<title>User Control Panel</title>
<body align = "center">
<font face = "Verdana">
<?php
include('config.php');
session_start();
if(isset($_SESSION['username']))
{
	$username = mysql_real_escape_string($_SESSION['username']);
	$query = mysql_query("SELECT * FROM player_info WHERE name = '$username'") or die(mysql_error());
	
	while($perfil = mysql_fetch_assoc($query))
	{
		$skin = $perfil['skin'];
		$matou = $perfil['kills'];
		$morreu = $perfil['kills'];
		$score  = $perfil['score'];
		$dinheiro = $perfil['money'];
		
		$html = 
		"<table border = '1' cellspacing = '0' align = 'center'>
			<tr><td>$username</td></tr>
			<tr><td>Matou: $matou</td></tr>
			<tr><td>Morreu: $morreu</td></tr>
			<tr><td>Nível: $score</td></tr>
			<tr><td>Dinheiro: $dinheiro</td></tr>
			<tr><td><img src = 'http://weedarr.wikidot.com/local--files/skinlistc/$skin.png'></img></td></tr>
		</table>";
		echo $html;
	}
}
else header('location: login.php');
?>
<br>
<br>
<br>
<a href = 'mudarskin.php'>Trocar skin</a><br>
<a href = 'logout.php'>Logout</a>
</font>
</body>
</html>