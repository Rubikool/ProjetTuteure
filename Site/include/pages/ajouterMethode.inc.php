<?php
$bd = new Mypdo();
$managerMeth = new MethodeManager($bd);
?>

<h1>Ajouter une méthode</h1>

<?php
if (empty($_POST)){
?>

<form method="post" action="#">
<fieldset>
  <legend>Nouvelle m&eacutethode</legend>

  <p><label for="taille" id="taille">Taille :</label>
    <select name="taille" id="taille"></p><br />
        <?php for($i=2;$i<=7;$i++){

          echo '<option value=' .$i.'>'.$i.'x'.$i.'x'.$i. ' </option>'; }?>
        </select>

  <p><label for="nom" >Nom : </label><input type="text" id="nom" name="nom" /></p>
  <p><label for="description" >Description : </label><textarea id="description" name="Description" rows="8" cols="40"></textarea></p>


  <input type="submit" value="Valider" id="Valider"/>
</fieldset></form>

<?php
}
?>
