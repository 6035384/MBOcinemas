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
    ]
];
?>

<section class="movie-cards">
    <?php foreach ($movies as $movie): ?>
        <article class="card">
            <img src="<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>">
            <h2><?php echo $movie['title']; ?></h2>
            <ul>
                <li>Genre: <?php echo $movie['genre']; ?></li>
                <li>Locatie: <?php echo $movie['location']; ?></li>
                <li>Datum: <?php echo $movie['date']; ?></li>
            </ul>
            <button class="button" style="vertical-align:middle"><span>Hover </span></button>
        </article>
    <?php endforeach; ?>
</section>

    <?php include 'components/footer.php'; ?>
    </main>
</body>
</html>
