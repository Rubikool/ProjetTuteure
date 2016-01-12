<?php
if(isset($_GET['numChapitre'])){
    $numChapitre=$_GET['numChapitre'];
}

if(empty($_POST['lien'])){ ?>
  <form method="post" action="#">
         <label for="lien" id="autrelabel">Lien : </label><input type="text" name="lien" id="lien" value="Ne pas oublier le http"/><br />
  <input type="submit" name="submit" value="Envoyer" />
  </form>
  <?php
}else{

    $db=new MyPdo();
    $managerLien=new LienManager($db);
    $lien_num=$managerLien->getNumLienMax()+1;
    $lien=new Lien(
    array(  'lien_num' => $lien_num,
            'cha_num' => $numChapitre,
            'lien_adresse' => $_POST['lien']
    )
  );

  $managerLien->add($lien);
} ?>
