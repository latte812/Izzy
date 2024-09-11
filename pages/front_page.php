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
  <form method="post" action="../features/user/add_song.php">
    <input type="submit" value="Add song">
  </form>

  <form method="post" action="../features/sign_out.php">
    <input type="submit" value="Sign out">
  </form>
</div>
</header>

<main>
<div id="gallery">
<?php
$user_id = $user['id'];
$sql = "SELECT id, title, cover FROM songs WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div class='song'>";
    echo '<img src="' . $row['cover'] . '">';
    echo '<h3>' . $row['title'] . '</h3>';
    echo "<div class='song-option'>";
    echo '<a href="song_info.php?id=' . $row['id'] . '"><button>View</button></a>';
    echo '<form method="POST" action="../features/user/remove_song.php">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<input type="submit" value="Remove">';
    echo '</form>';
    echo "</div>";
    echo "</div>";
}
?>
</div>    
</main>

</body>
</html>
