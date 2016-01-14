<?php
class ListePartitionManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($listePartition){
    $req = $this->db->prepare('INSERT INTO listepartition (par_num,mvm_num,numero) VALUES(:par_num,:mvm_num, :numero)');
    $req->bindValue(':par_num', $listePartition->getPar_num(), PDO::PARAM_STR);
    $req->bindValue(':mvm_num', $listePartition->getMvm_num(), PDO::PARAM_STR);
    $req->bindValue(':numero', $listePartition->getNumero(), PDO::PARAM_STR);

    $req->execute();
  }

  public function getMouvementByPartition($par_num){
    $sql='SELECT mvm_num, numero FROM listepartition
          WHERE par_num = :num
          ORDER BY numero';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':num',$par_num, PDO::PARAM_STR);
    $requete->execute();

    return $requete->fetch(PDO::FETCH_OBJ);
  }
}
?>
