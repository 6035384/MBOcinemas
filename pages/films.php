<?php
$query = "SELECT * FROM movies";
$result = $pdo->prepare($query);
$result->execute();


while ($film = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='film'>";
    echo "<h3>" . htmlspecialchars($film['titel']) . "</h3>";
    echo "<p>" . htmlspecialchars($film['beschrijving']) . "</p>";
    echo "<img src='" . htmlspecialchars($film['afbeelding']) . "' alt='" . htmlspecialchars($film['titel']) . "' />";
    echo "</div>";
}
?>
