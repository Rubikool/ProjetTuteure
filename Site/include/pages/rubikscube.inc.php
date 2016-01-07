<?php
$bd = new Mypdo();
$manager = new CubeManager($bd);

if(!isset($_SESSION["nbRB"])){
  $_SESSION["nbRB"] = 0;
  $manager->viderCube();
}

if(!empty($_GET["cube"])){
  $_SESSION["cube"] = $_GET["cube"];
  $_SESSION["nbRB"] = 0;
  $manager->viderCube();
}

$nombreRB = 0;

echo '<div id="methode" >';
echo '<h2>Methode</h2>';
echo '</div>';

echo '<h2>Cube '.$_SESSION["cube"].'x'.$_SESSION["cube"].'x'.$_SESSION["cube"].'</h2>';
echo '<img src="image/'.$_SESSION["cube"].'x'.$_SESSION["cube"].'x'.$_SESSION["cube"].'.png" class="imageRCAccueil" />';

$i = 0;
echo '<br/>';
while($i<$_SESSION["cube"]){
    $i++;
    echo '<a href="index.php?page=4&var1=2&var2='.$i.'&lettreFin=g" onclick="essai(2,'.$i.',g)" ><img src="./image/fg.png"/></a>';
}

$i = 0;
echo '<br/>';
while($i<$_SESSION["cube"]){
    $i++;
    echo '<a href="index.php?page=4&var1=2&var2='.$i.'&lettreFin=d" onclick="essai(2,'.$i.',d)" ><img src="./image/fd.png"/></a>';
}

$i = 0;
echo '<br/>';
while($i<$_SESSION["cube"]){
    $i++;
    echo '<a href="index.php?page=4&var1=1&var2='.$i.'&lettreFin=h" onclick="essai(1,'.$i.',h)" ><img src="./image/fdh.png"/></a>';
}

$i = 0;
echo '<br/>';
while($i<$_SESSION["cube"]){
    $i++;
    echo '<a href="index.php?page=4&var1=1&var2='.$i.'&lettreFin=b" onclick="essai(1,'.$i.',b)" ><img src="./image/fdb.png"/></a>';
}

$i = 0;
echo '<br/>';
while($i<$_SESSION["cube"]){
    $i++;
    echo '<a href="index.php?page=4&var1=3&var2='.$i.'&lettreFin=g" onclick="essai(3,'.$i.',g)" ><img src="./image/fdg.png"/></a>';
}

$i = 0;
echo '<br/>';
while($i<$_SESSION["cube"]){
    $i++;
    echo '<a href="index.php?page=4&var1=3&var2='.$i.'&lettreFin=d" onclick="essai(3,'.$i.',d)" ><img src="./image/fdd.png"/></a>';
}

echo '<br/><br/><br/>';
echo '<h3>Partition :</h3>';
echo '<tr><div id="elePartition">';

$listeCube = $manager->getCube();
foreach ($listeCube as $cube){
  echo '<div class="imagePartition">';
  echo '<img src="image/'.$cube->getCub_taille().'/'.$cube->getCub_var1().'_'.$cube->getCub_var2().$cube->getCub_lettreFin().'.png" class="imagePartition" />';
  echo '<input type="button" src="image/valid.png" />';
  echo '</div>';
}

echo '</div>';
?>
