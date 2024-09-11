<?php

require "../../connection/db_connect.php";
$admin_id = $_POST['id'];
$sql = "DELETE FROM admins WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();

header("Location: ../../pages/admin_page.php");
