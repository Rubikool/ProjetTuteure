<?php
$db=new Mypdo();
$managerMeth=new MethodeManager($db);


if(!isset($_SESSION['nomMethode'])){
if(isset($_GET['nomMethode'])){
    $_SESSION['nomMethode']=$_GET['nomMethode'];
  }
}
$_SESSION['numMethode']=$managerMeth->getNumMethodeParNom($_SESSION['nomMethode']);

if(empty($_POST['commentaire'])){
?>

<form method="post" action="#">
<fieldset>
  <legend>Commentaire pour la méthode : <?php echo $_SESSION['nomMethode']; ?></legend>
  <p><label for="commentaire" >Commentaire : </label><textarea  id="commentaire" name="commentaire" rows="8" cols="40"></textarea></p>
  <input type="submit" value="Valider" id="Valider"/>
</fieldset>
</form>

<?php
} else {
  $commentaire=addslashes($_POST['commentaire']);
  $managerMeth->updateCommentaireMethode($_SESSION['numMethode'],$commentaire);
  echo "Commentaire ajoutée";
  header('Refresh : 1 ; URL = index.php?page=12');
}
?>
