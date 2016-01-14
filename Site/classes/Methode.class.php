<?php

class Methode {
	private $met_num;
	private $per_num;
	private $met_date;
	private $met_description;
	private $met_valide;
	private $cub_taille;
	private $met_nom;
	private $met_commentaire;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'met_num' : $this->setMet_num($valeur);
          break;
        case 'per_num' : $this->setPer_num($valeur);
          break;
				case 'met_date' : $this->setMet_date($valeur);
	        break;
				case 'met_description' : $this->setMet_description($valeur);
	        break;
				case 'met_valide' : $this->setMet_valide();
					break;
				case 'cub_taille' : $this->setCub_taille($valeur);
	        break;
				case 'met_nom' : $this->setMet_nom($valeur);
	        break;
				case 'met_commentaire' : $this->setMet_commentaire($valeur);
					break;
      }
    }
  }

	public function setMet_num($met_num){
		$this->met_num = $met_num;
	}

	public function setPer_num($per_num){
		$this->per_num = $per_num;
	}

	public function setMet_description($met_description){
		$this->met_description = $met_description;
	}

	public function setMet_valide($met_valide){
		$this->met_valide = $met_valide;
	}

	public function setMet_date($met_date){
		$this->met_date = $met_date;
	}

	public function setCub_taille($cub_taille){
		$this->cub_taille = $cub_taille;
	}

	public function setMet_nom($met_nom){
		$this->met_nom = $met_nom;
	}

	public function setMet_commentaire($met_commentaire){
		$this->met_commentaire = $met_commentaire;
	}

	public function getMet_num(){
		return $this->met_num;
	}

	public function getPer_num(){
		return $this->per_num;
	}

	public function getMet_description(){
		return $this->met_description;
	}

	public function getMet_valide(){
		return $this->met_valide;
	}

	public function getMet_date(){
		return $this->met_date;
	}

	public function getCub_taille(){
		return $this->cub_taille;
	}

	public function getMet_nom(){
		return $this->met_nom;
	}

	public function getMet_commentaire(){
		return $this->met_commentaire;
	}

}
