<?php
$db=new Mypdo();
$managerMeth=new MethodeManager($db);

if(!empty($_POST['commentaire'])){
?>

<form method="post" action="#">
<fieldset>
  <legend>Commentaire</legend>
  <p><label for="commentaire" >Commentaire : </label><textarea  id="commentaire" name="commentaire" rows="8" cols="40"></textarea></p>
  <input type="submit" value="Valider" id="Valider"/>
</fieldset>
</form>

<?php
} else {

}
?>
