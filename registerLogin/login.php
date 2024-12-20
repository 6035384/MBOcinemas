<?php
require_once("../dataConnectie/dataConnectie.php"); 
session_start();
session_regenerate_id(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['name']);
    $password = trim($_POST['password']);

    try {
        
        $query = "SELECT * FROM gebruikers WHERE gebruikersnaam = :user";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);


            if (password_verify($password, $user_data['wachtwoord'])) {

                $_SESSION['username'] = $user;
                $_SESSION['uid'] = $user_data['id'];
                $_SESSION['admin'] = ($user_data['admin-status'] === 'admin');

                if ($_SESSION['admin']) {
                    header("Location: http://localhost/MBOcinemas/admin.php");
                } else {
                    header("Location: http://localhost/MBOcinemas/index.php");
                }
                exit();
            } else {
                echo "Ongeldig wachtwoord. <a href='../pages/form.php'>Ga terug</a>";
            }
        } else {
            echo "Gebruiker bestaat niet. <a href='../pages/form.php'>Ga terug</a>";
        }
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}
?>
