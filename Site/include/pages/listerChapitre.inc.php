<?php
$db=new Mypdo();
$managerMeth=new MethodeManager($db);
$managerChap=new ChapitreManager($db);


$_SESSION['nomMethode']=$_GET['nomMethode'];

$_SESSION['numMethode']=$managerMeth->getNumMethodeParNom($_SESSION['nomMethode']);

$_SESSION['TailleCubeSelect']=$managerMeth->getCubTailleMethodeParNum($_SESSION['numMethode']);


$list=$managerChap->getAllChapitreParMethode($_SESSION['numMethode']);

$NbrChapitreParMethode=sizeof($list);

?>

<h1> Liste des chapitres pour la méthode : <?php echo $_SESSION['nomMethode']; ?> </h1>
<p>
<?php
$descriptionMeth=$managerMeth->getDescriptionMethodeParNum($_SESSION['numMethode']);
echo $descriptionMeth;
?>
</p>

<?php
                                    $managerPiJo=new PieceJointeManager($db);
                                    $managerLien=new LienManager($db);
                                    $managerPart=new PartitionManager($db);
                                    $managerMouv=new MouvementManager($db);
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

                                          $listePartitionParChapitre=$managerPart->getAllPartitionParChapitre($numChapitre);

                                          foreach($listePartitionParChapitre as $Partition){
                                            echo $Partition->getPar_nom();

                                            ?>
                                          <p>
                                          <?php

                                          ?>
                                          </p>
                                          <img src="<?php echo $mouv;?>" />

                                          <?php
                                            }

                                      ?>

                                      </p>
                                    </div>
                                  </div>


                                    <?php
                                  } ?>
          <br />
          <table class="SansBordure">
            <tr class="SansBordure">
              <td class="SansBordure"><a href="index.php?page=13">Accepter <img src="./image/valid.png"/></a></td>
              <td class="SansBordure"><a href="index.php?page=19">Commentaire <img src="./image/modifier.png"/></a></td>
              <td class="SansBordure"><a href="index.php?page=14">Refuser <img src="./image/erreur.png"/></a></td>
            </tr>
          </table>
