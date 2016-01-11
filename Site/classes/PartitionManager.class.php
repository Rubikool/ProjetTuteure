<?php
class PartitionManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($partition){
    $req = $this->db->prepare('INSERT INTO partition (par_num,met_num,per_num) VALUES(:par_num,:met_num, :per_num)');
    $req->bindValue(':par_num', $partition->getPar_num(), PDO::PARAM_STR);
    $req->bindValue(':met_num', $partition->getMet_num(), PDO::PARAM_STR);
    $req->bindValue(':per_num', $partition->getPer_num(), PDO::PARAM_STR);

    $req->execute();
  }

}
?>
