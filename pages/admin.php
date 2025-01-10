<?php
require_once("../dataConnectie/dataConnectie.php");
session_start();


if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: http://localhost/MBOcinemas/index.php");
    exit();
}

class FilmManager {
    private $pdo;

    public function _construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllFilms() {
        try {
            $query = SELECT * FROM movies;
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Fout bij ophalen van films: ". $e->getMessage());
    }
}

public function addFilm($title, $genre, $location, $date, $image) {
    try {
        $query = "INSERT INTO movies (title, genre, location, date, image) VALUES (:title, :genre, :location, :date, :image)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
    } catch (PDOException $e) {
        throw new Exception("Fout bij toevoegen van film: ". $e->getMessage());
    }
}

public function updateFilm($id, $title, $genre, $location, $date, $image) {
    try {
        $query = "UPDATE films SET title = :title, genre = :genre, location = :location, date = :date, image = :image WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Fout bij het bijwerken van een film: " . $e->getMessage());
        }
    }
}

public function deleteFilm($id) {
    try {
        $query = "DELETE FROM films WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } catch (PDOException $e) {
        throw new Exception("Fout bij het verwijderen van een film: " . $e->getMessage());
    }
}

$filmManager = new FilmManager($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        try {
            if ($action === 'add') {
                $filmManager->addFilm($_POST['title'], $_POST['genre'], $_POST['location'], $_POST['date'], $_POST['image']);
                echo "Film succesvol toegevoegd!";
            } elseif ($action === 'update') {
                $filmManager->updateFilm($_POST['id'], $_POST['title'], $_POST['genre'], $_POST['location'], $_POST['date'], $_POST['image']);
                echo "Film succesvol bijgewerkt!";
            } elseif ($action === 'delete') {
                $filmManager->deleteFilm($_POST['id']);
                echo "Film succesvol verwijderd!";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

try {
    $films = $filmManager->getAllFilms();
} catch (Exception $e) {
    echo $e->getMessage();
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

