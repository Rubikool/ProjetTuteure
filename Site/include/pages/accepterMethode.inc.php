<?php
$bd = new Mypdo();
$managerMeth = new MethodeManager($bd);

$managerMeth->updateMethode(1,$_SESSION['numMethode']);

header("Refresh: 0 ; URL = index.php?page=12");
?>
