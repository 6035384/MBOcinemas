<?php
require_once("../dataConnectie/dataConnectie.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['name'];
    $password = $_POST['password'];

    try {
        $query = "SELECT * FROM gebruikers WHERE gebruikersnaam = :user";
        $result = $pdo->prepare($query);
        $result->bindParam(':user', $user);
        $result->execute();

        if ($result !== false && $result->rowCount() > 0) {
            $user_data = $result->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user_data['wachtwoord'])) {
                $_SESSION['username'] = $user;
                $_SESSION['uid'] = $user_data['id'];
                header("Location: http://localhost/MBOcinemas/index.php");
                exit();
            } else {
                echo "Ongeldige gebruikersnaam of wachtwoord.";
                echo "<a href='../pages/form.php'>Go Back</a>";
            }
        } else {
            echo "Ongeldige gebruikersnaam of wachtwoord.";
            echo "<a href='../pages/form.php'>Go Back</a>";
        }

    } catch (PDOException $e) {
        echo "Foutje: " . $e->getMessage();
    }
    $pdo = null;
}
?>
