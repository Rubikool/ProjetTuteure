<?php

class Personne {
	private $per_num;
	private $per_nom;
	private $per_prenom;
	private $per_mail;
	private $per_admin;
	private $per_login;
	private $per_pwd;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
    foreach($donnees as $attribut => $valeur) {
      switch($attribut){
        case 'per_num' : $this->setPer_num($valeur);
          break;
        case 'per_nom' : $this->setPer_nom($valeur);
          break;
				case 'per_prenom' : $this->setPer_prenom($valeur);
	        break;
				case 'per_mail' : $this->setPer_mail($valeur);
	        break;
				case 'per_admin' : $this->setPer_admin($valeur);
	        break;
				case 'per_login' : $this->setPer_login($valeur);
	        break;
				case 'per_pwd' : $this->setPer_pwd($valeur);
	        break;
      }
    }
  }

	public function setPer_num($per_num){
		$this->per_num = $per_num;
	}

	public function setPer_nom($per_nom){
		$this->per_nom = $per_nom;
	}

	public function setPer_prenom($per_prenom){
		$this->per_prenom = $per_prenom;
	}

	public function setPer_mail($per_mail){
		$this->per_mail = $per_mail;
	}

	public function setPer_admin($per_admin){
		$this->per_admin = $per_admin;
	}

	public function setPer_login($per_login){
		$this->per_login = $per_login;
	}

  public function setPer_pwd($per_pwd){
    $this->per_pwd = $per_pwd;
  }

	public function getPer_num(){
		return $this->per_num;
	}

	public function getPer_nom(){
		return $this->per_nom;
	}

	public function getPer_prenom(){
		return $this->per_prenom;
	}

	public function getPer_mail(){
		return $this->per_mail;
	}

	public function getPer_admin(){
		return $this->per_admin;
	}

	public function getPer_login(){
		return $this->per_login;
	}

	public function getPer_pwd(){
		return $this->per_pwd;
	}
}
