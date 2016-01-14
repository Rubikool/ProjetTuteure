
<?php

$db=new MyPdo();
$managerMouv=new MouvementManager($db);

if(empty($_POST['partition'])){ ?>
  <form method="post" action="#">
  <label for="titrepartition">Titre de la partition : </label><input type="text" id="titrepartition"/>
  <br /><br />
  <table class="listeof">
   <tr class="listof">
     <th class="listof">Liste des mouvements disponible</th>
   </tr>
   <tr>
      <td>
   <?php
   $listeMouvementParTaille=$managerMouv->getAllMouvementParTaille($_SESSION['TailleCubeSelect']);

   foreach($listeMouvementParTaille as $Mouvement){
     $mouv=$Mouvement->getMouvement();
     $mouv_id=$Mouvement->getMvm_num();

     ?>

   <img id="<?php echo $mouv_id;?>" onClick="AjouterPartition(<?php echo '\''.$mouv_id.'\'';?>)" src="<?php echo $mouv;?>" />

   <?php
     }

  ?>
    </td>
    </tr>
   </table>

   <table class="listof">
     <tr class="listof">
        <th class="listof">Partition</th>
      </tr>
      <tr>
        <td class="listof" ><div id="PartitionJS"></div></td>
      </tr>
  </table>
  <?php echo 'id='.$mouv_id; ?>
  <input type="submit" name="submit" value="Envoyer" />

  <a href="index.php?page=11" id="lien">Revenir sur l'écran des méthodes</a>
  </form>

<?php
}else{

}

?>
