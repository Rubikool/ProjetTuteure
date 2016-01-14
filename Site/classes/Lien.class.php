<?php
class Lien {
  private $lien_num;
	private $met_num;
	private $lien_adresse;
	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}
	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'lien_num' : $this->setLien_num($valeur);
          break;
        case 'met_num' : $this->setMet_num($valeur);
          break;
        case 'lien_adresse' : $this->setLien_adresse($valeur);
          break;
      }
    }
  }
  public function setLien_num($lien_num){
    $this->lien_num=$lien_num;
  }
	public function setMet_num($met_num){
		$this->met_num = $met_num;
	}
	public function setLien_adresse($lien_adresse){
		$this->lien_adresse = $lien_adresse;
	}
  public function getLien_num(){
    return $this->lien_num;
  }
	public function getMet_num(){
		return $this->met_num;
	}
	public function getLien_adresse(){
		return $this->lien_adresse;
	}
}
