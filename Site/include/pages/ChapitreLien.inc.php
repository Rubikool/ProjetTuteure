<?php


if(empty($_POST['lien'])){ ?>
  <form method="post" action="#">
         <label for="lien" id="autrelabel">Lien : </label><input type="text" name="lien" id="lien" placeholder="Ne pas oublier le http"/><br />
  <input type="submit" name="submit" value="Envoyer" />
  <a href="index.php?page=11" "lien">Revenir sur l'écran des méthodes</a>
  </form>
  <?php
}else{

    $db=new MyPdo();
    $managerLien=new LienManager($db);
    $lien_num=$managerLien->getNumLienMax()+1;
    $lien=new Lien(
    array(  'lien_num' => $lien_num,
            'met_num' => $_SESSION['numMethode'],
            'lien_adresse' => $_POST['lien']
    )
  );

  $managerLien->add($lien);
  header("Refresh : 0, URL=index.php?page=11");
} ?>
