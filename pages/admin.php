<?php
require_once("../dataConnectie/dataConnectie.php");
session_start();

// Controleer of gebruiker admin is
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: http://localhost/MBOcinemas/index.php");
    exit("Toegang geweigerd.");
}

// CSRF-token genereren
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// FilmManager Class
class FilmManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllFilms() {
        try {
            $query = "SELECT * FROM movies";
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Er is een fout opgetreden bij het ophalen van films.");
        }
    }

    public function addFilm($title, $genre, $location, $date, $image) {
        try {
            $query = "INSERT INTO movies (title, genre, location, date, image) VALUES (:title, :genre, :location, :date, :image)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(compact('title', 'genre', 'location', 'date', 'image'));
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Er is een fout opgetreden bij het toevoegen van de film.");
        }
    }

    public function updateFilm($id, $title, $genre, $location, $date, $image) {
        try {
            $query = "UPDATE movies SET title = :title, genre = :genre, location = :location, date = :date, image = :image WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(compact('id', 'title', 'genre', 'location', 'date', 'image'));
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Er is een fout opgetreden bij het bijwerken van de film.");
        }
    }

    public function deleteFilm($id) {
        try {
            $query = "DELETE FROM movies WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Er is een fout opgetreden bij het verwijderen van de film.");
        }
    }
}

// Instanties en formulieren verwerken
$filmManager = new FilmManager($pdo);

try {
    $films = $filmManager->getAllFilms();
} catch (Exception $e) {
    die($e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Ongeldige CSRF-token.");
    }

    try {
        if ($_POST['action'] === 'add') {
            $filmManager->addFilm($_POST['title'], $_POST['genre'], $_POST['location'], $_POST['date'], $_POST['image']);
            echo "<div class='alert alert-success'>Film succesvol toegevoegd!</div>";
        } elseif ($_POST['action'] === 'update') {
            $filmManager->updateFilm($_POST['id'], $_POST['title'], $_POST['genre'], $_POST['location'], $_POST['date'], $_POST['image']);
            echo "<div class='alert alert-success'>Film succesvol bijgewerkt!</div>";
        } elseif ($_POST['action'] === 'delete') {
            $filmManager->deleteFilm($_POST['id']);
            echo "<div class='alert alert-success'>Film succesvol verwijderd!</div>";
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
    }
}
?>

<?php include 'components/header2.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bekijk de allerleukste en meest spannende films ter wereld bij de allerleukst bioscoop in Nederland, MBOCinemas">
    <meta name="keywords" content="cinemas, cinema, kino, films, theater, ">
    <meta name="author" content="Maryam Aldainy">
    <link rel="stylesheet" href="../css/style.css">
    <title>MBOcinemas - Home</title>
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-center mb-4">MBOcinemas - Admin Panel</h1>

    <h2>Films Overzicht</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Titel</th>
            <th>Genre</th>
            <th>Locatie</th>
            <th>Datum</th>
            <th>Afbeelding</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($films as $film): ?>
            <tr>
                <td><?= htmlspecialchars($film['id']) ?></td>
                <td><?= htmlspecialchars($film['title']) ?></td>
                <td><?= htmlspecialchars($film['genre']) ?></td>
                <td><?= htmlspecialchars($film['location']) ?></td>
                <td><?= htmlspecialchars($film['date']) ?></td>
                <td><img src="<?= htmlspecialchars($film['image']) ?>" alt="Film Afbeelding" style="width: 100px;"></td>
                <td>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?= $film['id'] ?>">
                        Titel: <input type="text" name="title" value="<?= htmlspecialchars($film['title']) ?>" class="form-control mb-2" required>
                        Genre: <input type="text" name="genre" value="<?= htmlspecialchars($film['genre']) ?>" class="form-control mb-2" required>
                        Locatie: <input type="text" name="location" value="<?= htmlspecialchars($film['location']) ?>" class="form-control mb-2" required>
                        Datum: <input type="date" name="date" value="<?= htmlspecialchars($film['date']) ?>" class="form-control mb-2" required>
                        Afbeelding: <input type="text" name="image" value="<?= htmlspecialchars($film['image']) ?>" class="form-control mb-2" required>
                        <button type="submit" class="btn btn-primary btn-sm">Bijwerken</button>
                    </form>

                    <form method="POST" class="d-inline">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $film['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Nieuwe Film Toevoegen</h2>
    <form method="POST" class="p-4 border rounded bg-white">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <input type="hidden" name="action" value="add">
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" id="genre" name="genre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Locatie</label>
            <input type="text" id="location" name="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Datum</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Afbeelding (URL)</label>
            <input type="text" id="image" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Toevoegen</button>
    </form>
</div>
</body>
</html>
