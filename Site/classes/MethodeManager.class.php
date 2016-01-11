<?php
class MethodeManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($methode){
    $req = $this->db->prepare('INSERT INTO methode (met_num, per_num, met_date, met_description,
      cub_taille, met_nom) VALUES(:met_num, :per_num,
      :met_date, :met_description, :cub_taille, :met_nom)');
    $req->bindValue(':met_num', $methode->getMet_num(), PDO::PARAM_STR);
    $req->bindValue(':per_num', $methode->getPer_num(), PDO::PARAM_STR);
    $req->bindValue(':met_date', $methode->getMet_date(), PDO::PARAM_STR);
    $req->bindValue(':met_description', $methode->getMet_description(), PDO::PARAM_STR);
    $req->bindValue(':cub_taille', $methode->getCub_taille(), PDO::PARAM_STR);
    $req->bindValue(':met_nom', $methode->getMet_nom(), PDO::PARAM_STR);

    $req->execute();
  }

  public function getAllMethode(){
    $listeMethodes = array();
    $sql = 'SELECT cit_num, per_num, cit_libelle, cit_date_valide FROM methode
      WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL
      ORDER BY cit_date DESC LIMIT 2';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($methode = $req->fetch(PDO::FETCH_OBJ)){
      $listeMethodes[] = new Methode($methode);
    }
    return $listeMethodes;
    $req->closeCursor();
  }

  public function getMethodeNonValide(){
    $listeMethodes = array();
    $sql = 'SELECT cit_num, per_num, cit_libelle, cit_date_valide FROM methode
      WHERE cit_valide = 0 AND cit_date_valide IS NULL
      ORDER BY cit_date DESC';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($methode = $req->fetch(PDO::FETCH_OBJ)){
      $listeMethodes[] = new Methode($methode);
    }
    return $listeMethodes;
    $req->closeCursor();
  }


  public function getMethodeParPersonne($per_num){
    $sql='SELECT met_num,per_num,met_date,met_description,cub_taille,met_nom FROM methode
          WHERE per_num=:per_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':per_num',$per_num, PDO::PARAM_STR);
    $requete->execute();

    return $requete->fetch(PDO::FETCH_OBJ);
  }

  public function getMethode($met_num){
    $sql='SELECT per_num,met_date,met_description,cub_taille,met_nom FROM methode
          WHERE met_num=:met_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num',$met_num, PDO::PARAM_STR);
    $requete->execute();

    return $requete->fetch(PDO::FETCH_OBJ);
  }

  public function getNomMethodeParNum($met_num){
    $sql='SELECT met_nom FROM methode WHERE met_num=:met_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num',$met_num,PDO::PARAM_STR);
    $requete->execute();

    return $requete->fetchCOLUMN();
  }
}
?>
