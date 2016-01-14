<?php

class Partition {
  private $par_num;
  private $par_nom;
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
        case 'par_nom' : $this->setPar_nom($valeur);
          break;
        case 'met_num' : $this->setMet_num($valeur);
          break;
        case 'per_num' : $this->setPer_num($valeur);
          break;
      }
    }
  }

  public function setPar_num($par_num){
    $this->par_num=$par_num;
  }

  public function setPar_nom($par_nom){
    $this->par_nom=$par_nom;
  }

	public function setMet_num($met_num){
		$this->met_num = $met_num;
	}

	public function setPer_num($per_num){
		$this->per_num = $per_num;
	}

  public function getPar_num(){
    return $this->par_num;
  }

  public function getPar_nom(){
    return $this->par_nom;
  }

	public function getMet_num(){
		return $this->met_num;
	}

	public function getPer_num(){
		return $this->per_num;
	}
}
