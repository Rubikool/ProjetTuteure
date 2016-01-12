  <?php
  $db=new Mypdo();
  $managerMeth=new MethodeManager($db);
  $managerChap=new ChapitreManager($db);

if(!isset($_SESSION['nomMethode'])){
  if(isset($_GET['nomMethode'])){
      $_SESSION['nomMethode']=$_GET['nomMethode'];
  }else{
    $_SESSION['nomMethode']=$_POST['nomMethode'];
  }
}
  if(!empty($_POST["TailleCubeSelect"])){
    $_SESSION["TailleCubeSelect"] = $_POST["TailleCubeSelect"];
  }

  $_SESSION['numMethode']=$managerMeth->getNumMethodeParNom($_SESSION['nomMethode']);
  $list=$managerChap->getAllChapitreParMethode($_SESSION['numMethode']);

  $NbrChapitreParMethode=sizeof($list);

  if($NbrChapitreParMethode==0){

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
            <a href="accueil.inc.php">Retour à l'accueil</a>
          <?php }else{ ?>
            <a href="rubikscube.inc.php">Retour sur votre cube</a>
          <?php } ?>

    </fieldset>
  </form>

  <?php
}else{
  $NbrChapitreNum=$managerChap->getNumChapitreMax()+1;
  echo $_POST['descriptionChap'];
  echo $_POST['titreChap'];
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


}

  }else{ ?>




  <h1> ajout d'un nouveau chapitre pour la méthode : <?php echo $_SESSION['nomMethode']; ?> </h1>
    <form method="post" action="#">
    <fieldset>
      <legend>Ajouter un chapitre</legend>

         <label for="titre">Nom du chapitre (max. 50 caractères) :</label><br />
         <input type="text" name="titre" value="Titre du chapitre" /><br />
         </br>
         <label for="description">Description du chapitre (max. 255 caractères) :</label><br />
         <textarea name="description" id="description"></textarea><br />
         </br>

         <input type="submit" value="Ajouter" id="Valider"/>

         <?php
            if(isset($_SESSION['TailleCubeSelect'])){ ?>
              <a href="accueil.inc.php">Retour à l'accueil</a>
            <?php }else{ ?>
              <a href="rubikscube.inc.php">Retour sur votre cube</a>
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

            <label for="name"><?php echo $nomChapitre; ?></label>

            <?php
            $listePieceJointeParChapitre=$managerPiJo->getAllPieceJointeParChapitre($numChapitre);

            foreach($listePieceJointeParChapitre as $PieceJointe){
              $PiJo=$PieceJointe->getLien_fichier();

              //Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
  header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
  header('Content-Disposition: attachment; filename="'.$PiJo.'"'); //Nom du fichier
  header('Content-Length: '.int(sizeof($PiJo))); //Taille du fichier

//Envoi du fichier dont le chemin est passé en paramètre
  readfile($PiJo);

             } ?>

            <br/><a href="index.php?page=14&num=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">fichier</span></a>


            <br/><a href="index.php?page=15&num=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">lien</span></a>


            <?php
            $listeLienParChapitre=$managerLien->getAllLienParChapitre($numChapitre);

            foreach($listeLienParChapitre as $Lien){
              $lien=$Lien->getLien_adresse();
              ?>
              <a href="<?php echo $lien;?>">   <?php echo $lien; ?>  </a>
            <?php } ?>



            <?php
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

            <a href="index.php?page=16&num=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">partition</span></a>



<?php } } ?>
