<?php
$bd = new Mypdo();
$manager = new CitationManager($bd);
$managerPer = new PersonneManager($bd);
?>

<h1>Liste des citations déposées</h1>

<?php
echo 'Actuellement '.$manager->getNbreCitation()->nbreCitation.' citations sont enregistr&eacutees';
?>

	<br/><br/>
	<table align="center">
		<tr>
			<th>Nom de l'enseignant</th>
			<th>Libell&eacute</th>
			<th>Date</th>
			<th>Moyenne des notes</th>

<?php
if(!empty($_SESSION["connecte"])){
	if($_SESSION["admin"] == 0){
?>

			<th>Noter</th>

<?php
	}
}
?>

		</tr>

<?php
$listeCitations = $manager->getCitation();
foreach ($listeCitations as $citation){
?>

  <tr>
		<td><?php echo $manager->getNomEnseignant($citation->getPer_num()); ?></td>
		<td><?php echo $citation->getCit_libelle(); ?></td>
		<td><?php echo $citation->getCit_date_valide(); ?></td>
		<td>

<?php
if ($manager->getMoyenne($citation->getCit_num()) == ''){
	echo 'Pas de notes';
} else {
	echo $manager->getMoyenne($citation->getCit_num());
}
?>

		</td>

<?php
if(!empty($_SESSION["connecte"])){
	if($_SESSION["admin"] == 0){
?>

		<td>
<?php
$perNum = $managerPer->getNumPersonneAvecNom($_SESSION["nom"])->per_num;
$citNum = $citation->getCit_num();

if($manager->verifPersonneCitation($perNum,$citNum)->nbreLigne == 1){
	echo '<img src="image/erreur.png" />';
} else {
	$numCit = $citation->getCit_num();
	echo '<a href="index.php?page=26&num='.$numCit.'" ><img src="image/modifier.png" /></a>';
}
?>
		</td>

<?php
	}
}
?>

	</tr>

<?php
}
?>

  </table>
	<br/>
