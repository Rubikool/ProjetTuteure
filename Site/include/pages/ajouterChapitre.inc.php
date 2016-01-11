  <?php
  $db=new Mypdo();
  $managerMeth=new MethodeManager($db);
  $managerChap=new ChapitreManager($db);



  $_SESSION['nomMethode']=$_GET['nomMethode'];
  $numMethode=$managerMeth->getNumMethodeParNom($_SESSION['nomMethode']);
  $list=$managerChap->getAllChapitreParMethode($numMethode);

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
            $nomChapitre=$ligne->getCha_nom();
            $numChapitre=$managerMeth->getNumMethodeParNom($_SESSION['nomMethode']); ?>

            <label for="name"><?php echo $nomChapitre; ?></label>

            <a href="index.php?page=14&num=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">fichier</span></a>
            <a href="index.php?page=15&num=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">lien</span></a>
            <a href="index.php?page=16&num=<?php echo $numChapitre;?>" id="lien"><span id="lienNom">partition</span></a>



<?php } } ?>
