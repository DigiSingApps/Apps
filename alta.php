<?php

$hostname="localhost";
$username="root";
$password="";
$database="appdemo";
try {
$con = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
print "Conexión exitosa!";
}
catch (PDOException $e) {
print "¡Error!: " . $e->getMessage() . "
";
die();
}



$sql = "INSERT INTO tb_registro(FirstName , Email, Age, Genero, Password, Code) VALUES(:FirstName,:Email,:Age,:Genero,:Password,:Code)";
                                          
$stmt = $con->prepare($sql);
                                              
$stmt->bindParam(':FirstName', $_POST['nombre'], PDO::PARAM_STR);       
$stmt->bindParam(':Email', $_POST['email'], PDO::PARAM_STR); 
$stmt->bindParam(':Age', $_POST['edad'], PDO::PARAM_STR);
// use PARAM_STR although a number  
$stmt->bindParam(':Genero', $_POST['genero'], PDO::PARAM_STR); 
$stmt->bindParam(':Password', sha1($_POST['contrasena']), PDO::PARAM_STR); 
$stmt->bindParam(':Code', $_POST['codigo'], PDO::PARAM_STR);  
                                      
$stmt->execute();
$con =null;
header ("Location: menu.html");


?>