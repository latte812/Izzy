<?php

require "../../connection/db_connect.php";
$user_id = $_POST['id'];
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

header("Location: ../../pages/admin_page.php");
