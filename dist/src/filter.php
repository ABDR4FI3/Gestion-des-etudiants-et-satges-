<?php
require "db.php"; 
function filterClass($studentOriginal) {
    global $pdo;
    if (isset($_POST["filtre"])) {
        $class = $_POST['class'];
        if ($class == 'all') {
            $req = "SELECT * FROM etudiants";
            $result = $pdo->prepare($req);
            $result->execute();
            $student = $result->fetchAll(PDO::FETCH_OBJ);
            return $student;
        } else {
            $req = "SELECT * FROM etudiants WHERE class = :class"; // Use a named parameter
            $result = $pdo->prepare($req);

            $result->bindParam(':class', $class, PDO::PARAM_STR); // Bind the parameter
            $result->execute();
            $students = $result->fetchAll(PDO::FETCH_OBJ);
            return $students;
        }
    } else {

        return $studentOriginal;
    }
}
function searchByName($studentOriginal) {
    global $pdo;
    
    if (isset($_POST["thename"])) {
        $searchName = $_POST['thename'];
        
        // Prepare the SQL query to search for rows with names similar to the input
        $req = "SELECT * FROM etudiants WHERE nom LIKE :searchName";
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
?>
