<?php
class MethodeManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($methode){
    $req = $this->db->prepare('INSERT INTO methode (met_num, per_num, met_date, met_description,
      cub_taille, met_nom) VALUES(:met_num, :per_num,
      :met_date, :met_description, :cub_taille, :met_nom)');
    $req->bindValue(':met_num', $methode->getMet_num(), PDO::PARAM_STR);
    $req->bindValue(':per_num', $methode->getPer_num(), PDO::PARAM_STR);
    $req->bindValue(':met_date', $methode->getMet_date(), PDO::PARAM_STR);
    $req->bindValue(':met_description', $methode->getMet_description(), PDO::PARAM_STR);
    $req->bindValue(':cub_taille', $methode->getCub_taille(), PDO::PARAM_STR);
    $req->bindValue(':met_nom', $methode->getMet_nom(), PDO::PARAM_STR);

    $req->execute();
  }

  public function getMethode(){
    $listeMethodes = array();
    $sql = 'SELECT cit_num, per_num, cit_libelle, cit_date_valide FROM methode
      WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL
      ORDER BY cit_date DESC LIMIT 2';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($methode = $req->fetch(PDO::FETCH_OBJ)){
      $listeMethodes[] = new Methode($methode);
    }
    return $listeMethodes;
    $req->closeCursor();
  }

  public function getMethodeNonValide(){
    $listeMethodes = array();
    $sql = 'SELECT cit_num, per_num, cit_libelle, cit_date_valide FROM methode
      WHERE cit_valide = 0 AND cit_date_valide IS NULL
      ORDER BY cit_date DESC';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($methode = $req->fetch(PDO::FETCH_OBJ)){
      $listeMethodes[] = new Methode($methode);
    }
    return $listeMethodes;
    $req->closeCursor();
  }

  public function getNbreMethode(){
    $nbreMethode;
    $sql = 'SELECT COUNT(*) AS nbreMethode FROM methode WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL';
    $req = $this->db->prepare($sql);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
    $req->closeCursor();
  }

  public function getNomEnseignant($per_num){
    $sql = 'SELECT CONCAT(per_prenom, per_nom) AS nomEnseignant FROM personne WHERE per_num = :per_num';
    $req = $this->db->prepare($sql);
    $req->bindValue(':per_num',$per_num,PDO::PARAM_INT);
    $req->execute();
    return $req->fetchCOLUMN();
    $req->closeCursor();
  }

  public function getMoyenne($cit_num){
    $sql = 'SELECT ROUND(AVG(vot_valeur), 2) AS moyenne FROM vote WHERE cit_num = :cit_num';
    $req = $this->db->prepare($sql);
    $req->bindValue(':cit_num',$cit_num,PDO::PARAM_INT);
    $req->execute();
    return $req->fetchCOLUMN();
    $req->closeCursor();
  }

  public function getNumMaxMethode(){
    $sql = 'SELECT cit_num FROM Methode
    ORDER BY cit_num DESC LIMIT 1';
    $req = $this->db->query($sql);
    $numMaxPersonne = $req->fetch(PDO::FETCH_OBJ);
    return $numMaxPersonne;
    $req->closeCursor();
  }

  public function deleteNote($num){
    $sql = 'DELETE FROM vote
    WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
  }

  public function deleteMethode($num){
    if($this->getMoyenne($num) == ''){
      $sql = 'DELETE FROM Methode
      WHERE cit_num = \''.$num.'\'';
      $req = $this->db->query($sql);
    } else {
      $this->deleteNote($num);
      $sql = 'DELETE FROM Methode
      WHERE cit_num = \''.$num.'\'';
      $req = $this->db->query($sql);
    }
  }

  public function getPerNumMethode($num){
    $sql = 'SELECT per_num FROM Methode WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $perNumMethode = $req->fetch(PDO::FETCH_OBJ);
    return $perNumMethode;
    $req->closeCursor();
  }

  public function getPerNumEtuMethode($num){
    $sql = 'SELECT per_num_etu FROM Methode WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $perNumEtuMethode = $req->fetch(PDO::FETCH_OBJ);
    return $perNumEtuMethode;
    $req->closeCursor();
  }

  public function getCitLibelleMethode($num){
    $sql = 'SELECT cit_libelle FROM Methode WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $citLibelleMethode = $req->fetch(PDO::FETCH_OBJ);
    return $citLibelleMethode;
    $req->closeCursor();
  }

  public function getCitDateMethode($num){
    $sql = 'SELECT cit_date FROM Methode WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $citDateMethode = $req->fetch(PDO::FETCH_OBJ);
    return $citDateMethode;
    $req->closeCursor();
  }

  public function getCitDateDepoMethode($num){
    $sql = 'SELECT cit_date_depo FROM Methode WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $citDateDepoMethode = $req->fetch(PDO::FETCH_OBJ);
    return $citDateDepoMethode;
    $req->closeCursor();
  }

  public function verifNoteMethode($num){
    $sql = 'SELECT COUNT(per_num) AS nbreLigne FROM vote WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $nbreLigne = $req->fetch(PDO::FETCH_OBJ);
    return $nbreLigne;
  }

  public function verifPersonneMethode($perNum, $citNum){
    $sql = 'SELECT COUNT(per_num) AS nbreLigne FROM vote WHERE per_num = \''.$perNum.'\' AND cit_num = \''.$citNum.'\'';
    $req = $this->db->query($sql);
    $nbreLigne = $req->fetch(PDO::FETCH_OBJ);
    return $nbreLigne;
  }

  public function rechercher($nom, $date, $note){
    $listeMethodes = "";
    $sql = 'SELECT DISTINCT c.cit_num, c.per_num, c.cit_libelle, c.cit_date_valide FROM Methode c';
    if (!empty($note)){
      $sql = $sql.' INNER JOIN vote v ON c.cit_num=v.cit_num';
    }
    if (!empty($nom)){
      $sql = $sql.' INNER JOIN personne p ON c.per_num=p.per_num';
    }
    $sql = $sql.' WHERE c.cit_valide = 1 AND c.cit_date_valide IS NOT NULL';
    if (!empty($note)){
      $sql = $sql.' AND vot_valeur = '.$note;
    }
    if (!empty($date)){
      $sql = $sql.' AND c.cit_date_valide = '.$date;
    }
    if (!empty($nom)){
      $sql = $sql.' AND p.per_nom = \''.$nom.'\'';
    }
    $sql = $sql.' GROUP BY c.cit_num, c.per_num';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($methode = $req->fetch(PDO::FETCH_OBJ)){
      $listeMethodes[] = new Methode($methode);
    }
    return $listeMethodes;
    $req->closeCursor();
  }
}
?>
