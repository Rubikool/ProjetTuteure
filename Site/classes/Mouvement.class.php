<?php

class Mouvement {
	private $mvm_num;
	private $mouvement;
	private $cub_taille;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'mvm_num' : $this->setMvm_num($valeur);
          break;
        case 'mouvement' : $this->setMouvement($valeur);
          break;
				case 'cub_taille' : $this->setCub_taille($valeur);
					break;
      }
    }
  }

	public function setMvm_num($mvm_num){
		$this->mvm_num = $mvm_num;
	}

	public function setMouvement($mouvement){
		$this->mouvement = $mouvement;
	}

	public function setCub_taille($cub_taille){
		$this->cub_taille=$cub_taille;
	}

	public function getMvm_num(){
		return $this->mvm_num;
	}

	public function getMouvement(){
		return $this->mouvement;
	}

	public function getCub_taille(){
		return $this->cub_taille;
	}

}
