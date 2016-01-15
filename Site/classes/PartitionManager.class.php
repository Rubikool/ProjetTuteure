<?php
class PartitionManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($partition){
    $req = $this->db->prepare('INSERT INTO partition (par_num,par_nom,met_num,per_num) VALUES(:par_num,:par_nom,:met_num, :per_num)');
    $req->bindValue(':par_num', $partition->getPar_num(), PDO::PARAM_STR);
    $req->bindValue(':par_nom', $partition->getPar_nom(), PDO::PARAM_STR);
    $req->bindValue(':met_num', $partition->getMet_num(), PDO::PARAM_STR);
    $req->bindValue(':per_num', $partition->getPer_num(), PDO::PARAM_STR);

    $req->execute();
  }

  public function getPartitionByPersonne($per_num){
    $sql='SELECT par_num FROM partition
          WHERE per_num = :num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':num', $per_num, PDO::PARAM_STR);
    $requete->execute();

    return $requete->fetch(PDO::FETCH_OBJ);
  }

  public function deletePartition($par_num){
    $sql='DELETE FROM partition WHERE par_num=:par_num';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':par_num',$par_num,PDO::PARAM_STR);
    $requete->execute();
  }

}
?>
