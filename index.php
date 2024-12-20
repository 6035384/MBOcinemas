<?php include 'components/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bekijk de allerleukste en meest spannende films ter wereld bij de allerleukst bioscoop in Nederland, MBOCinemas">
    <meta name="keywords" content="cinemas, cinema, kino, films, theater, ">
    <meta name="author" content="Maryam Aldainy">
    <link rel="stylesheet" href="css/style.css">
    <script src="scripts/slideshow.js" defer></script>
    <title>MBOcinemas - Home</title>
</head>
<body>
    <main>
        <center><section>
          <article class="content">
            <article class="slides" id="slideshow">
                <article class="slide_content">
                    <img src="images/howl.jpg" alt="Howls moving castle" height="950" width="900">
                </article>
                <article class="slide_content">
                    <img src="images/transformers.jpg" alt="Transformers" height="950" width="900">
                </article>
                <article class="slide_content">
                    <img src="images/solo.jpg" alt="Solo leveling" height="950" width="900">
                </article>
                <article class="slide_content">
                    <img src="images/fightclub.jpg" alt="Fight Club" height="950" width="900">
                </article>
            </article>
        </article>        
        </section>
    </center>

    <?php
$movies = [
    [
        "image" => "images/deadpool.jpg",
        "title" => "Deadpool",
        "genre" => "Action",
        "location" => "Leiden",
        "date" => "15-12-2024"
    ],
    [
        "image" => "images/fallguy.png",
        "title" => "The Fall Guy",
        "genre" => "Drama",
        "location" => "Rotterdam",
        "date" => "15-12-2024"
    ],
    [
        "image" => "images/dm4.jpg",
        "title" => "Despicable Me 4",
        "genre" => "Comedy",
        "location" => "Utrecht",
        "date" => "20-12-2024"
    ],
    [
        "image" => "images/thegreenknight.JPG",
        "title" => "The Green Knight",
        "genre" => "Fantasy/Adventure",
        "location" => "Den Haag",
        "date" => "25-12-2024"
    ],
    [
        "image" => "images/fight.jpg",
        "title" => "Fight Club",
        "genre" => "Action/Thriller",
        "location" => "Leiden",
        "date" => "15-12-2024"
    ],
    [
        "image" => "images/se7en.jpg",
        "title" => "Se7en",
        "genre" => "Crime/Horror",
        "location" => "Rotterdam",
        "date" => "15-12-2024"
    ],
    [
        "image" => "images/marie.jpg",
        "title" => "Marie Antoinette: the Movie",
        "genre" => "Drama/History",
        "location" => "Utrecht",
        "date" => "20-12-2024"
    ],
    [
        "image" => "images/spirited.JPG",
        "title" => "Spirited Away",
        "genre" => "Fantasy/Adventure",
        "location" => "Den Haag",
        "date" => "25-12-2024"
    ],
    [
        "image" => "images/howls.jpg",
        "title" => "Howl's Moving Castle",
        "genre" => "Family/Fantasy",
        "location" => "Leiden",
        "date" => "15-12-2024"
    ],
    [
        "image" => "images/totoro.jpg",
        "title" => "My Neighbor Totoro",
        "genre" => "Family/Fantasy",
        "location" => "Rotterdam",
        "date" => "15-12-2024"
    ],
    [
        "image" => "images/nausicaa.jpg",
        "title" => "Nausicaä",
        "genre" => "Fantasy/Adventure",
        "location" => "Utrecht",
        "date" => "20-12-2024"
    ],
    [
        "image" => "images/batman.JPG",
        "title" => "The Batman",
        "genre" => "Action/Crime",
        "location" => "Den Haag",
        "date" => "25-12-2024"
    ],
];
?>

<?php
$filteredMovies = $movies;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $filterGenre = $_GET['genre'] ?? '';
    $filterLocation = $_GET['location'] ?? '';
    $filterDate = $_GET['date'] ?? '';

    if ($filterGenre || $filterLocation || $filterDate) {
        $filteredMovies = array_filter($movies, function ($movie) use ($filterGenre, $filterLocation, $filterDate) {
            return (!$filterGenre || stripos($movie['genre'], $filterGenre) !== false) &&
                   (!$filterLocation || stripos($movie['location'], $filterLocation) !== false) &&
                   (!$filterDate || $movie['date'] === $filterDate);
        });
    }
}
?>
<section class="movie-cards">
    <?php if (count($filteredMovies) > 0): ?>
        <?php foreach ($filteredMovies as $movie): ?>
            <article class="card">
                <img src="<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>">
                <h2><?php echo $movie['title']; ?></h2>
                <ul>
                    <li>Genre: <?php echo $movie['genre']; ?></li>
                    <li>Locatie: <?php echo $movie['location']; ?></li>
                    <li>Datum: <?php echo $movie['date']; ?></li>
                </ul>
                <button class="button" style="vertical-align:middle">
                <a href="movie-details.php?title=<?php echo urlencode($movie['title']); ?>">Read more</a>
                </button>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Geen films gevonden die aan de filters voldoen, vul a.u.b een bestaande sleutelwoord.</p>
    <?php endif; ?>
</section>

<section class="filters">
    <form method="GET" action="">
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" placeholder="e.g., Action" value="<?php echo htmlspecialchars($_GET['genre'] ?? ''); ?>">
        
        <label for="location">Locatie:</label>
        <input type="text" id="location" name="location" placeholder="e.g., Leiden" value="<?php echo htmlspecialchars($_GET['location'] ?? ''); ?>">
        
        <label for="date">Datum:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($_GET['date'] ?? ''); ?>">
        
        <button type="submit">Filter</button>
        <button type="reset" onclick="window.location='?'">Reset</button>
    </form>
</section>

    <?php include 'components/footer.php'; ?>
    </main>
</body>
</html>
