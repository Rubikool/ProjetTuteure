<?php
class PieceJointeManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($lien){
    $req = $this->db->prepare('INSERT INTO piecejointe (pie_num,cha_num,lien_fichier) VALUES(:pie_num,:cha_num, :lien_fichier)');
    $req->bindValue(':pie_num', $lien->getPie_num(), PDO::PARAM_STR);
    $req->bindValue(':cha_num', $lien->getCha_num(), PDO::PARAM_STR);
    $req->bindValue(':lien_fichier', $lien->getLien_fichier(), PDO::PARAM_STR);

    $req->execute();
  }

}
?>
