<?php

require '../connection/db_connect.php';

$song_id = $_GET['id'];

$sql = "SELECT * FROM songs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $song_id);
$stmt->execute();
$result = $stmt->get_result();


$song = $result->fetch_assoc();

echo "<h2>Title: " . $song['title'] . "</h2>";
echo "<h3>Artist: " . $song['artist'] . "</h3>";
echo "<h3>Album: " . $song['album'] . "</h3>";
echo "<h3>Release year: " . $song['release_year'] . "</h3>";
echo "<h3>Genre: " . $song['genre'] . "</h3>";
echo "<br>";
echo "<h3><pre>" . $song['lyrics'] . "</pre></h3>";
echo '<img src="' . $song['cover'] . '">';
