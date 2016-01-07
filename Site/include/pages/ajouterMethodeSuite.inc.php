
<h1>Ajouter une citation</h1>

<?php

$bd = new Mypdo();
$manager = new CitationManager($bd);
$managerPer = new PersonneManager($bd);

$numPer = $managerPer->getNumPersonneAvecNom($_SESSION["nom"])->per_num;

$dateAjout = getEnglishDate($_SESSION["CitDateAjout"]);
$dateDuJour = date("Y-m-d");
$heureDuJour = date("H:i");
$dateEtHeureDuJour = $dateDuJour.' '.$heureDuJour;

$citation = new Citation(
  array('cit_num' => '',
        'per_num' => $_SESSION["CitEnsAjout"],
        'per_num_valide' => NULL,
        'per_num_etu' => $numPer,
        'cit_libelle' => stripslashes($_SESSION["CitLibelleAjout"]),
        'cit_date' => $dateAjout,
        'cit_valide' => '',
        'cit_date_valide' => NULL,
        'cit_date_depo' => $dateEtHeureDuJour,
  )
);

$manager->add($citation);

echo '<img src="image/valid.png" /> La citation a &eacutet&eacute ajout&eacutee !';
header("Refresh: 2 ; URL = index.php");
?>
