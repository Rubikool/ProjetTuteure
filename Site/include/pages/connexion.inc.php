<?php
$bd = new Mypdo();
$manager = new PersonneManager($bd);

if ($manager->verifNom($_POST["login"])->nbreLigne == 1){
  if ($manager->verifPwd($_POST["pwd"], $_POST["login"])->nbreLigne == 1){
    $_SESSION["connecte"] = 1;
    $prenom = $manager->getPersonne($_POST["login"])->per_prenom;
    $admin = $manager->getPersonne($_POST["login"])->per_admin;
    $nom = $manager->getPersonne($_POST["login"])->per_nom;
    $num = $manager->getPersonne($_POST['login'])->per_num;

    $_SESSION['num'] = $num;
    $_SESSION["prenom"] = $prenom;
    $_SESSION["admin"] = $admin;
    $_SESSION["nom"] = $nom;
    $_SESSION["log"] = $_POST["login"];
    header("Refresh : 0 ; URL = index.php");
  }} /*else {
    echo '<b>Erreur dans la connexion :</b><br/><br/>';
    echo 'Mauvais mot de passe !<br/>';
    echo '<br/>Redirection automatique dans 4 secondes.';
    header("Refresh: 4 ; URL = index.php?page=9");
  }
} else {
  echo '<b>Erreur dans la connexion :</b><br/><br/>';
  echo 'Utilisateur '.$_POST["nom"].' inconnu !<br/>';
  echo '<br/>Redirection automatique dans 4 secondes.';
  header("Refresh: 4 ; URL = index.php?page=9");
}*/
?>
