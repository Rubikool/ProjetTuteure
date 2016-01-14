<?php
class CubeManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($cube){
    $req = $this->db->prepare('INSERT INTO cube (cub_num, cub_etat, cub_taille, per_num)
      VALUES(:cub_num, :cub_etat, :cub_taille, :per_num)');
    $req->bindValue(':cub_num', $cube->getCub_num(), PDO::PARAM_STR);
    $req->bindValue(':cub_etat', $cube->getCub_etat(), PDO::PARAM_STR);
    $req->bindValue(':cub_taille', $cube->getCub_taille(), PDO::PARAM_STR);
    $req->bindValue(':per_num', $cube->getPer_num(), PDO::PARAM_STR);
    $req->execute();
  }

  public function getCube(){
    $listeCubes = array();
    $sql = 'SELECT cub_num, cub_etat, cub_taille, per_num FROM cube';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($cube = $req->fetch(PDO::FETCH_OBJ)){
      $listeCubes[] = new Cube($cube);
    }
    return $listeCubes;
    $req->closeCursor();
  }

  public function getCubeByPersonne($per_num){
    $listeCubes = array();
    $sql = 'SELECT cub_num, cub_etat, cub_taille, per_num FROM cube
      WHERE per_num=:per_num';
    $req = $this->db->prepare($sql);
    $requete->bindValue(':per_num', $per_num, PDO::PARAM_STR);
    $req->execute();
    while ($cube = $req->fetch(PDO::FETCH_OBJ)){
      $listeCubes[] = new Cube($cube);
    }
    return $listeCubes;
    $req->closeCursor();
  }

  public function getCubeById($cub_num){
    $listeCubes = array();
    $sql = 'SELECT cub_num, cub_etat, cub_taille, per_num FROM cube
      WHERE cub_num=:cub_num';
    $req = $this->db->prepare($sql);
    $requete->bindValue(':per_num', $per_num, PDO::PARAM_STR);
    $req->execute();
    while ($cube = $req->fetch(PDO::FETCH_OBJ)){
      $listeCubes[] = new Cube($cube);
    }
    return $listeCubes;
    $req->closeCursor();
  }

  public function getNbreCube(){
    $sql="SELECT COUNT(*) AS nbreCube FROM cube
      ORDER BY cub_num DESC LIMIT 1";
    $req = $this->db->query($sql);
    $nbreCube = $req->fetch(PDO::FETCH_OBJ);
    return $nbreCube;
    $req->closeCursor();
  }

  public function getNumMaxCube(){
    $sql = 'SELECT cub_num FROM cube
      ORDER BY cub_num DESC LIMIT 1';
    $req = $this->db->query($sql);
    $cubeNum = $req->fetch(PDO::FETCH_OBJ);
    return $cubeNum;
    $req->closeCursor();
  }

  public function viderCube(){
    while($this->getNbreCube()->nbreCube != 0){
      $sql = 'DELETE FROM cube WHERE cub_num = '.$this->getNumMaxCube()->cub_num;
      $req = $this->db->query($sql);
    }
  }
}
?>
