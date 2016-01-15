<?php
$bd = new Mypdo();
$manager = new PersonneManager($bd);

if ($manager->verifNom($_POST["login"])->nbreLigne == 1){

  if ($manager->verifPwd(md5(md5($_POST["pwd"]).'XOURR\'LINE'), $_POST["login"])->nbreLigne == 1){
    $_SESSION["connecte"] = 1;
    $prenom = $manager->getPrenomPersonne($_POST["login"])->per_prenom;
    $admin = $manager->getAdminPersonne($_POST["login"])->per_admin;
    $nom = $manager->getNomPersonne($_POST["login"])->per_nom;
    $num = $manager->getNumPersonne($_POST["login"])->per_num;
    $_SESSION["prenom"] = $prenom;
    $_SESSION['num'] = $num;
    $_SESSION["admin"] = $admin;
    $_SESSION["nom"] = $nom;
    $_SESSION["log"] = $_POST["login"];
    header("Refresh : 0 ; URL = index.php");


    } else {
    echo '<b>Erreur dans la connexion :</b><br/><br/>';
    echo 'Mauvais mot de passe !<br/>';
    echo '<br/>Redirection automatique dans 2 secondes.';
    header("Refresh: 2 ; URL = index.php?page=9");
    }

} else {
  echo '<b>Erreur dans la connexion :</b><br/><br/>';
  echo 'Utilisateur '.$_POST["nom"].' inconnu !<br/>';
  echo '<br/>Redirection automatique dans 2 secondes.';
  header("Refresh: 2 ; URL = index.php?page=9");
}

?>
