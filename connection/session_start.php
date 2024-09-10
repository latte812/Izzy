<?php

require 'db_connect.php';

session_start();

// Fetch user data
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // Check if the email is for an admin
    if (strpos($email, '@admin.local') !== false) {
        $stmt = $conn->prepare("SELECT * FROM admins where email = ?");
    } else {
        $stmt = $conn->prepare("SELECT * FROM users where email = ?");
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}
