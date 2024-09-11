<?php

require '../../connection/db_connect.php';

$song_id = $_POST['id'];
$sql = "DELETE FROM songs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $song_id);
$stmt->execute();

header('Location: ../../pages/front_page.php');
