<?php
$db=new Mypdo();
$managerMeth=new MethodeManager($db);
$managerChap=new ChapitreManager($db);

if(!isset($_SESSION['nomMethode'])){
if(isset($_GET['nomMethode'])){
    $_SESSION['nomMethode']=$_GET['nomMethode'];
}
}
if(!empty($_POST["TailleCubeSelect"])){
  $_SESSION["TailleCubeSelect"] = $_POST["TailleCubeSelect"];
}

$_SESSION['numMethode']=$managerMeth->getNumMethodeParNom($_SESSION['nomMethode']);
$list=$managerChap->getAllChapitreParMethode($_SESSION['numMethode']);

$NbrChapitreParMethode=sizeof($list);



  if(empty($_POST['titreChap'])&& empty($_POST['descriptionChap'])){

?>

<h1> ajout d'un chapitre pour la méthode : <?php echo $_SESSION['nomMethode']; ?> </h1>
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

<?php
                                    $managerPiJo=new PieceJointeManager($db);
                                    $managerLien=new LienManager($db);
                                    $managerPart=new PartitionManager($db);
                                    $managerMouv=new MouvementManager($db);

                                    foreach($list as $ligne){
                                      $nomChapitre=$ligne->getCha_nom();
                                      $numChapitre=$ligne->getCha_num();
                                      ?>

                                    <div class="chap">

                                      <br/><p>Chapitre : <label for="name"><?php echo $nomChapitre.'<br/>'; ?></label></p>

                                      <div class="piecejointe">

                                      <?php
                                      $listePieceJointeParChapitre=$managerPiJo->getAllPieceJointeParChapitre($numChapitre);

                                      if(sizeof($listePieceJointeParChapitre)==0){
                                      ?>

                                        <br/><a href="index.php?page=14&numChapitre=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">Ajouter fichier</span></a>

                                      <?php
                                      }else{
                                      ?>


                                      <?php
                                      foreach($listePieceJointeParChapitre as $PieceJointe){
                                        $PiJo=$PieceJointe->getLien_fichier();

                                        echo '<br/>'.$PiJo;

                                    /*    //Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
                                    header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
                                    header('Content-Disposition: attachment; filename="'.$PiJo.'"'); //Nom du fichier
                                    header('Content-Length: '.int(sizeof($PiJo))); //Taille du fichier

                                    //Envoi du fichier dont le chemin est passé en paramètre
                                    readfile($PiJo);*/

                                       }
                                        ?>

                                        <br/><a href="index.php?page=14&numChapitre=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">Ajouter fichier</span></a>

                                        <?php
                                     }?>

                                   </div>
                                   <div class="lien" >




                                      <?php
                                      $listeLienParChapitre=$managerLien->getAllLienParChapitre($numChapitre);

                                      foreach($listeLienParChapitre as $Lien){
                                        $lien=$Lien->getLien_adresse();
                                        ?>
                                        <br/><a href="<?php echo $lien;?>" target="_blank">   <?php echo $lien; ?>  </a>
                                      <?php } ?>

                                      <br/><a href="index.php?page=15&numChapitre=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">Ajouter lien</span></a>

                                    </div>
                                    <div class="partition">
                                      <?php
                                      echo '<br/>';

                                      switch($_SESSION['TailleCubeSelect']){
                                        case 2:

                                          $listeMouvementParChapitre=$managerMouv->getMouvementByMvmNum($mvm_num);
                                          foreach($listeMouvementParChapitre as $Mouvement){

                                          } ?>

                                          <img src="../../image/partition/2x2x2/<?php echo $Partition->getMouvement();?>.png" />

                                          <?php
                                          break;

                                        case 3:?>
                                          <img src="../../image/partition/2x2x2/.." />
                                          <?php
                                          break;

                                        case 4:?>
                                          <img src="../../image/partition/2x2x2/.." />
                                          <?php
                                          break;

                                        case 5:?>
                                          <img src="../../image/partition/2x2x2/.." />
                                          <?php
                                          break;

                                        case 6:?>
                                          <img src="../../image/partition/2x2x2/.." />
                                          <?php
                                          break;

                                        case 7:?>
                                          <img src="../../image/partition/2x2x2/.." />
                                          <?php
                                          break;


                                        }



                                      ?>
                                      <br/><a href="index.php?page=16&numChap=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">Ajouter partition</span></a>

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
