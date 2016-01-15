<?php
$bd = new Mypdo();
$manager = new PersonneManager($bd);
?>

<h1>Récupération de mot de passe</h1>

<?php
if(empty($_POST["mail"])){
?>

<form method="post" action="#">
<fieldset>
  <legend>Récupération mot de passe</legend>
  <p><label for="mail" >Mail : </label><input type="text" id="mail" name="mail" /></p>
  <input type="submit" value="Valider" />
</fieldset>
</form>

<?php
} else {
  $mail = $_POST["mail"]; // Déclaration de l'adresse de destination.
  if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
  {
  	$passage_ligne = "\r\n";
  }
  else
  {
  	$passage_ligne = "\n";
  }

  //=====Déclaration des messages au format texte et au format HTML.
  $message_txt = "Nouveau mot de passe pour le site Rubik'ool : ";
  //==========

  //=====Création de la boundary
  $mdp = rand();
  $boundary = "-----=".md5($mdp);
  //==========

  //=====Définition du sujet.
  $sujet = "Rubik'ool - Nouveau mot de passe";
  //=========

  //=====Création du header de l'e-mail.
  $header = "From: \"Antoine Pinard\"<antoine.pinard@laposte.net>".$passage_ligne;
  $header.= "Reply-to: \"Antoine Pinard\" <antoine.pinard@laposte.net>".$passage_ligne;
  $header.= "MIME-Version: 1.0".$passage_ligne;
  $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$mdp\"".$passage_ligne;
  //==========

  //=====Création du message.

  //=====Ajout du message au format texte.
  $message = $passage_ligne.$message_txt.$passage_ligne;
  //==========
  $message.= $passage_ligne."\"".$mdp."\"".$passage_ligne;
  //==========

  //=====Envoi de l'e-mail.
  echo 'To : '.$mail;
  echo '<br/><br/>Sujet : '.$sujet;
  echo '<br/><br/>Message : '.$message;
  echo '<br/><br/>Header : '.$header;
  //mail($mail,$sujet,$message,$header);
  //==========
}
?>
