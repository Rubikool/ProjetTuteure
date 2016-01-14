<?php
class MouvementManager {
  private $db;
  public function __construct($db){
    $this->db = $db;
  }
  public function add($mouvement){
    $req = $this->db->prepare('INSERT INTO mouvement (mvm_num, mouvement, cub_taille) VALUES(:mvm_num, :mouvement, :cub_taille)');
    $req->bindValue(':mvm_num', $mouvement->getMvm_num(), PDO::PARAM_STR);
    $req->bindValue(':mouvement', $mouvement->getMouvement(), PDO::PARAM_STR);
    $req->bindValue(':cub_taille', $mouvement->getCub_taille(), PDO::PARAM_STR);
    $req->execute();
  }
  public function getAllMouvementParTaille($cub_taille){
    $listeMouvements = array();
    $sql='SELECT mvm_num,mouvement FROM mouvement
          WHERE cub_taille = :cub_taille';
    $requete=$this->db->prepare($sql);
    $requete->bindValue(':cub_taille',$cub_taille, PDO::PARAM_STR);
    $requete->execute();
    while($Mouvement = $requete->fetch(PDO::FETCH_OBJ)){
      $listeMouvements[] = new Mouvement($Mouvement);
    }
    return $listeMouvements;
    $requete->closeCursor();
  }
}
?>
