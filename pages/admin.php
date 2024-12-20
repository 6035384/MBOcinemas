<?php
require_once("../dataConnectie/dataConnectie.php");
session_start();


if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: http://localhost/MBOcinemas/index.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        try {
            if ($action === 'add') {
                $query = "INSERT INTO films (title, genre, location, date, image) VALUES (:title, :genre, :location, :date, :image)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':title', $_POST['title']);
                $stmt->bindParam(':genre', $_POST['genre']);
                $stmt->bindParam(':location', $_POST['location']);
                $stmt->bindParam(':date', $_POST['date']);
                $stmt->bindParam(':image', $_POST['image']);
                $stmt->execute();
                echo "Film succesvol toegevoegd!";
            } elseif ($action === 'update') {
                $query = "UPDATE films SET title = :title, genre = :genre, location = :location, date = :date, image = :image WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $_POST['id']);
                $stmt->bindParam(':title', $_POST['title']);
                $stmt->bindParam(':genre', $_POST['genre']);
                $stmt->bindParam(':location', $_POST['location']);
                $stmt->bindParam(':date', $_POST['date']);
                $stmt->bindParam(':image', $_POST['image']);
                $stmt->execute();
                echo "Film succesvol bijgewerkt!";
            } elseif ($action === 'delete') {
                $query = "DELETE FROM films WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $_POST['id']);
                $stmt->execute();
                echo "Film succesvol verwijderd!";
            }
        } catch (PDOException $e) {
            echo "Fout bij de bewerking: " . $e->getMessage();
        }
    }
}


try {
    $query = "SELECT * FROM films";
    $stmt = $pdo->query($query);
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Fout bij het ophalen van films: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Log in of registreer je bij MBOcinemas en geniet van de beste films in de leukste bioscoop van Nederland!">
    <meta name="keywords" content="cinemas, login, registratie, films, theater">
    <meta name="author" content="Maryam Aldainy">
    <link rel="stylesheet" href="../css/style.css">
    <script src="admin.js" defer></script>
    <title>MBOcinemas - Admin</title>
</head>
<body>
    <h1>Welkom, Admin! Filmbeheer</h1>

    <h2>Films Overzicht</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titel</th>
            <th>Genre</th>
            <th>Locatie</th>
            <th>Datum</th>
            <th>Afbeelding</th>
            <th>Acties</th>
        </tr>
        <?php foreach ($films as $film): ?>
            <tr>
                <td><?= htmlspecialchars($film['id']) ?></td>
                <td><?= htmlspecialchars($film['title']) ?></td>
                <td><?= htmlspecialchars($film['genre']) ?></td>
                <td><?= htmlspecialchars($film['location']) ?></td>
                <td><?= htmlspecialchars($film['date']) ?></td>
                <td><?= htmlspecialchars($film['image']) ?></td>
                <td>
                    
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?= $film['id'] ?>">
                        Titel: <input type="text" name="title" value="<?= htmlspecialchars($film['title']) ?>" required>
                        Genre: <input type="text" name="genre" value="<?= htmlspecialchars($film['genre']) ?>" required>
                        Locatie: <input type="text" name="location" value="<?= htmlspecialchars($film['location']) ?>" required>
                        Datum: <input type="date" name="date" value="<?= htmlspecialchars($film['date']) ?>" required>
                        Afbeelding: <input type="text" name="image" value="<?= htmlspecialchars($film['image']) ?>" required>
                        <button type="submit">Bijwerken</button>
                    </form>

                    
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $film['id'] ?>">
                        <button type="submit">Verwijderen</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Nieuwe Film Toevoegen</h2>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        Titel: <input type="text" name="title" required><br>
        Genre: <input type="text" name="genre" required><br>
        Locatie: <input type="text" name="location" required><br>
        Datum: <input type="date" name="date" required><br>
        Afbeelding: <input type="text" name="image" required><br>
        <button type="submit">Toevoegen</button>
    </form>
</body>
</html>
