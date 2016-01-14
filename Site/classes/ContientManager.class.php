<?php
class ContientManager {

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

  public function getAllPartitionParChapitre($cha_num){
    $listePartitions = array();
    $sql = 'SELECT partition.par_num,par_nom,met_num,per_num FROM `partition`
            INNER JOIN contient ON partition.par_num=contient.par_num
            WHERE cha_num=:cha_num';
    $req = $this->db->prepare($sql);
    $req -> bindValue(':cha_num',$cha_num,PDO::PARAM_STR);
    $req->execute();

    while ($partition = $req->fetch(PDO::FETCH_OBJ)){
      $listePartitions[] = new Partition($partition);
    }
    return $listePartitions;
    $req->closeCursor();
  }

}
?>
