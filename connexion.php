<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['formconnexion']))
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		$requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['pseudo'] = $userinfo['pseudo'];
			$_SESSION['mail'] = $userinfo['mail']; 
			header("Location: profil.php?id".$_SESSION['id']);
		}
		else
		{
			$erreur = "Mauvais mail ou mauvais mot de passe. Veuillez réesayer";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent être complétés !";
	}


}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<h3>Connexion</h3>
		<br /><br />
		<form method="POST" action="">
			<input type="email" name="mailconnect" placeholder="Mail" />
			<input type="password" name="mdpconnect" placeholder="Mot de passe" />
			<input type="submit" name="formconnexion" placeholder="Se connecter" />  
		</form>
		<?php
		if(isset($erreur))
		{
			echo '<font color="red">'.$erreur."</font>";
		}
		?>
	</div> 

</body>
</html>