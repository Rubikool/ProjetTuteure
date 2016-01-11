<?php

class ListePartition {
  private $par_num;
	private $mvm_num;
	private $numero;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case '$par_num' : $this->setPar_num($valeur);
          break;
        case '$mvm_num' : $this->setMvm_num($valeur);
          break;
        case 'numero' : $this->setNumero($valeur);
          break;
      }
    }
  }

  public function setPar_num($par_num){
    $this->par_num=$par_num;
  }

	public function setMvm_num($mvm_num){
		$this->mvm_num = $mvm_num;
	}

	public function setNumero($numero){
		$this->numero = $numero;
	}

  public function getPar_num(){
    return $this->par_num;
  }

	public function getMvm_num(){
		return $this->mvm_num;
	}

	public function getNumero(){
		return $this->numero;
	}
}
