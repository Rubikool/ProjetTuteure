<?php
$bd = new Mypdo();
$manager = new PersonneManager($bd);

if(!isset($_GET["num"])){
?>

<h1>Supprimer un élève</h1>
	<fieldset>
		<legend>Suppression d'un élève</legend>
	<table align="center">
		<tr>
			<th>Nom</th>
			<th>Pr&eacutenom</th>
			<th>Choisir la personne<br/> a supprimer</th>
		</tr>

<?php
$listePersonne = $manager->getPersonne();
foreach ($listePersonne as $personne){
?>

	<tr>
		<td><?php echo $personne->getPer_nom(); ?></td>
		<td><?php echo $personne->getPer_prenom(); ?></td>
		<?php echo '<td><a href="?page=7&num='.$personne->getPer_num().'" ><img src="./image/erreur.png" /><a/></td>'; ?>
	</tr>

<?php
}
?>

	</table>
	</fieldset>
	<br/>

<?php
} else {
	echo '<h1>Supprimer des personnes enregistrées</h1>';

	$manager->deletePersonne($_GET["num"]);

	echo '<img src="image/valid.png" /> L\'&eacuteleve a &eacutet&eacute supprim&eacute avec succes !';
	header("Refresh : 2 ; URL = index.php?page=6");
}
?>
