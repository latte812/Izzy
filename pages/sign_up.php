<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Fish</title>
<style>
body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #282828;
}

.container {
  width: 300px;
  padding: 16px;
  background-color: #fbf1c7;
  border: none;
  border-radius: 4px;
}

.error {
  color: #cc241d;
}

input[type=text], input[type=email], input[type=password] {
  width: 89%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #282828;
  color: white;
}

  input:focus {
  outline: 3px solid #b8bb26;
}

button {
  background-color: #98971a;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  font-weight: bold;
}

button:hover {
    background-color: #b8bb26;
    text-decoration: underline;
}

p {
  text-align: center;
}

a {
  color: #b16286;
}

a:hover {
  color: #8f3871;
  font-weight: bold;
}

    </style>
</head>
<body>

<div class="container">
<form method="post">
    <label for="username"><b>Username</b></label> <br>
<input type="text" placeholder="yourusername" name="username" required><br>
    <label for="email"><b>Email</b></label><br>
    <input type="email" placeholder="user@example.com" name="email" required><br>

    <label for="name"><b>Name</b></label><br>
    <input type="text" placeholder="John Doe" name="name" required><br>

    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter password" name="password" required><br>

    <button type="submit">Sign up</button>

    <p>Already have an account? <a href="sign_in.php">Sign in</a></p>

</form>

<?php
require '../connection/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        die('This email is already used');
    }

    // Check if user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        die('This username is already used');
    }

    $stmt = $conn->prepare("INSERT INTO users (username, password, name, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $name, $email);
    $stmt->execute();


    header('Location: sign_in.php?message=User created successfully! Please sign in.');
}

?>
</div>
</body>
</html>

