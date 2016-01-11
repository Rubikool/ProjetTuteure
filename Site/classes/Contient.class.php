<?php

class Contient {
	private $cha_num;
	private $par_num;

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
        case 'par_num' : $this->setPar_num($valeur);
          break;
      }
    }
  }

	public function setCha_num($cha_num){
		$this->cha_num = $cha_num;
	}

	public function setPar_num($par_num){
		$this->par_num = $par_num;
	}

	public function getCha_num(){
		return $this->cha_num;
	}

	public function getPar_num(){
		return $this->par_num;
	}
}
