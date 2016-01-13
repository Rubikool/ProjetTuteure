<?php
class PartitionManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($partition){
    $req = $this->db->prepare('INSERT INTO partition (par_num,cha_num,per_num) VALUES(:par_num,:cha_num, :per_num)');
    $req->bindValue(':par_num', $partition->getPar_num(), PDO::PARAM_STR);
    $req->bindValue(':cha_num', $partition->getCha_num(), PDO::PARAM_STR);
    $req->bindValue(':per_num', $partition->getPer_num(), PDO::PARAM_STR);

    $req->execute();
  }

  public function getPartitionByPersonne($per_num){
    $sql='SELECT par_num FROM partition
          WHERE per_num = :per_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':per_num', $per_num, PDO::PARAM_STR);
    $requete->execute();

    return $requete->fetch(PDO::FETCH_OBJ);
  }
}
?>
