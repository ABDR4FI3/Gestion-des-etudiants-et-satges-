<?php
$dsn = "mysql:host=localhost;dbname=stage";
$user="root";
$pass="";
try{
//test connextion
$pdo = new PDO($dsn,$user,$pass);
//setattribute
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
echo "Faild" . $e->getMessage();
}
$FIL = ["1AP","1GC","1IFA","2AP","2GC","2IFA","3GC","3GI","3IAII","3IFA","3IIR","4GC","4GI","4IAII","4IFA","4IIR","5GC","5GI","5IAII","5IF","5MG"];

?>