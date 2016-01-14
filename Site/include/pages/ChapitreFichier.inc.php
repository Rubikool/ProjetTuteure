
<?php
$db=new MyPdo();
$managerPijo=new PieceJointeManager($db);
$maxsize = 1000000;
$extensions_valides = array('pdf');
$nomRepertoire = 'fichierMethode/';
$taille = 0;
$extension = 0;
$erreur = 0;
if(empty($_FILES)){
?>
<form method="post" action="#" enctype="multipart/form-data">

     <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br />

     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />

     <input type="file" name="mon_fichier" id="mon_fichier" /><br />

     <input type="submit" name="submit" value="Envoyer" />

     <a href="index.php?page=11" id="lien">Revenir sur l'écran des méthodes</a>

</form>

<?php
} else {
  $error = "";
  if($_FILES['mon_fichier']['size'] > $maxsize){
    $error = 'Le ficher est trop gros !';
    $taille = 1;
  }
  if($_FILES['mon_fichier']['error'] > 0){
    $error = 'Erreur lors du transfert !';
    $erreur = 1;
  }
  $extension_upload = strtolower(  substr(  strrchr($_FILES['mon_fichier']['name'], '.')  ,1)  );
  if(in_array($extension_upload,$extensions_valides)){
    echo "Extension correcte";
  } else {
    $error = "L'extension est incorrecte !";
    $extension = 1;
    header('Refresh : 1 ; URL = index.php?page=11');
  }
  $NbrPieceJointe=$managerPijo->getNumPiJoMax()+1;
  if($taille == 0 && $extension == 0 && $erreur == 0){
    $emplacement = $nomRepertoire.'Meth'.$_SESSION['numMethode'].'_Lien'.$NbrPieceJointe.'.pdf';
    $resultat = move_uploaded_file($_FILES['mon_fichier']['tmp_name'],$emplacement);
    if($resultat){
      echo "<br/>Transfert réussi";
      header('Refresh : 1 ; URL = index.php?page=11');
    }
  }
  $PiJo= new PieceJointe(
  array( 'pie_num' => $NbrPieceJointe,
         'met_num' => $_SESSION['numMethode'],
         'lien_fichier' => $emplacement
  )
);
  $managerPijo->add($PiJo);
}
?>
