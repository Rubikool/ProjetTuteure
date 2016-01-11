<?php
class ChapitreManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($chapitre){
    $req = $this->db->prepare('INSERT INTO chapitre (cha_num, cha_description, cha_nom, cha_valide,
      per_num_valide, met_num) VALUES(:cha_num, :cha_description,
      :cha_nom, :cha_valide, :per_num_valide, :met_num)');
    $req->bindValue(':cha_num', $chapitre->getCha_num(), PDO::PARAM_STR);
    $req->bindValue(':cha_description', $chapitre->getcha_description(), PDO::PARAM_STR);
    $req->bindValue(':cha_nom', $chapitre->getCha_nom(), PDO::PARAM_STR);
    $req->bindValue(':cha_valide', $chapitre->getCha_valide(), PDO::PARAM_STR);
    $req->bindValue(':per_num_valide', $chapitre->getPer_num_valide(), PDO::PARAM_STR);
    $req->bindValue(':met_num', $chapitre->getMet_num(), PDO::PARAM_STR);

    $req->execute();
  }



}
?>
