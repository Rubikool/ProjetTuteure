<?php
class LienManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($lien){
    $req = $this->db->prepare('INSERT INTO lien (lien_num,cha_num,lien_adresse) VALUES(:lien_num,:cha_num, :lien_adresse)');
    $req->bindValue(':lien_num', $lien->getLien_num(), PDO::PARAM_STR);
    $req->bindValue(':cha_num', $lien->getCha_num(), PDO::PARAM_STR);
    $req->bindValue(':lien_adresse', $lien->getLien_adresse(), PDO::PARAM_STR);

    $req->execute();
  }

}
?>
