<?php
class MethodeManager {
  private $db;
  public function __construct($db){
    $this->db = $db;
  }
  
  public function add($methode){
    $req = $this->db->prepare('INSERT INTO methode (met_num, per_num, met_date, met_description,
      cub_taille, met_nom, met_commentaire) VALUES(:met_num, :per_num,
      :met_date, :met_description, :cub_taille, :met_nom, :met_commentaire)');
    $req->bindValue(':met_num', $methode->getMet_num(), PDO::PARAM_STR);
    $req->bindValue(':per_num', $methode->getPer_num(), PDO::PARAM_STR);
    $req->bindValue(':met_date', $methode->getMet_date(), PDO::PARAM_STR);
    $req->bindValue(':met_description', $methode->getMet_description(), PDO::PARAM_STR);
    $req->bindValue(':cub_taille', $methode->getCub_taille(), PDO::PARAM_STR);
    $req->bindValue(':met_nom', $methode->getMet_nom(), PDO::PARAM_STR);
    $req->bindValue(':met_commentaire', $methode->getMet_commentaire(), PDO::PARAM_STR);
    $req->execute();
  }

  public function getAllMethode(){
    $listeMethodes = array();
    $sql = 'SELECT met_num, per_num, met_date, met_description, cub_taille,met_nom,met_commentaire FROM methode WHERE met_valide = 1';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($methode = $req->fetch(PDO::FETCH_OBJ)){
      $listeMethodes[] = new Methode($methode);
    }
    return $listeMethodes;
    $req->closeCursor();
  }

  public function getAllMethodeParUti($per_num){
  $listeMethodes = array();
  $sql = 'SELECT met_num, per_num, met_date, met_description, cub_taille,met_nom,met_commentaire FROM methode WHERE per_num=:per_num';
  $req = $this->db->prepare($sql);
  $req -> bindValue(':per_num',$per_num,PDO::PARAM_STR);
  $req->execute();
  while ($methode = $req->fetch(PDO::FETCH_OBJ)){
    $listeMethodes[] = new Methode($methode);
  }
  return $listeMethodes;
  $req->closeCursor();
  }
  public function getAllMethodeNonValide(){
    $listeMethodes = array();
    $sql = 'SELECT met_num, per_num, met_date, met_description, cub_taille, met_nom,met_commentaire FROM methode
      WHERE met_valide = 0';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($methode = $req->fetch(PDO::FETCH_OBJ)){
      $listeMethodes[] = new Methode($methode);
    }
    return $listeMethodes;
    $req->closeCursor();
  }
  public function getMethodeParPersonne($per_num){
    $sql='SELECT met_num,per_num,met_date,met_description,cub_taille,met_nom,met_commentaire FROM methode
          WHERE per_num=:per_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':per_num',$per_num, PDO::PARAM_STR);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_OBJ);
  }
  public function getMethode($met_num){
    $sql='SELECT per_num,met_date,met_description,cub_taille,met_nom,met_commentaire FROM methode
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
  public function getCubTailleMethodeParNum($met_num){
    $sql='SELECT cub_taille FROM methode WHERE met_num=:met_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num',$met_num,PDO::PARAM_STR);
    $requete->execute();
    return $requete->fetchCOLUMN();
  }
  public function getDescriptionMethodeParNum($met_num){
    $sql='SELECT met_description FROM methode WHERE met_num=:met_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num',$met_num,PDO::PARAM_STR);
    $requete->execute();
    return $requete->fetchCOLUMN();
  }
  public function getNumMethodeMax(){
    $sql='SELECT MAX(met_num) FROM methode';
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
  public function updateMethode($met_valide,$met_num){
    $sql='UPDATE methode SET met_valide=:met_valide WHERE met_num=:met_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num',$met_num,PDO::PARAM_STR);
    $requete->bindValue(':met_valide',$met_valide,PDO::PARAM_INT);
    $requete->execute();
  }
  public function updateCommentaireMethode($met_num,$commentaire){
    $sql='UPDATE methode SET met_commentaire=:met_commentaire WHERE met_num=:met_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num',$met_num,PDO::PARAM_STR);
    $requete->bindValue(':met_commentaire',$commentaire,PDO::PARAM_INT);
    $requete->execute();
  }
}
?>
