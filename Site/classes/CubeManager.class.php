<?php
class CubeManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($cube){
    $req = $this->db->prepare('INSERT INTO cube (cub_var1, cub_var2, cub_lettreFin, cub_taille, cub_num)
      VALUES(:cub_var1, :cub_var2, :cub_lettreFin, :cub_taille, :cub_num)');
    $req->bindValue(':cub_var1', $cube->getCub_var1(), PDO::PARAM_STR);
    $req->bindValue(':cub_var2', $cube->getCub_var2(), PDO::PARAM_STR);
    $req->bindValue(':cub_lettreFin', $cube->getCub_lettreFin(), PDO::PARAM_STR);
    $req->bindValue(':cub_taille', $cube->getCub_taille(), PDO::PARAM_STR);
    $req->bindValue(':cub_num', $cube->getCub_num(), PDO::PARAM_STR);
    $req->execute();
  }

  public function getCube(){
    $listeCubes = array();
    $sql = 'SELECT cub_num, cub_var1, cub_var2, cub_lettreFin, cub_taille FROM cube';
    $req = $this->db->prepare($sql);
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
