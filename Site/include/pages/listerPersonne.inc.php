<?php

$bd = new Mypdo();
$manager = new PersonneManager($bd);
?>

<h1>Liste des élèves enregistrées</h1>

<?php
if($manager->getNbrePersonne()->nbrePersonne <= 1){
	echo 'Actuellement '.$manager->getNbrePersonne()->nbrePersonne.' &eacuteleve est enregistr&eacute';
} else {
	echo 'Actuellement '.$manager->getNbrePersonne()->nbrePersonne.' &eacuteleves sont enregistr&eacutes';
}
if ($manager->getNbrePersonne()->nbrePersonne != 0){
?>

	<br/><br/>
	<table align="center">
		<tr>
			<th>Num&eacutero</th>
			<th>Nom</th>
			<th>Pr&eacutenom</th>
			<th>E-mail</th>
		</tr>

<?php
  $listePersonne = $manager->getPersonne();
  foreach ($listePersonne as $personne){
?>

	<tr>
		<?php echo '<td><a href="?page=8&num='.$personne->getPer_num().'" ><b>'.$personne->getPer_num().'</b><a/></td>'; ?>
		<td><?php echo $personne->getPer_nom(); ?></td>
		<td><?php echo $personne->getPer_prenom(); ?></td>
		<td><?php echo $personne->getPer_mail(); ?></td>
  </tr>

<?php
}
?>

  </table>
	<br/>

<?php
}
?>
