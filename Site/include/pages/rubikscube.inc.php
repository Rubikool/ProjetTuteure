<?php
require_once ('xajax_core/xajax.inc.php');
$bd = new Mypdo ();
$manager = new CubeManager ( $bd );

if (! empty ( $_GET ["TailleCubeSelect"] )) {
	$_SESSION ["TailleCubeSelect"] = $_GET ["TailleCubeSelect"];
	$_SESSION ["nbRB"] = 0;
	$manager->viderCube ();
}

$nombreRB = 0;
?>

<div id="methode">
	<h2>Methode</h2>
	<select>
		<option></option>
	</select>
</div>
<input type="hidden" id="taille"
	value="<?php echo $_REQUEST['TailleCubeSelect'];?>" />
<?php
echo '<h2>Cube ' . $_SESSION ["TailleCubeSelect"] . 'x' . $_SESSION ["TailleCubeSelect"] . 'x' . $_SESSION ["TailleCubeSelect"] . '</h2>';
?><?php

for($i = 0; $i < $_REQUEST ['TailleCubeSelect']; $i ++) :
	?>
<input type="button" onclick="X(<?php echo $i;?>,-1);"
	value="R<?php echo $i;?>" />
<input type="button" onclick="X(<?php echo $i;?>,1);"
	value="R'<?php echo $i;?>" />
<?php endfor;?>
<br />
<?php for($i = 0; $i < $_REQUEST ['TailleCubeSelect']; $i ++) :?>
<input type="button" onclick="Y(<?php echo $i;?>,-1);"
	value="U<?php echo $i;?>" />
<input type="button" onclick="Y(<?php echo $i;?>,1);"
	value="U'<?php echo $i;?>" />
<?php endfor;?>
<br />
<?php for($i = 0; $i < $_REQUEST ['TailleCubeSelect']; $i ++) :?>
<input type="button" onclick="Z(<?php echo $i;?>,-1);"
	value="F<?php echo $i;?>" />
<input type="button" onclick="Z(<?php echo $i;?>,1);"
	value="F'<?php echo $i;?>" />
<?php endfor;?>
<br />
<input type="button" onclick="recentrer();"
	value="Centrer la vur sur la face de travail" />
<input type="button" onclick="initCube();"
	value="Reprendre depuis un cube fini" />
<input type="button" onclick="melanger();" value="Melanger le cube" />
<input type="button" onclick="creeAxes();" value="Afficher/Cacher axes" />
<div id="container"></div>
<h3>Partition :</h3>