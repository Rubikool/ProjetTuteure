<?php

class Citation {
	private $cit_num;
	private $per_num;
	private $per_num_valide;
	private $per_num_etu;
	private $cit_libelle;
	private $cit_date;
	private $cit_valide;
	private $cit_date_valide;
	private $cit_date_depo;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'cit_num' : $this->setCit_num($valeur);
          break;
        case 'per_num' : $this->setPer_num($valeur);
          break;
				case 'per_num_valide' : $this->setPer_num_valide($valeur);
	        break;
				case 'per_num_etu' : $this->setPer_num_etu($valeur);
	        break;
				case 'cit_libelle' : $this->setCit_libelle($valeur);
	        break;
				case 'cit_date' : $this->setCit_date($valeur);
	        break;
				case 'cit_valide' : $this->setCit_valide($valeur);
	        break;
				case 'cit_date_valide' : $this->setCit_date_valide($valeur);
	        break;
				case 'cit_date_depo' : $this->setCit_date_depo($valeur);
	        break;
      }
    }
  }

	public function setCit_num($cit_num){
		$this->cit_num = $cit_num;
	}

	public function setPer_num($per_num){
		$this->per_num = $per_num;
	}

	public function setPer_num_valide($per_num_valide){
		$this->per_num_valide = $per_num_valide;
	}

	public function setPer_num_etu($per_num_etu){
		$this->per_num_etu = $per_num_etu;
	}

	public function setCit_libelle($cit_libelle){
		$this->cit_libelle = $cit_libelle;
	}

	public function setCit_date($cit_date){
		$this->cit_date = $cit_date;
	}

	public function setCit_valide($cit_valide){
		$this->cit_valide = $cit_valide;
	}

	public function setCit_date_valide($cit_date_valide){
		$this->cit_date_valide = $cit_date_valide;
	}

	public function setCit_date_depo($cit_date_depo){
		$this->cit_date_depo = $cit_date_depo;
	}

	public function getCit_num(){
		return $this->cit_num;
	}

	public function getPer_num(){
		return $this->per_num;
	}

	public function getPer_num_valide(){
		return $this->per_num_valide;
	}

	public function getPer_num_etu(){
		return $this->per_num_etu;
	}

	public function getCit_libelle(){
		return $this->cit_libelle;
	}

	public function getCit_date(){
		return $this->cit_date;
	}

	public function getCit_valide(){
		return $this->cit_valide;
	}

	public function getCit_date_valide(){
		return $this->cit_date_valide;
	}

	public function getCit_date_depo(){
		return $this->cit_date_depo;
	}
}
