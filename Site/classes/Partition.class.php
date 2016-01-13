<?php

class Partition {
  private $par_num;
	private $met_num;
	private $per_num;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'par_num' : $this->setPar_num($valeur);
          break;
        case 'cha_num' : $this->setCha_num($valeur);
          break;
        case 'per_num' : $this->setPer_num($valeur);
          break;
      }
    }
  }

  public function setPar_num($par_num){
    $this->par_num=$par_num;
  }

	public function setCha_num($met_num){
		$this->cha_num = $cha_num;
	}

	public function setPer_num($per_num){
		$this->per_num = $per_num;
	}

  public function getPar_num(){
    return $this->par_num;
  }

	public function getCha_num(){
		return $this->cha_num;
	}

	public function getPer_num(){
		return $this->per_num;
	}
}
