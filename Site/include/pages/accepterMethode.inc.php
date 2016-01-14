<?php
$bd = new Mypdo();
$managerMeth = new MethodeManager($bd);
$numMethode = $managerMeth->getNumMethodeParNom($_GET['nomMethode']);
$managerMeth->updateMethode(1,$numMethode);
header("Refresh: 0 ; URL = index.php?page=12");
?>
