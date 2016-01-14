<?php

class Chapitre {
	private $cha_num;
	private $cha_description;
	private $cha_nom;
	private $met_description;
	private $cha_valide;
	private $met_num;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'cha_num' : $this->setCha_num($valeur);
          break;
        case 'cha_description' : $this->setCha_description($valeur);
          break;
				case 'cha_nom' : $this->setCha_nom($valeur);
	        break;
				case 'met_description' : $this->setMet_description($valeur);
	        break;
				case 'cha_valide' : $this->setCha_valide($valeur);
	        break;
				case 'met_num' : $this->setMet_num($valeur);
	        break;
      }
    }
  }

	public function setCha_num($cha_num){
		$this->cha_num = $cha_num;
	}

	public function setCha_description($cha_description){
		$this->cha_description = $cha_description;
	}

	public function setPer_num_valide($per_num_valide){
		$this->per_num_valide = $per_num_valide;
	}

	public function setCha_nom($cha_nom){
		$this->cha_nom = $cha_nom;
	}

	public function setCha_valide($cha_valide){
		$this->cha_valide = $cha_valide;
	}

	public function setMet_num($met_num){
		$this->met_num = $met_num;
	}

	public function getCha_num(){
		return $this->cha_num;
	}

	public function getCha_description(){
		return $this->cha_description;
	}

	public function getPer_num_valide(){
		return $this->per_num_valide;
	}

	public function getCha_nom(){
		return $this->cha_nom;
	}

	public function getCha_valide(){
		return $this->cha_valide;
	}

	public function getMet_num(){
		return $this->met_num;
	}

}
