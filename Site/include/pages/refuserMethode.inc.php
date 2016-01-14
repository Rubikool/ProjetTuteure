<?php
$bd = new Mypdo();
$manager = new CitationManager($bd);
?>

<h1>Valider une citation</h1>

<?php
$manager->deleteCitation($_GET["num"]);

echo '<br/><img src="image/valid.png" /> La citation a &eacutet&eacute refus&eacutee !';
header("Refresh: 2 ; URL = index.php");
?>
