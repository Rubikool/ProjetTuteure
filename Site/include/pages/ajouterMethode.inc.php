<?php
$bd = new Mypdo();
$managerPer = new MethodeManager($bd);
?>

<h1>Ajouter une méthode</h1>

<?php
if (empty($_POST)){
?>

<form method="post" action="#">
<fieldset>
  <legend>Ajout d'une méthode</legend>
  <p>bouton !!</p>
  <p><label for="nom" >Nom : </label><input type="text" id="nom" name="nom" /></p>
  <p><label for="log" >Login : </label><input type="text" id="log" name="log" /></p>
  <p><label for="pwd" >Mot de passe : </label><input type="password" id="pwd" name="pwd" /></p>
  <p><label for="pwd2" >Confirmation : </label><input type="password" id="pwd2" name="pwd2" /></p>
  <p>Type :
    <label for="admin" >Administrateur</label><input type="radio" id="admin" name="admin" value="1" />
    <label for="eleve" >Elève</label><input type="radio" id="eleve" name="admin" value="0" checked="" />
  </p>

  <input type="submit" value="Valider" />
</fieldset></form>

<?php
} else {
  echo 'bonjour';
}
?>
