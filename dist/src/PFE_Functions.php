<?php
require 'db.php';
function modifydataPFE() {
    require 'db.php';
    if (isset($_POST["modifyStagePFE"])) {
      // Gathering info
      $matricule = $_POST['matricule'];
      $entreprise = $_POST['entreprise'];
      $sujet = $_POST['sujet'];
      $datedebut = $_POST['datedebut'];
      $datefin = $_POST['datefin'];
      $cnve = $_POST['cnve'];
      $cnvr = $_POST['cnvr'];
      $fiche = $_POST['fiche'];
      $encadrant_ecole = $_POST['encadrantEcole'];
      $encadrant_de_stage = $_POST['EncadrantStage'];
      $nature = $_POST['nature'] ;
      $duree = $_POST['duree'] ;
      
        if (!empty($matricule) && !empty($entreprise) && !empty($sujet) && !empty($datedebut) && !empty($datefin) && !empty($cnve) && !empty($cnvr) && !empty($fiche) && !empty($encadrant_ecole) && !empty($encadrant_de_stage) ) {
            $req = "UPDATE stage SET  entreprise=:entreprise, sujet=:sujet, `datedebut`=:datedebut, `datefin`=:datefin , `convention_empruntee`=:cnve, `convention_recu`=:cnvr , `fiche`=:fiche ,  `encadrant_ecole`=:encadrant_ecole ,  `encadrant_de_stage`=:encadrant_de_stage , `nature`=:nature , duree=:duree WHERE matricule=:matricule";
            $resl = $pdo->prepare($req);
            $data = [
                "entreprise" => $entreprise,
                "sujet" => $sujet,
                "datedebut" => $datedebut, 
                "datefin" => $datefin, 
                "cnve" => $cnve,
                "cnvr" => $cnvr,
                "fiche" => $fiche ,
                "encadrant_ecole" => $encadrant_ecole ,
                "encadrant_de_stage" => $encadrant_de_stage ,
                "matricule" => $matricule ,
                "nature" => $nature ,
                "duree" => $duree ,
            ];
            $resl->execute($data);
            $msg = 'The student info has been modified';
            return $msg;
        } else {
            echo "Fill all PFE FORM INPUTS  , please";
        }
    }
}

function deletePFE() {
    require 'db.php';
    if (isset($_POST["deletePFE"]) ) {
        $matricule = $_POST['matricule']; 
        $query = "SELECT COUNT(*) FROM stage WHERE matricule = :matricule";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_INT);
        $stmt->execute();
    
        // Fetch the result
        $count = $stmt->fetchColumn();
        if ($count > 0 && !empty($matricule)) {
            $req = "DELETE FROM etudiants WHERE matricule=:matricule";
            $resl = $pdo->prepare($req);
            $resl->execute(array(":matricule" => $matricule));
            $req = "DELETE FROM stage WHERE matricule=:matricule";
            $resl = $pdo->prepare($req);
            $resl->execute(array(":matricule" => $matricule));
            echo"student and stage deleted";
        
        }else{
              echo "Student with matricule $matricule does not exist in the 'etudiants' table. or matricule inout not filled";
        
        }
    }
}


?>