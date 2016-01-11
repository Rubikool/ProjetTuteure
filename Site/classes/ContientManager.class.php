<?php
class ChapitreManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($chapitre){
    $req = $this->db->prepare('INSERT INTO contient (cha_num, par_num) VALUES(:cha_num, :par_num)');
    $req->bindValue(':cha_num', $chapitre->getCha_num(), PDO::PARAM_STR);
    $req->bindValue(':par_num', $chapitre->getPar_num(), PDO::PARAM_STR);

    $req->execute();
  }

  public function getPartitionByChapitre($cha_num){
    $sql='SELECT par_num FROM contient
          WHERE cha_num = :num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':num', $cha_num, PDO::PARAM_STR);
    $requete->execute();

    return $requete->fetch(PDO::FETCH_OBJ);
  }
}
?>
