<?php
$bd = new Mypdo();
$manager = new CitationManager($bd);
?>

<h1>Valider une citation</h1>

<table align="center">
  <tr>
    <th>Nom de l'enseignant</th>
    <th>Libell&eacute</th>
    <th>Refuser</th>
    <th>Valider</th>
  </tr>

<?php
$listeCitations = $manager->getCitationNonValide();
foreach ($listeCitations as $citation){
?>

<tr>
  <td><?php echo $manager->getNomEnseignant($citation->getPer_num()); ?></td>
  <td><?php echo $citation->getCit_libelle(); ?></td>
  <td><a href="<?php echo 'index.php?page=24&num='.$citation->getCit_num();?>" ><img src="image/erreur.png" alt="refuser" /></a></td>
  <td><a href="<?php echo 'index.php?page=23&num='.$citation->getCit_num();?>" ><img src="image/valid.png" alt="valider" /></a></td>
</tr>

<?php
}
?>

</table>
<br/>
