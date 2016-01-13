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
                                        <p>
                                      <?php
                                      $listePieceJointeParChapitre=$managerPiJo->getAllPieceJointeParChapitre($numChapitre);


                                      foreach($listePieceJointeParChapitre as $PieceJointe){
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
                                      $listeLienParChapitre=$managerLien->getAllLienParChapitre($numChapitre);

                                      foreach($listeLienParChapitre as $Lien){
                                        $lien=$Lien->getLien_adresse();
                                        ?>
                                         <p><a href="<?php echo $lien;?>" target="_blank">   <?php echo $lien; ?>  </a></p>
                                      <?php } ?>
                                      </p>
                                    </div>
                                    <div class="partition">
                                      <p>
                                      <?php

                                          $listeMouvementParTaille=$managerMouv->getAllMouvementParTaille($_SESSION['TailleCubeSelect']);

                                          foreach($listeMouvementParTaille as $Mouvement){
                                            $mouv=$Mouvement->getMouvement();

                                            ?>

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
        
