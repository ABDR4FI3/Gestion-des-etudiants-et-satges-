<?php
require 'db.php'; 
    $req = "SELECT COUNT(*) FROM stage WHERE entreprise IS NOT NULL";
    $resl = $pdo->prepare($req);
    $resl->execute();

    $found_stage = $resl->fetchColumn();

    $req = "SELECT COUNT(*) FROM stage WHERE entreprise IS NULL";
    $resl = $pdo->prepare($req);
    $resl->execute();

    $didnt_find_stage = $resl->fetchColumn();

    if (isset($_POST["filtre_button"])) {
        $class = $_POST['class'];

        // Query to count where stage.entreprise IS NOT NULL
        $req = "SELECT COUNT(*) 
                FROM etudiants
                INNER JOIN stage ON etudiants.matricule = stage.matricule
                WHERE stage.entreprise IS NOT NULL
                AND etudiants.class = :class"; // Change the parameter name here
        $resl = $pdo->prepare($req);
        $resl->bindParam(':class', $class, PDO::PARAM_STR);
        $resl->execute();
        
        $found_stage2 = $resl->fetchColumn();
        
        // Query to count where stage.entreprise IS NULL
        $req = "SELECT COUNT(*) 
                FROM etudiants
                INNER JOIN stage ON etudiants.matricule = stage.matricule
                WHERE stage.entreprise IS NULL
                AND etudiants.class = :class"; // Change the parameter name here
        $resl = $pdo->prepare($req);
        $resl->bindParam(':class', $class, PDO::PARAM_STR);
        $resl->execute();
        
        $didnt_find_stage2 = $resl->fetchColumn();
        
    }else{
        $req = "SELECT COUNT(*) 
                FROM etudiants
                INNER JOIN stage ON etudiants.matricule = stage.matricule
                WHERE stage.entreprise IS NOT NULL
                AND etudiants.class = '1AP'"; // Change the parameter name here
        $resl = $pdo->prepare($req);
        $resl->execute();
        
        $found_stage2 = $resl->fetchColumn();
        
        // Query to count where stage.entreprise IS NULL
        $req = "SELECT COUNT(*) 
                FROM etudiants
                INNER JOIN stage ON etudiants.matricule = stage.matricule
                WHERE stage.entreprise IS NULL
                AND etudiants.class = '1AP'"; // Change the parameter name here
        $resl = $pdo->prepare($req);
        $resl->execute();
        
        $didnt_find_stage2 = $resl->fetchColumn();
    }

    //Bar chart stat 
    $FirstYear=0;
    $SecondYear=0;
    $ThirdYear=0;
    $FourthYear=0;
    $FifthYear=0;
    //arrays
    $FIL1 = ["1AP","1GC","1IFA"];
    $FIL2 = ["2AP","2GC","2IFA"];
    $FIL3 = ["3GC","3GI","3IAII","3IFA","3IIR",];
    $FIL4 = ["4GC","4GI","4IAII","4IFA","4IIR",];
    $FIL5 = ["5GC","5GI","5IAII","5IF","5MG"];
    //First Year
    foreach($FIL1 as $iteratureclass){
        $req = "SELECT COUNT(*) 
        FROM etudiants
        INNER JOIN stage ON etudiants.matricule = stage.matricule
        WHERE stage.entreprise IS NOT NULL
        AND etudiants.class = :class"; // Change the parameter name here
        $resl = $pdo->prepare($req);
        $resl->bindParam(':class', $iteratureclass, PDO::PARAM_STR);
        $resl->execute();
        $FirstYear += $resl->fetchColumn();
    }
    foreach($FIL2 as $iteratureclass){
        $req = "SELECT COUNT(*) 
        FROM etudiants
        INNER JOIN stage ON etudiants.matricule = stage.matricule
        WHERE stage.entreprise IS NOT NULL
        AND etudiants.class = :class"; // Change the parameter name here
        $resl = $pdo->prepare($req);
        $resl->bindParam(':class', $iteratureclass, PDO::PARAM_STR);
        $resl->execute();
        $SecondYear += $resl->fetchColumn();
    }
    foreach($FIL3 as $iteratureclass){
        $req = "SELECT COUNT(*) 
        FROM etudiants
        INNER JOIN stage ON etudiants.matricule = stage.matricule
        WHERE stage.entreprise IS NOT NULL
        AND etudiants.class = :class"; // Change the parameter name here
        $resl = $pdo->prepare($req);
        $resl->bindParam(':class', $iteratureclass, PDO::PARAM_STR);
        $resl->execute();
        $ThirdYear += $resl->fetchColumn();
    }
    foreach($FIL4 as $iteratureclass){
        $req = "SELECT COUNT(*) 
        FROM etudiants
        INNER JOIN stage ON etudiants.matricule = stage.matricule
        WHERE stage.entreprise IS NOT NULL
        AND etudiants.class = :class"; // Change the parameter name here
        $resl = $pdo->prepare($req);
        $resl->bindParam(':class', $iteratureclass, PDO::PARAM_STR);
        $resl->execute();
        $FourthYear += $resl->fetchColumn();
    }
    foreach($FIL5 as $iteratureclass){
        $req = "SELECT COUNT(*) 
        FROM etudiants
        INNER JOIN stage ON etudiants.matricule = stage.matricule
        WHERE stage.entreprise IS NOT NULL
        AND etudiants.class = :class"; // Change the parameter name here
        $resl = $pdo->prepare($req);
        $resl->bindParam(':class', $iteratureclass, PDO::PARAM_STR);
        $resl->execute();
        $FifthYear += $resl->fetchColumn();
    }





?>