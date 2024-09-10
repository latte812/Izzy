<?php
session_start();
if (isset($_POST['email'])) {
    $_SESSION['email'] = $_POST['email'];
}
?>
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
<?php
if (isset($_GET['message'])) {
    echo "<b>" . $_GET['message'] . "</b>" . "<br/>";
}
?>

<br>
<form method="post">

    <label for="email"><b>Email</b></label><br>
    <input type="email" placeholder="Enter email" name="email" required><br>

    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter password" name="password" required><br>

    <button type="submit">Sign in</button>

    <p>Don't have an account? <a href="sign_up.php">Sign up</a></p>

</form>

<?php
require '../connection/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Determine which table to use based on email
    $is_admin = (substr($email, -12) === '@admin.local');
    $table = $is_admin ? 'admins' : 'users';

    // Check if user exist and password matches
    $stmt = $conn->prepare("SELECT * FROM $table where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check password
    $is_password_correct = $is_admin ? ($password === $user['password']) : password_verify($password, $user['password']);
    if ($user && $is_password_correct) {
        // Redirect to front page
        $redirect_page = $is_admin ? 'admin_page.php' : 'front_page.php';
        header('Location: ' . $redirect_page);
        exit;
    } else {
        echo 'Invalid email or password';
    }
}
?>

</div>


</body>
</html>

