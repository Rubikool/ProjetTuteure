<?php
class PersonneManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($personne){
    $req = $this->db->prepare('INSERT INTO personne (per_num, per_nom, per_prenom, per_mail, per_admin, per_login, per_pwd)
      VALUES(:per_num, :per_nom, :per_prenom, :per_mail, :per_admin, :per_login, :per_pwd)');
    $req->bindValue(':per_num', $personne->getPer_num(), PDO::PARAM_STR);
    $req->bindValue(':per_nom', $personne->getPer_nom(), PDO::PARAM_STR);
    $req->bindValue(':per_prenom', $personne->getPer_prenom(), PDO::PARAM_STR);
    $req->bindValue(':per_mail', $personne->getPer_mail(), PDO::PARAM_STR);
    $req->bindValue(':per_admin', $personne->getPer_admin(), PDO::PARAM_STR);
    $req->bindValue(':per_login', $personne->getPer_login(), PDO::PARAM_STR);
    $req->bindValue(':per_pwd', $personne->getPer_pwd(), PDO::PARAM_STR);
    $req->execute();
  }

  public function getAllPersonne(){
    $listePersonne = array();
    $sql = 'SELECT per_num, per_nom, per_prenom, per_mail FROM personne
    ORDER BY per_num DESC';
    $req = $this->db->query($sql);
    while ($personne = $req->fetch(PDO::FETCH_OBJ)){
      $listePersonne[] = new Personne($personne);
    }
    return $listePersonne;
    $req->closeCursor();
  }

  public function getPersonne($per_login){
       $sql='SELECT per_num,per_nom,per_prenom,per_mail,per_admin,per_login,per_pwd FROM personne WHERE per_login=:per_login';
       $requete=$this->db->prepare($sql);
       $requete->bindValue(':per_login',$per_login,PDO::PARAM_STR);
       $requete->execute();

       return $requete->fetch(PDO::FETCH_OBJ);
     }

  public function getNbrePersonne(){
    $nbrePersonne;
    $sql = 'SELECT COUNT(*) AS nbrePersonne FROM personne';
    $req = $this->db->query($sql);
    $nbrePersonne = $req->fetch(PDO::FETCH_OBJ);
    return $nbrePersonne;
    $req->closeCursor();
  }

  public function verifNom($nom){
    $sql = 'SELECT COUNT(per_login) AS nbreLigne FROM personne WHERE per_login = \''.$nom.'\'';
    $req = $this->db->query($sql);
    $nbreLigne = $req->fetch(PDO::FETCH_OBJ);
    return $nbreLigne;
  }

  public function verifPwd($pwd, $nom){
    $crypt = Chiffrement::crypt($pwd);
    $sql = 'SELECT COUNT(per_pwd) AS nbreLigne FROM personne WHERE per_login = \''.$nom.'\' AND per_pwd = \''.$crypt.'\'';
    $req = $this->db->query($sql);
    $nbreLigne = $req->fetch(PDO::FETCH_OBJ);
    return $nbreLigne;
  }

  public function getNumPersonne($log){
    $sql = 'SELECT per_num FROM personne WHERE per_login = \''.$log.'\'';
    $req = $this->db->query($sql);
    $numPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $numPersonne;
    $req->closeCursor();
  }

  public function getNomPersonne($log){
    $sql = 'SELECT per_nom FROM personne WHERE per_login = \''.$log.'\'';
    $req = $this->db->query($sql);
    $nomPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $nomPersonne;
    $req->closeCursor();
  }

  public function getPrenomPersonne($log){
    $sql = 'SELECT per_prenom FROM personne WHERE per_login = \''.$log.'\'';
    $req = $this->db->query($sql);
    $prenomPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $prenomPersonne;
    $req->closeCursor();
  }

  public function getMailPersonne($log){
    $sql = 'SELECT per_mail FROM personne WHERE per_login = \''.$log.'\'';
    $req = $this->db->query($sql);
    $nomPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $nomPersonne;
    $req->closeCursor();
  }

  public function getAdminPersonne($log){
    $sql = 'SELECT per_admin FROM personne WHERE per_login = \''.$log.'\'';
    $req = $this->db->query($sql);
    $adminPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $adminPersonne;
    $req->closeCursor();
  }

  public function getNumPersonneAvecNom($nom){
    $sql = 'SELECT per_num FROM personne WHERE per_nom = \''.$nom.'\'';
    $req = $this->db->query($sql);
    $numPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $numPersonne;
    $req->closeCursor();
  }

  public function getLoginPersonne($num){
    $sql = 'SELECT per_login FROM personne WHERE per_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $loginPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $loginPersonne;
    $req->closeCursor();
  }

  public function getPwdPersonne($log){
    $sql = 'SELECT per_pwd FROM personne WHERE per_login = \''.$log.'\'';
    $req = $this->db->query($sql);
    $pwdPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $pwdPersonne;
    $req->closeCursor();
  }

  public function getNumMaxPersonne(){
    $sql = 'SELECT per_num FROM personne
    ORDER BY per_num DESC LIMIT 1';
    $req = $this->db->query($sql);
    $numMaxPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $numMaxPersonne;
    $req->closeCursor();
  }

  public function deletePersonne($num){
    $sql = 'DELETE FROM personne
    WHERE per_num = \''.$num.'\'';
    $req = $this->db->query($sql);
  }
}
?>
