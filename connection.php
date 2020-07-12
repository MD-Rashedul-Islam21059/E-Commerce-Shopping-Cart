<?php 

$host = "localhost";
$user = "root";
$password = "";
$db = "cart";


try{
    $conn = new PDO("mysql:host=$host; dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOEXCEPTION $e){
    header("location: setup.php");
}

?>