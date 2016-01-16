<?php
$db = new Mypdo();
$managerMeth = new MethodeManager($db);
$managerChap = new ChapitreManager($db);
$managerPiJo=new PieceJointeManager($db);
$managerLien=new LienManager($db);
$managerPart=new PartitionManager($db);
$managerListePartition=new ListePartitionManager($db);
$managerCont=new ContientManager($db);

$numMethode=$managerMeth->getNumMethodeParNom($_GET['nomMethode']);


$listChapitreParMethode=$managerChap->getAllChapitreParMethode($numMethode);

$managerLien->deleteLien($numMethode);
$managerPiJo->deletePiJo($numMethode);

foreach($listChapitreParMethode as $Chapitre){

  $numChapitre=$Chapitre->getCha_num();



  $listePartitionParChapitre=$managerCont->getAllPartitionParChapitre($numChapitre);

  foreach($listePartitionParChapitre as $Partition){
    $numPartition=$Partition->getPar_num();

    $managerListePartition->deleteListePartition($numPartition);

    $managerCont->deleteContient($numMethode);

    $managerPart->deletePartition($numPartition);
  }



  $managerChap->deleteChapitre($numChapitre);
}

$managerMeth->deleteMethode($numMethode);

echo '<br/><img src="image/valid.png" /> La méthode a bien été supprimée !';
header("Refresh: 2 ; URL = index.php?page=12");
?>
