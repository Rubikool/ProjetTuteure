<?php session_start();

echo '<!doctype html>';
echo '<html lang="fr">';
echo '<head>';
echo '<meta charset="utf-8">';
?>

<title>RUBIK'OOL</title>

<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />


</head>
<body>
<div id="header">
  <div id="connect">

<?php
if(empty($_SESSION["connecte"])){
	echo '<form action="index.php?page=1" method="POST" >';
	echo 'Identifiant : <input type="text" name="login" />';
	echo '<br/>Mot de passe : <input type="password" name="pwd" />';
  echo '<br/><div><input type="submit" value="Connexion" class="boutonConnexion" /></div>';
  echo '<div><a href="index.php?page=3" ><input type="button" value="Inscription" class="boutonInscription" /></a></div>';
  echo '<br/><p><a href="index.php?page=9">mot de passe oublié</a></p>';
  echo '</form>';
} else {
  if ($_SESSION["connecte"] == 1){
    if ($_SESSION["admin"] == 0){
      echo '<b>Utilisateur : </b>';
      echo '<br/>'.$_SESSION["prenom"].' '.$_SESSION["nom"];
      echo '<br/><a href="?page=2" >D&eacuteconnexion</a>';
    } else {
      echo '<b>Administrateur : </b>';
      echo '<br/>'.$_SESSION["prenom"].' '.$_SESSION["nom"];
      echo '<br/><a href="?page=2" >D&eacuteconnexion</a>';
    }
  }
}
?>

	</div>
	<div id="entete">
		<div id="logo"><a href="index.php?page=0" ><img src="./image/logo.png" id="imgLogo" /></a></div>
    <div id="titre"><a href="index.php?page=0" >RUBIK'OOL</a></div>
	</div>
</div>
