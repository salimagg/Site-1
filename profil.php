<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
	$getid = intval($_GET['id']);
	$requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();


?>
<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<h3>Profil de <?php echo $userinfo['pseudo'] ?></h3>
		<br /><br />
		Pseudo = <?php echo $userinfo['pseudo'] ?>
		<br />
		Mail = <?php echo $userinfo['mail'] ?>
		<form method="POST" action="">
			<input type="email" name="mailconnect" placeholder="Mail" />
			<input type="password" name="mdpconnect" placeholder="Mot de passe" />
			<input type="submit" name="formconnexion" placeholder="Se connecter" />  
		</form>
		<?php
		if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSIONS['id'])
		{
		?>
		<a href="#"> Editier mon profil</a>
		<a href="deconnxion.php"> Se déconnecter</a>
		<?php	
		}
		?>
	</div> 

</body>
</html>
<?php
}

?>