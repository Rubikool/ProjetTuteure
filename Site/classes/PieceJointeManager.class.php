<?php
class PieceJointeManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($lien){
    $req = $this->db->prepare('INSERT INTO piecejointe (pie_num,met_num,lien_fichier) VALUES(:pie_num,:met_num, :lien_fichier)');
    $req->bindValue(':pie_num', $lien->getPie_num(), PDO::PARAM_STR);
    $req->bindValue(':met_num', $lien->getMet_num(), PDO::PARAM_STR);
    $req->bindValue(':lien_fichier', $lien->getLien_fichier(), PDO::PARAM_STR);

    $req->execute();
  }

  public function getPieceJointeByChapitre($met_num){

    $sql='SELECT pie_num, lien_fichier FROM piecejointe
          WHERE met_num = :met_num';
          $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num', $met_num, PDO::PARAM_STR);
    $requete->execute();

    return $requete->fetch(PDO::FETCH_OBJ);
  }

  public function getAllPieceJointeParMethode($met_num){
    $listePiJo=array();
    $sql='SELECT pie_num,lien_fichier FROM piecejointe
          WHERE met_num = :met_num';
          $requete=$this->db->prepare($sql);
    $requete->bindValue(':met_num', $met_num, PDO::PARAM_STR);
    $requete->execute();

    while($PiJo=$requete->fetch(PDO::FETCH_OBJ)){
            $listePiJo[]=new PieceJointe($PiJo);
          }

      return $listePiJo;
      $requete->closeCursor();
  }

  public function getNumPiJoMax(){
    $sql='SELECT MAX(pie_num) FROM piecejointe';
    $requete=$this->db->prepare($sql);
    $requete->execute();

    return $requete->fetchCOLUMN();
  }
}
?>
