<?php
$bd = new Mypdo();
$manager = new PersonneManager($bd);

if (!empty($_GET["num"])){
  $log = $manager->getLoginPersonne($_GET["num"])->per_login;
  $nom = $manager->getNomPersonne($log)->per_nom;
  $prenom = $manager->getPrenomPersonne($log)->per_prenom;
  $decrypt = Chiffrement::decrypt($manager->getPwdPersonne($log)->per_pwd);

  echo '<h1>Info sur l\'élève '.$prenom.' '.$nom.'</h1>';
?>

<table align="center">
<tr>
  <th>nom</th><th>Pr&eacutenom</th><th>Mot de passe</th>
</tr>
<tr>
  <?php echo '<td>'.$nom.'</td><td>'.$prenom.'</td><td>'.$decrypt.'</td>'; ?>
</tr>
</table>
<br/><br/><a href="?page=6" ><b>Retour</b></a><br/><br/>

<?php
}
?>
