<?php
class MethodeManager {

  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function add($citation){
    $req = $this->db->prepare('INSERT INTO citation (cit_num, per_num, per_num_valide, per_num_etu,
      cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo) VALUES(:cit_num, :per_num,
      :per_num_valide, :per_num_etu, :cit_libelle, :cit_date, :cit_valide, :cit_date_valide, :cit_date_depo)');
    $req->bindValue(':cit_num', $citation->getCit_num(), PDO::PARAM_STR);
    $req->bindValue(':per_num', $citation->getPer_num(), PDO::PARAM_STR);
    $req->bindValue(':per_num_valide', $citation->getPer_num_valide(), PDO::PARAM_STR);
    $req->bindValue(':per_num_etu', $citation->getPer_num_etu(), PDO::PARAM_STR);
    $req->bindValue(':cit_libelle', $citation->getCit_libelle(), PDO::PARAM_STR);
    $req->bindValue(':cit_date', $citation->getCit_date(), PDO::PARAM_STR);
    $req->bindValue(':cit_valide', $citation->getCit_valide(), PDO::PARAM_STR);
    $req->bindValue(':cit_date_valide', $citation->getCit_date_valide(), PDO::PARAM_STR);
    $req->bindValue(':cit_date_depo', $citation->getCit_date_depo(), PDO::PARAM_STR);
    $req->execute();
  }

  public function getCitation(){
    $listeCitations = array();
    $sql = 'SELECT cit_num, per_num, cit_libelle, cit_date_valide FROM citation
      WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL
      ORDER BY cit_date DESC LIMIT 2';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($citation = $req->fetch(PDO::FETCH_OBJ)){
      $listeCitations[] = new Citation($citation);
    }
    return $listeCitations;
    $req->closeCursor();
  }

  public function getCitationNonValide(){
    $listeCitations = array();
    $sql = 'SELECT cit_num, per_num, cit_libelle, cit_date_valide FROM citation
      WHERE cit_valide = 0 AND cit_date_valide IS NULL
      ORDER BY cit_date DESC';
    $req = $this->db->prepare($sql);
    $req->execute();
    while ($citation = $req->fetch(PDO::FETCH_OBJ)){
      $listeCitations[] = new Citation($citation);
    }
    return $listeCitations;
    $req->closeCursor();
  }

  public function getNbreCitation(){
    $nbreCitation;
    $sql = 'SELECT COUNT(*) AS nbreCitation FROM citation WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL';
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

  public function getNumMaxCitation(){
    $sql = 'SELECT cit_num FROM citation
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

  public function deleteCitation($num){
    if($this->getMoyenne($num) == ''){
      $sql = 'DELETE FROM citation
      WHERE cit_num = \''.$num.'\'';
      $req = $this->db->query($sql);
    } else {
      $this->deleteNote($num);
      $sql = 'DELETE FROM citation
      WHERE cit_num = \''.$num.'\'';
      $req = $this->db->query($sql);
    }
  }

  public function getPerNumCitation($num){
    $sql = 'SELECT per_num FROM citation WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $perNumCitation = $req->fetch(PDO::FETCH_OBJ);
    return $perNumCitation;
    $req->closeCursor();
  }

  public function getPerNumEtuCitation($num){
    $sql = 'SELECT per_num_etu FROM citation WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $perNumEtuCitation = $req->fetch(PDO::FETCH_OBJ);
    return $perNumEtuCitation;
    $req->closeCursor();
  }

  public function getCitLibelleCitation($num){
    $sql = 'SELECT cit_libelle FROM citation WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $citLibelleCitation = $req->fetch(PDO::FETCH_OBJ);
    return $citLibelleCitation;
    $req->closeCursor();
  }

  public function getCitDateCitation($num){
    $sql = 'SELECT cit_date FROM citation WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $citDateCitation = $req->fetch(PDO::FETCH_OBJ);
    return $citDateCitation;
    $req->closeCursor();
  }

  public function getCitDateDepoCitation($num){
    $sql = 'SELECT cit_date_depo FROM citation WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $citDateDepoCitation = $req->fetch(PDO::FETCH_OBJ);
    return $citDateDepoCitation;
    $req->closeCursor();
  }

  public function verifNoteCitation($num){
    $sql = 'SELECT COUNT(per_num) AS nbreLigne FROM vote WHERE cit_num = \''.$num.'\'';
    $req = $this->db->query($sql);
    $nbreLigne = $req->fetch(PDO::FETCH_OBJ);
    return $nbreLigne;
  }

  public function verifPersonneCitation($perNum, $citNum){
    $sql = 'SELECT COUNT(per_num) AS nbreLigne FROM vote WHERE per_num = \''.$perNum.'\' AND cit_num = \''.$citNum.'\'';
    $req = $this->db->query($sql);
    $nbreLigne = $req->fetch(PDO::FETCH_OBJ);
    return $nbreLigne;
  }

  public function rechercher($nom, $date, $note){
    $listeCitations = "";
    $sql = 'SELECT DISTINCT c.cit_num, c.per_num, c.cit_libelle, c.cit_date_valide FROM citation c';
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
    while ($citation = $req->fetch(PDO::FETCH_OBJ)){
      $listeCitations[] = new Citation($citation);
    }
    return $listeCitations;
    $req->closeCursor();
  }
}
?>
