<?php
require '../connection/session_start.php';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Front Page</title>

<style>
body {
  background-color: #fbf1c7;
}

input[type="submit"], button {
  background-color: #3d3832;
  color: #fbf1c7;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  transition: background-color 0.2s ease-in-out;
}

input[type="submit"]:hover, button:hover {
  background-color: #b8bb26;
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  text-align: center;
}

#options {
  display: flex;
  gap: 10px;
}

#gallery {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  gap: 10px;
  width: 98vw;
}

#gallery img {
  width: 200px;
  height: 200px;
}

.song {
  width: 200px;
  height: 200px;
  text-align: center;
}

.song h3 {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  width: 80%;
}

.song-option {
  display: flex;
  align-items: center;
  text-align: center;
  justify-content: center;
  gap: 10px;
}

</style>
</head>

<body>
<header>
<div id="welcome">
  <h1>Welcome, <?php echo $user['username']; ?></h1>
</div>

<div id="options">

  <form method="post" action="../features/sign_out.php">
    <input type="submit" value="Sign out">
  </form>
</div>
</header>

<main>
<?php

echo "<h2 style='color:#83a598;'>Admin</h2>";
$sql1 = "SELECT * FROM admins";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    echo "<table style='background-color: #83a598; padding: 10px; text-align: center; border-collapse: separate; border-spacing: 20px;'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>username</th>";
    echo "<th>password</th>";
    echo "<th>name</th>";
    echo "<th>email</th>";
    echo "</tr>";
    while ($row = $result1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}


$sql2 = "SELECT * FROM users";
$result2 = $conn->query($sql2);
echo "<h2 style='color:#8ec87c;'>Users</h2>";
if ($result2->num_rows > 0) {
    echo "<table style='background-color: #8ec87c; padding: 10px; text-align: center; border-collapse: separate; border-spacing: 20px;'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>username</th>";
    echo "<th>password</th>";
    echo "<th>name</th>";
    echo "<th>email</th>";
    echo "</tr>";
    while ($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }
}
echo "</table>";
?>
</main>

</body>
</html>

