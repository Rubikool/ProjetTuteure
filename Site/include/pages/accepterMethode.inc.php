<?php
$bd = new Mypdo();
$manager = new CitationManager($bd);
$managerPer = new PersonneManager($bd);
?>

<h1>Valider une citation</h1>

<?php
$_SESSION["citTempPerNum"] = $manager->getPerNumCitation($_GET["num"])->per_num;
$_SESSION["citTempPerNumEtu"] = $manager->getPerNumEtuCitation($_GET["num"])->per_num_etu;
$_SESSION["citTempCitLibelle"] = $manager->getCitLibelleCitation($_GET["num"])->cit_libelle;
$_SESSION["citTempCitDate"] = $manager->getCitDateCitation($_GET["num"])->cit_date;
$_SESSION["citTempCitDateDepo"] = $manager->getCitDateDepoCitation($_GET["num"])->cit_date_depo;

$numPer = $managerPer->getNumPersonneAvecNom($_SESSION["nom"])->per_num;

$dateDuJour = date("Y-m-d");

$manager->deleteCitation($_GET["num"]);

$citation = new Citation(
  array('cit_num' => $_GET["num"],
        'per_num' => $_SESSION["citTempPerNum"],
        'per_num_valide' => $numPer,
        'per_num_etu' => $_SESSION["citTempPerNumEtu"],
        'cit_libelle' => $_SESSION["citTempCitLibelle"],
        'cit_date' => $_SESSION["citTempCitDate"],
        'cit_valide' => 1,
        'cit_date_valide' => $dateDuJour,
        'cit_date_depo' => $_SESSION["citTempCitDateDepo"],
  )
);

$manager->add($citation);

echo '<img src="image/valid.png" /> La citation a &eacutet&eacute ajout&eacutee !';
header("Refresh: 2 ; URL = index.php");
?>
