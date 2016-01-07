<?php
$bd = new Mypdo();
$manager = new PersonneManager($bd);
?>

<h1>Inscription</h1>

<?php
if (!empty($_POST["nom"])) {
  if (ctype_alpha($_POST["nom"])) {
    $nom=$_POST["nom"];
  } else {
    echo '<img class = "icone" src="image/erreur.png" alt="Erreur"/><b>Nom invalide</b> : il doit être de type alphabétique<br />';
  }
}

if (!empty($_POST["prenom"])) {
   if (ctype_alpha($_POST["prenom"])) {
     $prenom=$_POST["prenom"];
   } else {
     echo '<img class = "icone" src="image/erreur.png" alt="Erreur"/><b>Prenom invalide</b> : il doit être de type alphabétique<br />';
   }
}

if (empty($nom) OR empty($prenom)){
?>

<form method="post" action="#">
<fieldset>
  <legend>Inscription</legend>
  <p><label for="nom" >Nom : </label><input type="text" id="nom" name="nom" /></p>
  <p><label for="prenom" >Prénom : </label><input type="text" id="prenom" name="prenom" /></p>
  <p><label for="mail" >Mail : </label><input type="text" id="mail" name="mail" /></p>
  <p><label for="log" >Login : </label><input type="text" id="log" name="log" /></p>
  <p><label for="pwd" >Mot de passe : </label><input type="password" id="pwd" name="pwd" /></p>
  <p><label for="pwd2" >Confirmation : </label><input type="password" id="pwd2" name="pwd2" /></p>
  <input type="submit" value="Valider" />
</fieldset></form>

<?php
} else {

  $num = $manager->getNumMaxPersonne()->per_num + 1;

  $crypt = Chiffrement::crypt($_POST["pwd"]);

  $personne = new Personne(
    array('per_num' => $num,
          'per_nom' => $_POST["nom"],
          'per_prenom' => $_POST["prenom"],
          'per_mail' => $_POST["mail"],
          'per_admin' => "",
          'per_login' => $_POST["log"],
          'per_pwd' => $crypt,
    )
  );

  $manager->add($personne);

  echo '<img src="image/valid.png" /> L\'&eacuteleve a &eacutet&eacute ajout&eacute !';
  header("Refresh : 2 ; URL = index.php?page=6");
}
?>
