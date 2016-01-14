<?php session_start();
echo '<!doctype html>';
echo '<html lang="fr">';
echo '<head>';
echo '<meta charset="utf-8">';
?>

<title>RUBIK'OOL</title>

<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<script type="text/javascript" src="./js/scriptCours.js"></script>



</head>
<body>
<div id="header">
  <div id="connect">

<?php
if(empty($_SESSION["connecte"])){?>
	<form action="index.php?page=1" method="POST" >
		<label for="login" id="labelConnect">Identifiant : </label><input type="text" id ="login" name="login" />
		<label for="pwd" id="labelConnect">Mot de passe : </label><input type="password" id="pwd" name="pwd" />
		<br/><div><input type="submit" value="Connexion" class="boutonConnexion" /></div>
		<div><a href="index.php?page=3" ><input type="button" value="Inscription" class="boutonInscription" /></a></div>
	</form>
	</div>
	<p><a id="mdp" href="index.php?page=9">mot de passe oublié ?</a></p>
<?php
} else {
  if ($_SESSION["connecte"] == 1){
    if ($_SESSION["admin"] == 0){?>
		<b>Utilisateur : </b>
<?php
		echo '<br/>'.$_SESSION["prenom"].' '.$_SESSION["nom"];?>
		<br/><a href="?page=2" class="boutonConnexion" class="deconnexion">Deconnexion</a>
	</div>
<?php
    } else {?>
		<b>Administrateur : </b>
<?php
		echo '<br/>'.$_SESSION["prenom"].' '.$_SESSION["nom"];?>
		<br/><a href="?page=2" class="boutonConnexion" class="deconnexion">Deconnexion</a>
	</div>
<?php
	}
  }
}
?>
	<div id="entete">
		<div id="logo"><a href="index.php?page=0" ><img src="./image/logo/logo.png" id="imgLogo" /></a></div>
    <div><a id="titre" href="index.php?page=0" >RUBIK'OOL</a></div>
	</div>
</div>
