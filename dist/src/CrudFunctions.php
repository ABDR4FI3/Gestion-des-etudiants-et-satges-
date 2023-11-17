<?php
require_once 'vendor/autoload.php'; // Include the Composer autoloader
require 'db.php'; // Include the database connection file

/* insert statement */
function insertData() {
  
  // Check if the request method is POST
  if (isset($_POST["add"])) {
    $LastYear = ["5GC","5GI","5IAII","5IF","5MG"];
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $anneScolaire = $_POST['anneScolaire'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $group = $_POST['group']; 
    $nature = "se";

    if (!empty($id) && !empty($nom) && !empty($anneScolaire) && !empty($email) && !empty($class) && !empty($group) && is_numeric($group)) {
      require 'db.php';
      $data = [
        "id" => $id, 
        "name" => $nom, 
        "anneScolaire" => $anneScolaire,
        "email" => $email,
        "group" => $group,
        "class" => $class
      ];
      $req = "INSERT INTO etudiants (matricule, nom, anneScolaire, email, `group`, `class`) VALUES (:id, :name, :anneScolaire, :email, :group, :class)";
      $resl = $pdo->prepare($req);
      $resl->execute($data);
      /* INSERT INTO TABLE STAGIERE */
      foreach($LastYear as $cl){
        if ($cl == $class){
          $nature='pfe';
        }
      }
      $data2 = [
        "id" => $id, 
        "name" => $nom,
        "nature" =>$nature
      ];
      $req2 = "INSERT INTO stage (matricule, nom,nature) VALUES (:id, :name , :nature)";
      $resl2 = $pdo->prepare($req2);
      $resl2->execute($data2);
      
      $msg = "The user has been added successfully ";
      return $msg;
    } else {
      $message = 'Please fill all the inputs';
    }
  }
}




/*Modify button */
 


function modifydata() {
  require 'db.php';
  if (isset($_POST["modify"])) {
    // Gathering info
    $id = $_POST['id'];
    $anneScolaire = $_POST['anneScolaire'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $group = $_POST['group'];
    
    // Checking if a student with the id entered exists
    $query = "SELECT COUNT(*) FROM etudiants WHERE matricule = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the result
    $count = $stmt->fetchColumn();

    if ($count > 0) {
      if (!empty($id) && !empty($anneScolaire) && !empty($email) && !empty($class) && !empty($group) && is_numeric($group)) {
        $req = "UPDATE etudiants SET anneScolaire=:anneScolaire, email=:email, `group`=:group, `class`=:class WHERE matricule=:id";
        $resl = $pdo->prepare($req);
  
        $data = [
          "anneScolaire" => $anneScolaire,
          "email" => $email,
          "group" => $group, 
          "class" => $class, 
          "id" => $id
        ];
  
        $resl->execute($data);
        $msg = 'The student info has been modified';
        return $msg;
      } else {
        echo "Fill all inputs, please";
      }
    } else {
      // header('Location:etudiant.php');
      echo "Student with ID $id does not exist in the 'etudiants' table.";
    }    
  }
}


// delete function 
function delete(){
  require 'db.php';
  if (isset($_POST["delete"])){
    $id = $_POST['id'];
    //checking if a dtudent with the id entred exist
    $query = "SELECT COUNT(*) FROM etudiants WHERE matricule = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the result
    $count = $stmt->fetchColumn();

    if ($count > 0) {

    $req = "DELETE FROM etudiants WHERE matricule=:id";
    $resl = $pdo->prepare($req);
    $resl->execute(array(":id" => $id));
    $req = "DELETE FROM stage WHERE matricule=:id";
    $resl = $pdo->prepare($req);
    $resl->execute(array(":id" => $id));

    }else{
      echo "Student with ID $id does not exist in the 'etudiants' table.";

    }
  }
}



function import() {
  global $pdo; 

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["import"])) {

        // Get the uploaded file
        $file = $_FILES["excel_file"]["tmp_name"];

        // Create a PhpSpreadsheet object
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

        // Assuming the first sheet in the Excel file
        $worksheet = $spreadsheet->getActiveSheet();

        // Iterate through rows in the Excel file
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // Iterate over all cells, even if they are empty

            $rowData = [];

            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue();
            }

            // Assuming column order matches database table columns
            $column1 = $rowData[0]; // Replace with your column names
            $column2 = $rowData[1];
            $column3 = $rowData[2];
            $column4 = $rowData[3];
            $column5 = (int)$rowData[4];
            $column6 = $rowData[5];

            try {
              
                // Insert data into your SQL table using prepared statements
                $sql = "INSERT INTO etudiants (matricule,nom, email, `class`, `group`,anneScolaire) VALUES (?, ?, ?, ?, ?,?)";
                
                $stmt = $pdo->prepare($sql);
                
                $stmt->execute([$column1, $column2, $column3, $column4, $column5,$column6]);
                $sql = "INSERT INTO stage (matricule,nom) VALUES (?, ?)";
                
                $stmt = $pdo->prepare($sql);
                
                $stmt->execute([$column1, $column2]);
                echo  "done ";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage(); 
            }
        }
        echo "Data imported successfully!";
    } else {
    }
}
