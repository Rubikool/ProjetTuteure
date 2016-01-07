<?php
if (empty($_SESSION["connecte"]) OR $_SESSION["connecte"] != 1){
?>

<ul id="superMenu">
	<li><a href="index.php?page=0">Accueil</a></li>
</ul>

<?php
} else {
		if ($_SESSION["admin"] == 1){
?>

<ul id="superMenu">
	<li><a href="index.php?page=0">Accueil</a></li>
	<li><a href="index.php?page=0">Personne</a>
		<ul>
			<li><a href="index.php?page=6">Lister</a></li>
			<li><a href="index.php?page=5">Ajouter</a></li>
			<li><a href="index.php?page=7">Supprimer</a></li>
		</ul>
	</li>
	<li><a href="index.php?page=0">M&eacutethode</a>
		<ul>
			<li><a href="index.php?page=0">Lister</a></li>
			<li><a href="index.php?page=0">Valider</a></li>
			<li><a href="index.php?page=0">Supprimer</a></li>
		</ul>
	</li>
</ul>


<?php
} else {
?>

<ul id="superMenu">
	<li><a href="index.php?page=0">Accueil</a></li>
	<li><a href="index.php?page=0">M&eacutethode</a>
		<ul>
			<li><a href="index.php?page=9">Ajouter</a></li>
			<li><a href="index.php?page=0">Charger</a></li>
		</ul>
	</li>
	<li><a href="index.php?page=0">Nouvelle configuration</a></li>
	<li><a href="index.php?page=0">Mouvement</a>
		<ul>
			<li><a href="index.php?page=0">Creer</a></li>
			<li><a href="index.php?page=0">Lister</a></li> <!-- méthodes Utiliser et Modifier -->
		</ul>
	</li>
</ul>

<?php
	}
}
?>

<br/><br/>
