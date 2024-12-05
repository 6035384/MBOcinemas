<?php
require_once("../dataConnectie/dataConnectie.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = $_POST['name'];
    $password = $_POST['password'];

    try{
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        global $pdo;

        $query = "INSERT INTO gebruikers (id, gebruikersnaam, wachtwoord) VALUES (NULL, :user , :pass)";
        $result = $pdo->prepare($query);
        $result->bindParam(':pass', $hashed_password);

        $result->bindParam(':user', $user);        
        $result->execute();
        $_SESSION['username'] = $user;
        
    } catch (PDOException $e){
        echo "Foutje:" .$e->getMessage();
    }
    $pdo = null;
    header("Location: http://localhost/MBOcinemas/index.php");
    exit();
}

?>