<?php
require 'db.php';
require_once 'vendor/autoload.php'; // Include the Composer autoloader
function modifydataStage() {
    require 'db.php';
    if (isset($_POST["modifyStageSE"])) {
      // Gathering info
      $matricule = $_POST['matricule'];
      $entreprise = $_POST['entreprise'];
      $sujet = $_POST['sujet'];
      $datedebut = $_POST['datedebut'];
      $datefin = $_POST['datefin'];
      $cnve = $_POST['cnve'];
      $cnvr = $_POST['cnvr'];
      $observation = $_POST['observation'];
      $nature = $_POST['nature'] ;
      
        if (!empty($matricule) && !empty($entreprise) && !empty($sujet) && !empty($datedebut) && !empty($datefin) && !empty($cnve) && !empty($cnvr) && !empty($observation) ) {
            $req = "UPDATE stage SET  entreprise=:entreprise, sujet=:sujet, `datedebut`=:datedebut, `datefin`=:datefin , `convention_empruntee`=:cnve, `convention_recu`=:cnvr , `observation`=:observation  , `nature`=:nature WHERE matricule=:matricule";
            $resl = $pdo->prepare($req);
            $data = [
                "entreprise" => $entreprise,
                "sujet" => $sujet,
                "datedebut" => $datedebut, 
                "datefin" => $datefin, 
                "cnve" => $cnve,
                "cnvr" => $cnvr,
                "observation" => $observation,
                "matricule" => $matricule ,
                "nature" => $nature ,
            ];
            $resl->execute($data);
            $msg = 'The student info has been modified';
            return $msg;
        } else {
            echo "Fill all , please";
        }
    }
}
function DeleteDataStage() {
    require 'db.php';
    if (isset($_POST["deleteStageSE"]) ) {
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

// filter stages by name :
function searchByNameStage($studentOriginal) {
    global $pdo;
    
    if (isset($_POST["thename"])) {
        $searchName = $_POST['thename'];
        
        // Prepare the SQL query to search for rows with names similar to the input
        $req = "SELECT * FROM stage WHERE nom LIKE :searchName";
        $result = $pdo->prepare($req);
        
        // Bind the parameter with a wildcard '%' to match any characters before and after the input
        $searchName = '%' . $searchName . '%';
        $result->bindParam(':searchName', $searchName, PDO::PARAM_STR);
        
        $result->execute();
        $filteredData = $result->fetchAll(PDO::FETCH_OBJ);
        
        return $filteredData;
    } else {
        return $studentOriginal;
    }
} 
function addEcnadrant(){
    global $pdo;
    if (isset($_POST["submit"])) {
        $nom = $_POST['nom'];
        $data = [ 
            "nom" => $nom, 
          ];
        $req = "INSERT INTO encadrants (nom) VALUES (:nom)";
        $resl = $pdo->prepare($req);
        $resl->execute($data);
    }
}

?>