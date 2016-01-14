<h1>Erreur 401</h1>

<img src="image/erreur.png" > Acces refus&eacute !

<?php
  echo '<br/><br/>Redirection automatique dans 2 secondes.';
  header("Refresh: 2 ; URL = index.php");
?>
