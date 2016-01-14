<?php

class Cube {
	private $cub_num;
	private $cub_etat;
	private $cub_taille;
	private $per_num;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'cub_num' : $this->setCub_num($valeur);
          break;
				case 'cub_etat' : $this->setCub_etat($valeur);
          break;
				case 'cub_taille' : $this->setCub_taille($valeur);
	        break;
        case 'per_num' : $this->setPer_num($valeur);
	        break;
      }
    }
  }

	public function setCub_num($cub_num){
		$this->cub_num = $cub_num;
	}

	public function setCub_etat($cub_etat){
		$this->cub_etat = $cub_etat;
	}

	public function setCub_taille($cub_taille){
		$this->cub_taille = $cub_taille;
	}

  public function setPer_num($per_num){
		$this->per_num = $per_num;
	}

	public function getCub_num(){
		return $this->cub_num;
	}

	public function getCub_etat(){
		return $this->cub_etat;
	}

	public function getCub_taille(){
		return $this->cub_taille;
	}

	public function getPer_num(){
		return $this->per_num;
	}
}
