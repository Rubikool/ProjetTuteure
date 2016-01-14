<?php
$bd = new Mypdo();
$manager = new CubeManager($bd);

$_SESSION["nbRB"]++;
$_SESSION["var1"] = $_GET["var1"];
$_SESSION["var2"] = $_GET["var2"];
$_SESSION["lettreFin"] = $_GET["lettreFin"];

echo $_GET["lettreFin"];

$cube = new Cube (
  array(
    'cub_var1' => $_GET["var1"],
    'cub_var2' => $_GET["var2"],
    'cub_lettreFin' => $_GET["lettreFin"],
    'cub_taille' => $_SESSION["cube"],
    'cub_num' => '',
  )
);

$manager->add($cube);

header("Refresh : 0 ; URL = index.php?page=3");
?>
