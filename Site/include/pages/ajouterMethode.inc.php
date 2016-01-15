
<?php
$bd = new Mypdo();
$managerPer = new MethodeManager($bd);
$managerMeth = new MethodeManager($bd);
unset($_SESSION['nomMethode']);
unset($_SESSION['numMethode']);
?>

<h1>Ajouter une méthode</h1>
<?php if (empty($_POST['nomMethode'])&& empty($_POST['description'])){ ?>

<form method="post" action="#">
<fieldset>
  <legend>Nouvelle m&eacutethode</legend>

  <p><label for="TailleCubeSelect" id="taille" class="labelMethode">Taille :</label>
    <select name="TailleCubeSelect" id="taille"></p><br />
        <?php for($i=2;$i<=7;$i++){
          echo '<option value=' .$i.'>'.$i.'x'.$i.'x'.$i. ' </option>'; }?>
        </select>

  <p><label for="nomMethode" class="labelMethode">Nom de la méthode : </label><input type="text" id="nom" name="nomMethode" /></p>
  <p><label for="description" class="labelMethode">Description : </label><textarea  id="description" name="description" rows="8" cols="40"></textarea></p>


  <input type="submit" value="Valider" id="Valider"/>
</fieldset>
</form>


<?php
}else{
  $_SESSION['nomMethode']=$_POST['nomMethode'];
  $NbrMethode=$managerMeth->getNumMethodeMax()+1;
  $description=addslashes($_POST['description']);
  $date=date("Y-m-d");

  $methode=new Methode(
  array( 'met_num' => $NbrMethode,
         'per_num' => $_SESSION['num'],
         'met_date' => $date,
         'met_description' => $description,
         'cub_taille' => $_POST['TailleCubeSelect'],
         'met_valide' => 0,
         'met_nom' => $_SESSION['nomMethode'],
         'met_commentaire' => ""
  )
);
  $managerMeth->add($methode);
  header("refresh: 0, URL=index.php?page=11");
}
?>
