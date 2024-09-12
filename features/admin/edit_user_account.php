<?php
require '../../connection/db_connect.php';


if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

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

.error {
  color: #cc241d;
}

input[type=text], input[type=email], input[type=password], input[type=number] {
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
  
    <label for="id"><b>Id</b></label> <br>
  <input type="number" name="id" value="<?php echo isset($user['id']) ? htmlspecialchars($user['id']) : ''; ?>"> <br>
    <label for="username"><b>Username</b></label> <br>
  <input type="text" name="username" value="<?php echo isset($user['username']) ? htmlspecialchars($user['username']) : ''; ?>"> <br>
    <label for="email"><b>Email</b></label><br>
  <input type="email" name="email" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>"> <br>

    <label for="name"><b>Name</b></label><br>
  <input type="text" name="name" value="<?php echo isset($user['name']) ? htmlspecialchars($user['name']) : ''; ?>"> <br>

    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter password" name="password" required><br>

    <button type="submit" name="change_info">Change info</button>

</form>

<?php


if (isset($_POST['change_info'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, name = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $username, $email, $name, $password, $id);

    if ($stmt->execute()) {
        echo "Information updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

?>
</div>
</body>
</html>

