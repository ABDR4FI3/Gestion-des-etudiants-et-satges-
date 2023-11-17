<?php
function checkinDb() {
    require 'db.php';

    if (isset($_POST["sub"])) {
        $email = $_POST['email'];
        $password = $_POST['password']; // Change to $password

        $stmt = $pdo->prepare("SELECT * FROM `admin` WHERE email = :email AND password = :password"); // Change to pass
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // If the user is found, redirect to the desired page
            header("Location: http://localhost/STAGE/dist/Etudiant.php"); // Use a relative URL or a full URL as explained in the previous response
            exit(); // Ensure that no more code is executed after the redirect
        } else {
            
        }
    }else{
        
    }
}
?>