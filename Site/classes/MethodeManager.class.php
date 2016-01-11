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
    $sql = 'SELECT met_num, per_num, met_date, met_description, cub_taille,met_nom FROM methode';
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

  public function getMethodeLastID(){
    $sql='SELECT LAST_INSERT_ID() FROM methode';
    $requete=$this->db->prepare($sql);
    $requete->execute();

    return $requete->fetchCOLUMN();
  }

  public function getNumMethodeParNom($met_nom){
    $sql='SELECT met_num FROM methode WHERE met_nom=:met_nom';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_nom',$met_nom,PDO::PARAM_STR);
    $requete->execute();

    return $requete->fetchCOLUMN();
  }
}
?>
