<?php
class LienManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($lien){
    $req = $this->db->prepare('INSERT INTO lien (lien_num,met_num,lien_adresse) VALUES(:lien_num,:met_num, :lien_adresse)');
    $req->bindValue(':lien_num', $lien->getLien_num(), PDO::PARAM_STR);
    $req->bindValue(':met_num', $lien->getMet_num(), PDO::PARAM_STR);
    $req->bindValue(':lien_adresse', $lien->getLien_adresse(), PDO::PARAM_STR);

    $req->execute();
  }


  public function getAllLienParMethode($met_num){
    $listeLiens=array();
    $sql='SELECT lien_num, lien_adresse FROM lien
          WHERE met_num = :met_num';
          $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num', $met_num, PDO::PARAM_STR);
    $requete->execute();

    while($liens=$requete->fetch(PDO::FETCH_OBJ)){
            $listeLiens[]=new Lien($liens);
          }

      return $listeLiens;
      $requete->closeCursor();
  }


  public function getLienByChapitre($met_num){
    $sql='SELECT lien_num, lien_adresse FROM lien
          WHERE met_num = :num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':num', $met_num, PDO::PARAM_STR);

    $requete->execute();

    return $requete->fetch(PDO::FETCH_OBJ);
  }

  public function getNumLienMax(){
    $sql='SELECT MAX(lien_num) FROM lien';
    $requete=$this->db->prepare($sql);
    $requete->execute();

    return $requete->fetchCOLUMN();
  }
}
?>
