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

 table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
  }

  tr:nth-child(even) {
    background-color:  
 #d5c4a1;
  }

  th {
    background-color: #3d3832;
    color: white;
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
<table>
<h2>Admins</h2>
<?php
$sql1 = "SELECT * FROM admins";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Username</th>";
    echo "<th>Password</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "</tr>";
    while ($row = $result1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>";
        echo "<form action='../features/admin/edit_admin_account.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Edit'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form action='../features/admin/delete_admin_account.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
}
?>
</table>


<table>
<h2>Users</h2>
<?php
$sql2 = "SELECT * FROM users";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Username</th>";
    echo "<th>Password</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "</tr>";
    while ($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>";
        echo "<form action='../features/admin/edit_user_account.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Edit'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form action='../features/admin/delete_user_account.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
}
?>
</table>
</main>

</body>
</html>

