<?php
$bd = new Mypdo();
$managerPers = new PersonneManager($bd);
?>

<h1>Paramètres perso</h1>

<?php
if(empty($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['log'])){
  if(empty($_POST['ancienPwd']) && empty($_POST['NouveauPwd']) && empty($_POST['NouveauPwd2'])){
?>

<div>
  <form method="post" action="#">
  <fieldset id="changePwd">
    <legend>Changement d'identité</legend>
    <p><label for="nom" >Nom : </label><input type="text" id="nom" name="nom" /></p>
    <p><label for="prenom" >Prénom : </label><input type="text" id="prenom" name="prenom" /></p>
    <p><label for="mail">Mail : </label><input type="text" id="mail" name="mail" /></p>
    <input type="submit" value="Valider" />
  </fieldset></form>
</div>

<?php
  }
} else {
  $managerPers->updatePersonneNPM($_POST['nom'],$_POST['prenom'],$_POST['mail']);
  header('Refresh : 0 , URL = index.php?page=20');
}
?>

<br/>

<?php
if(empty($_POST['ancienPwd']) && empty($_POST['NouveauPwd']) && empty($_POST['NouveauPwd2'])){
  if(empty($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['log'])){
?>

<div>
  <form method="post" action="#">
  <fieldset id="changePwd">
    <legend>Changement de mot de passe</legend>
    <p><label for="ancienPwd" >Ancien mot de passe : </label><input type="password" id="ancienPwd" name="ancienPwd" /></p>
    <p><label for="nouveauPwd" >Nouveau mot de passe : </label><input type="password" id="nouveauPwd" name="nouveauPwd" /></p>
    <p><label for="nouveauPwd2" >Confirmation mot de passe : </label><input type="password" id="nouveauPwd2" name="nouveauPwd2" /></p>
    <input type="submit" value="Valider" />
  </fieldset></form>
</div>

<?php
  }
} else {
  if($managerPers->verifPwd(md5(md5($_POST["ancienPwd"]).'XOURR\'LINE'), $_SESSION["log"])->nbreLigne == 1){
    if($_POST['nouveauPwd'] == $_POST['nouveauPwd2']){
      $managerPers->updatePersonnePwd(md5(md5($_POST['nouveauPwd']).'XOURR\'LINE'),$_SESSION['num']);
      header('Refresh : 0 , URL = index.php?page=20');
    } else {
      echo 'Les nouveaux mot de passe ne sont pas les mêmes.';
      header('Refresh : 1 , URL = index.php?page=20');
    }
  } else {
    echo 'L\'ancien mot de passe ne correspond pas.';
    header('Refresh : 1.5 , URL = index.php?page=20');
  }
}
?>
