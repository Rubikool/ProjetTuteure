<?php
$bd=new Mypdo();
$managerMeth=new MethodeManager($bd);
$managerChap=new ChapitreManager($bd);
unset($_SESSION['nomMethode']);
unset($_SESSION['numMethode']);
$methodes=$managerMeth->getAllMethodeParUti($_SESSION['num']);


if(sizeof($methodes)==0){
  echo "Aucune méthodes enregistrées";
}else{


?>

<h1>Liste des m&eacutethodes enregistrées</h1>
<p> Actuellement <?php echo sizeof($methodes) ;?> methodes sont enregistrées  </p>
<table class="listeof">
	<tr class="listof">
		<th class="listof">Nom</th><th class="listof">Nombre de chapitres</th><th class="listof">Validité</th>
	</tr>
	<?php foreach($methodes as $methode){

				$nbrChapitre=$managerChap->getAllChapitreParMethode($methode->getMet_num());
				$NBRChapitre=sizeof($nbrChapitre);?>
		<tr>
			<td class="listof"><a href="index.php?page=19&nomMethode=<?php echo $methode->getMet_nom(); ?>"><?php echo $methode->getMet_nom();?></a></td>
			<td class="listof"><a href="index.php?page=19&nomMethode=<?php echo $methode->getMet_nom(); ?>"><?php echo $NBRChapitre;?></a></td>
      <td class="listof">
          <?php
            if($methode->getMet_valide()==-1){ ?>
              <img src="./image/erreur.png" alter="Erreur"/>
          <?php  }

            if($methode->getMet_valide()==0){ ?>
              <span>...</span>
          <?php }

          if($methode->getMet_valide()==1){ ?>
            <img src="./image/valid.png" alter="valide"/>
          <?php } ?>
      </td>
		</tr>
	<?php } ?>
</table>
<br />
<?php echo "Cliquer sur une méthode pour accèder à celle-ci";
}?>
