<?php
class MouvementManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($chapitre){
    $req = $this->db->prepare('INSERT INTO mouvement (mvm_num, mouvement,cub_taille) VALUES(:mvm_num, :mouvement,:cub_taille)');
    $req->bindValue(':mvm_num', $chapitre->getMvm_num(), PDO::PARAM_STR);
    $req->bindValue(':mouvement', $chapitre->getMouvement(), PDO::PARAM_STR);
    $req->bindValue(':cub_taille', $chapitre->getCub_taille(), PDO::PARAM_STR);

    $req->execute();
  }

}
?>
