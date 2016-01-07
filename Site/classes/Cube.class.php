<?php

class Cube {
	private $cub_num;
	private $cub_var1;
	private $cub_var2;
	private $cub_lettreFin;
	private $cub_taille;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'cub_var1' : $this->setCub_var1($valeur);
          break;
				case 'cub_var2' : $this->setCub_var2($valeur);
          break;
				case 'cub_lettreFin' : $this->setCub_lettreFin($valeur);
	        break;
				case 'cub_taille' : $this->setCub_taille($valeur);
	        break;
        case 'cub_num' : $this->setCub_num($valeur);
	        break;
      }
    }
  }

	public function setCub_num($cub_num){
		$this->cub_num = $cub_num;
	}

	public function setCub_var1($cub_var1){
		$this->cub_var1 = $cub_var1;
	}

  public function setCub_var2($cub_var2){
		$this->cub_var2 = $cub_var2;
	}

  public function setCub_taille($cub_taille){
		$this->cub_taille = $cub_taille;
	}

	public function setCub_lettreFin($cub_lettreFin){
		$this->cub_lettreFin = $cub_lettreFin;
	}

	public function getCub_num(){
		return $this->cub_num;
	}

	public function getCub_var1(){
		return $this->cub_var1;
	}

	public function getCub_var2(){
		return $this->cub_var2;
	}

	public function getCub_taille(){
		return $this->cub_taille;
	}

	public function getCub_lettreFin(){
		return $this->cub_lettreFin;
	}
}
