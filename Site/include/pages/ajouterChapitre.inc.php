<?php
$db=new Mypdo();
$managerMeth=new MethodeManager($db);
$managerChap=new ChapitreManager($db);
if(!isset($_SESSION['nomMethode'])){
if(isset($_GET['nomMethode'])){
    $_SESSION['nomMethode']=$_GET['nomMethode'];
  }
}
$_SESSION['numMethode']=$managerMeth->getNumMethodeParNom($_SESSION['nomMethode']);
if(!empty($_POST["TailleCubeSelect"])){
  $_SESSION["TailleCubeSelect"] = $_POST["TailleCubeSelect"];
}else{
  $_SESSION['TailleCubeSelect']=$managerMeth->getCubTailleMethodeParNum($_SESSION['numMethode']);
}
$list=$managerChap->getAllChapitreParMethode($_SESSION['numMethode']);
$NbrChapitreParMethode=sizeof($list);
  if(empty($_POST['titreChap'])&& empty($_POST['descriptionChap'])){
?>

<h1> ajout d'un chapitre pour la méthode : <?php echo $_SESSION['nomMethode']; ?> </h1>

<p>
<?php
$descriptionMeth=$managerMeth->getDescriptionMethodeParNum($_SESSION['numMethode']);
echo $descriptionMeth;
?>
</p>

<form method="post" action="#">
<fieldset>
  <legend>Ajouter un chapitre</legend>

     <label for="titreChap">Nom du chapitre (max. 50 caractères) :</label><br />
     <input type="text" name="titreChap" value="Titre du chapitre" /><br />
     </br>
     <label for="descriptionChap">Description du chapitre (max. 255 caractères) :</label><br />
     <textarea name="descriptionChap" id="description"></textarea><br />
     </br>

     <input type="submit" value="Ajouter" id="Valider"/>

     <?php
        if(isset($_SESSION['TailleCubeSelect'])){ ?>
          <a href="accueil.inc.php" id="lien">Retour à l'accueil</a>
        <?php }else{ ?>
          <a href="rubikscube.inc.php" id="lien">Retour sur votre cube</a>
        <?php } ?>

  </fieldset>
</form>
<br />
<?php
                                    $managerPiJo=new PieceJointeManager($db);
                                    $managerLien=new LienManager($db);
                                    $managerPart=new PartitionManager($db);
                                    $managerMouv=new MouvementManager($db);
                                    $managerListePartition=new ListePartitionManager($db);
                                    $managerCont=new ContientManager($db);
                                    ?>
                                    <div class="piecejointe">
                                    <p>
                                    <?php
                                    $listePieceJointeParMeth=$managerPiJo->getAllPieceJointeParMethode($_SESSION['numMethode']);
                                    foreach($listePieceJointeParMeth as $PieceJointe){
                                      $PiJo=$PieceJointe->getLien_fichier();
                                      echo '<p>'.$PiJo.'</p>';
                                  /*    //Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
                                  header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
                                  header('Content-Disposition: attachment; filename="'.$PiJo.'"'); //Nom du fichier
                                  header('Content-Length: '.int(sizeof($PiJo))); //Taille du fichier
                                  //Envoi du fichier dont le chemin est passé en paramètre
                                  readfile($PiJo);*/
                                     }
                                      ?>
                                  <p><a href="index.php?page=14" id="lien"><span id="lienNom">Ajouter un fichier</span></a></p>
                                  </p>
                                 </div>
                                 <div class="lien" >
                                 <p>
                                    <?php
                                    $listeLienParMethode=$managerLien->getAllLienParMethode($_SESSION['numMethode']);
                                    foreach($listeLienParMethode as $Lien){
                                      $lien=$Lien->getLien_adresse();
                                      ?>
                                       <p><a href="<?php echo $lien;?>" target="_blank">   <?php echo $lien; ?>  </a></p>
                                    <?php } ?>
                                    <p><a href="index.php?page=15" id="lien"><span id="lienNom">Ajouter un lien</span></a></p>
                                    </p>
                                  </div>
                                  <?php
                                    foreach($list as $ligne){
                                      $nomChapitre=$ligne->getCha_nom();
                                      $numChapitre=$ligne->getCha_num();
                                      ?>

                                    <div class="chap">

                                      <br/><p>Chapitre : <label for="name"><?php echo $nomChapitre.'<br/>'; ?></label></p>
                                      <p>
                                      <?php
                                      $descriptionChap=$ligne->getCha_description();
                                      echo $descriptionChap;
                                      ?>
                                      </p>

                                      <div class="partition">
                                        <p>
                                        <?php

                                            $listePartitionParChapitre=$managerCont->getAllPartitionParChapitre($numChapitre);

                                            foreach($listePartitionParChapitre as $Partition){
                                              $Part=$Partition->getPar_nom();
                                              echo $Part;

                                              $listeMouvementParPartition=$managerListePartition->getAllMouvementParPartition($Part);

                                              foreach($listeMouvementParPartition as $PartitionMouv){
                                                $numMouv=$PartitionMouv->getMvm_num();
                                                $Mouv=$managerMouv->getMouvementParMvmNum($numMouv);

                                                ?>
                                                <p>
                                                </p>
                                                <img src="<?php echo $Mouv;?>" />

                                                <?php

                                              } 
                                            } ?>
                                            <p><a href="index.php?page=16" id="lien"><span id="lienNom">Ajouter une Partition</span></a></p>
                                            <?php
                                        ?>

                                        </p>
                                      </div>
                                  </div>


                                    <?php
                                    }
}else{
$NbrChapitreNum=$managerChap->getNumChapitreMax()+1;
$chapitre = new Chapitre(
array('cha_num' => $NbrChapitreNum,
      'cha_description' => $_POST['descriptionChap'],
      'cha_nom' => $_POST['titreChap'],
      'cha_valide' => 0,
      'per_num_valide' => 1,
      'met_num' => $_SESSION['numMethode']
)
);
$managerChap->add($chapitre);
header("Refresh : 0, URL=index.php?page=11");
}
