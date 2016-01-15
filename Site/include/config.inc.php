<?php
// Param�tres de l'application Covoiturage
// A modifier en fonction de la configuration

define('DBHOST', 'localhost');
define('DBNAME', 'rubik\'ool');
define('DBUSER', 'bd');
define('DBPASSWD', 'bede');
define('ENV','dev');

define('SMTP',        "localhost");
define('smtp_port'  , "25");
// pour un environememnt de production remplacer 'dev' (d�veloppement) par 'prod' (production)
// les messages d'erreur du SGBD s'affichent dans l'environememnt dev mais pas en prod
?>
