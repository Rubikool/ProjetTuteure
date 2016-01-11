  <?php
  $db=new Mypdo();
  $managerMeth=new MethodeManager($db);
  $managerChap=new ChapitreManager($db);

if(!isset($_POST['nomMethode'])){


    if(isset($_GET['num'])){

    }else{
      $_SESSION['num']=$_GET['num'];
    }

  $list=$managerChap->getAllChapitreParMethode($_SESSION['num']);

  $NbrChapitreParMethode=sizeof($list);


  if($NbrChapitreParMethode==0){ ?>

  <h1> ajout d'un chapitre pour la méthode : <?php echo'' ; ?> </h1>
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
  <?php }else{ ?>




  <h1> ajout d'un nouveau chapitre pour la méthode : <?php echo $_SESSION['nom']; ?> </h1>
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



          <?php foreach($list as $ligne){
            $nom=$ligne->getCha_nom();
            $num=$managerMeth->getNumMethodeParNom($nom)->met_num; ?>

            <label for="name"><?php echo $nom; ?></label>

            <a href="ChapitreFichier.inc.php" id="lien"><span id="lienNom">fichier</span></a>
            <a href="ChapitreLien.inc.php" id="lien"><span id="lienNom">lien</span></a>
            <a href="ChapitrePartition.inc.php" id="lien"><span id="lienNom">partition</span></a>



  <?php } }



}else{

  $_SESSION['nomMethode']=$_POST['nomMethode'];

  $num=$managerMeth->getNumMethodeParNom($_SESSION['nomMethode']);
  $list=$managerChap->getAllChapitreParMethode($num);

  $NbrChapitreParMethode=sizeof($list);

  if($NbrChapitreParMethode==0){ ?>

<h1> ajout d'un chapitre pour la méthode : <?php echo $_SESSION['nomMethode']; ?> </h1>
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
<?php }else{ ?>




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



          <?php foreach($list as $ligne){
            $nom=$ligne->getCha_nom();
            $num=$managerMeth->getNumMethodeParNom($nom)->met_num; ?>

            <label for="name"><?php echo $nom; ?></label>

            <a href="ChapitreFichier.inc.php" id="lien"><span id="lienNom">fichier</span></a>
            <a href="ChapitreLien.inc.php" id="lien"><span id="lienNom">lien</span></a>
            <a href="ChapitrePartition.inc.php" id="lien"><span id="lienNom">partition</span></a>



<?php } } }?>
