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
    $req->bindValue(':cha_description', $chapitre->getCha_description(), PDO::PARAM_STR);
    $req->bindValue(':cha_nom', $chapitre->getCha_nom(), PDO::PARAM_STR);
    $req->bindValue(':cha_valide', $chapitre->getCha_valide(), PDO::PARAM_STR);
    $req->bindValue(':per_num_valide', $chapitre->getPer_num_valide(), PDO::PARAM_STR);
    $req->bindValue(':met_num', $chapitre->getMet_num(), PDO::PARAM_STR);

    $req->execute();
  }

  public function getAllChapitreParMethode($met_num){
    $listeChapitres=array();
    $sql='SELECT cha_num,cha_description,cha_nom,cha_valide,per_num_valide,chapitre.met_num FROM chapitre
    INNER JOIN methode ON chapitre.met_num = methode.met_num WHERE chapitre.met_num=:met_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num',$met_num,PDO::PARAM_STR);
    $requete->execute();

    while($chapitres=$requete->fetch(PDO::FETCH_OBJ)){
            $listeChapitres[]=new Chapitre($chapitres);
          }

      return $listeChapitres;
      $requete->closeCursor();
  }

  public function getNumChapitreMax(){
    $sql='SELECT MAX(cha_num) FROM chapitre';
    $requete=$this->db->prepare($sql);
    $requete->execute();

    return $requete->fetchCOLUMN();
  }


}
?>
