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

}
?>
