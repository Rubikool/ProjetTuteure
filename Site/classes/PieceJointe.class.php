<?php
class PieceJointe {
  private $pie_num;
	private $met_num;
	private $lien_fichier;
	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}
	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'pie_num' : $this->setPie_num($valeur);
          break;
        case 'met_num' : $this->setMet_num($valeur);
          break;
        case 'lien_fichier' : $this->setLien_fichier($valeur);
          break;
      }
    }
  }
  public function setPie_num($pie_num){
    $this->pie_num=$pie_num;
  }
	public function setMet_num($met_num){
		$this->met_num = $met_num;
	}
	public function setLien_fichier($lien_fichier){
		$this->lien_fichier = $lien_fichier;
	}
  public function getPie_num(){
    return $this->pie_num;
  }
	public function getMet_num(){
		return $this->met_num;
	}
	public function getLien_fichier(){
		return $this->lien_fichier;
	}
}
