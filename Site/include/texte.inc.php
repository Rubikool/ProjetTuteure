<div id="texte">

<?php
if (!empty($_GET["page"])) {
	$page=$_GET["page"];
} else {
	$page=0;
}
if (empty($_SESSION["connecte"]) OR $_SESSION["connecte"] != 1){
	switch ($page) {
		//==========================================================================
		// Page d'Accueil
		//==========================================================================
		case 0:
			include_once('pages/accueil.inc.php');
			break;
		//==========================================================================
		// Page de Connexion et de Deconnection
		//==========================================================================
		case 1:
			include("pages/connexion.inc.php");
			break;
		case 2:
			include("pages/deconnexion.inc.php");
			break;
		case 3:
			include("pages/ajouterPersonne.inc.php");
		  break;
		//==========================================================================
		// Page du Rubik's Cube
		//==========================================================================
		case 4:
			include("pages/rubikscube.inc.php");
			break;
		case 5:
			include("pages/ajouterImagePartition.inc.php");
			break;
		//==========================================================================
		// Page de Personne
		//==========================================================================
		case 6:
			include("pages/listerPersonne.inc.php");
			break;
		case 8:
			include("pages/infoPersonne.inc.php");
			break;
		case 9:
			include("pages/motDePasseOubliePersonne.inc.php");
			break;
		//==========================================================================
		//	 Page de Non Accès
		//==========================================================================
		default :
			include_once('pages/pageInterdite.inc.php');
	}
} else {
	if ($_SESSION["admin"] == 1){
		switch ($page) {
			//==========================================================================
			// Page d'Accueil
			//==========================================================================
			case 0:
				include_once('pages/accueil.inc.php');
				break;
			//==========================================================================
			// Page de Connexion et de Deconnection
			//==========================================================================
			case 1:
				include("pages/connexion.inc.php");
		    break;
			case 2:
				include("pages/deconnexion.inc.php");
			  break;
			//==========================================================================
			// Page du Rubik's Cube
			//==========================================================================
			case 4:
				include("pages/rubikscube.inc.php");
				break;
			case 5:
				include("pages/ajouterImagePartition.inc.php");
				break;
			//==========================================================================
			// Page de Personne
			//==========================================================================
			case 6:
				include("pages/listerPersonne.inc.php");
				break;
			case 7:
				include("pages/supprimerPersonne.inc.php");
				break;
			case 8:
				include("pages/infoPersonne.inc.php");
				break;
			case 9:
				include("pages/MotDePasseOubliéPersonne.inc.php");
				break;
			//==========================================================================
			// Page de Méthode
			//==========================================================================
			case 10:
		    include("pages/ajouterChapitre.inc.php");
		    break;
			case 11:
				include("pages/listerChapitre.inc.php");
				break;
			case 15:
				include("pages/listerMethode.inc.php");
				break;
			case 18:
				include("pages/detailsChapitre.inc.php");
				break;
			case 19:
				include("pages/ajouterCommentaire.inc.php");
				break;
			//==========================================================================
			// Page de Validation d'une Méthode
			//==========================================================================
			case 12:
				include("pages/validerMethode.inc.php");
			  break;
			case 13:
				include("pages/accepterMethode.inc.php");
			  break;
			case 14:
				include("pages/refuserMethode.inc.php");
			  break;
			//==========================================================================
			//	 Page de Non Accès
			//==========================================================================
			default :
			 	include_once('pages/pageInterdite.inc.php');
		}
	} else {
		switch ($page) {
			//==========================================================================
			// Page d'Accueil
			//==========================================================================
			case 0:
				include_once('pages/accueil.inc.php');
				break;
			//==========================================================================
			// Page de Connexion et de Deconnection
			//==========================================================================
			case 1:
				include("pages/connexion.inc.php");
			  break;
			case 2:
				include("pages/deconnexion.inc.php");
			  break;
			//==========================================================================
			// Page du Rubik's Cube
			//==========================================================================
			case 4:
				include("pages/rubikscube.inc.php");
				break;
			case 5:
				include("pages/ajouterImagePartition.inc.php");
				break;
			//==========================================================================
			// Page de Personne
			//==========================================================================
			case 6:
				include("pages/listerPersonne.inc.php");
				break;
			case 8:
				include("pages/infoPersonne.inc.php");
				break;
			case 17:
			  include("pages/listeMethodesParEleve.inc.php");
			  break;
			/*case 9:
				include("pages/MotDePasseOubliéPersonne.inc.php");
				break;*/
			//==========================================================================
			// Page de Méthode
			//==========================================================================
			case 10:
		    include("pages/ajouterMethode.inc.php");
		    break;
			case 11:
					include("pages/ajouterChapitre.inc.php");
					break;
			case 12:
				include("pages/ajouterMethodeSuite.inc.php");
				break;
			case 13:
				include("pages/listerMethode.inc.php");
				break;
			case 14:
				include("pages/chapitreFichier.inc.php");
				break;
			case 19:
				include("pages/modifierMethode.inc.php");
				break;
			//==========================================================================
			// Page Chapitre
			//==========================================================================
			case 14:
				include("pages/ChapitreFichier.inc.php");
				break;
			case 15:
				include("pages/ChapitreLien.inc.php");
				break;
			case 16:
				include("pages/ChapitrePartition.inc.php");
				break;
			case 18:
				include("pages/detailsChapitre.inc.php");
				break;
			//==========================================================================
			// Page de Non Accès
			//==========================================================================
			default :
			 	include_once('pages/pageInterdite.inc.php');
		}
	}
}
?>

</div>
<br/><br/>
