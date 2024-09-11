<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Song</title>
</head>

<style>
body {
  background-color: #fbf1c7;
}

#metadata {
  display: flex;
  flex-wrap: wrap;
  width: 80%;
  gap: 20px;
}

img {
  width: 100%;
  max-width: 400px;
  height: auto;
  object-fit: contain;
}

label {
  font-weight: bold;
  margin-bottom: 10px;
}

input[type="text"],
input[type="number"],
textarea {
  margin-bottom: 5px;
  background-color: #3d3832;
  color: white;
  border: none;
  outline: none;
  border-radius: 5px;
  padding: 5px;
  width: 100%;
}

input[type="file"] {
  margin-bottom: 10px;
}

textarea {
  margin-top: 10px;
  height: 200px; 
  resize: vertical;
}

input[type="submit"], button {
  background-color: #3d3832;
  color: #fbf1c7;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px; font-weight: bold; transition: background-color  
 0.2s ease-in-out;
  margin-top: 20px;
}

input[type="submit"]:hover, button:hover {
  background-color: #b8bb26;
}

button a {
  text-decoration: none;
  color: #fbf1c7;
}
</style>

<body>
<div>
    <form method="post" enctype="multipart/form-data">
        <div id="metadata">
          <div id="cover">
            <label for="cover">Cover Image:</label><br>
            <img src="../../images/default.png" alt="Cover Image" id="cover-image"><br>
            <input type="file" id="cover" name="cover" >
          </div>
          <div id="other-metadata">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title"><br>
            <label for="artist">Artist:</label><br>
            <input type="text" id="artist" name="artist"><br>
            <label for="album">Album:</label><br>
            <input type="text" id="album" name="album"><br>
            <label for="release_year">Release year:</label><br>
            <input type="number" id="release_year" name="release_year"><br>
            <label for="genre">Genre:</label><br>
            <input type="text" id="genre" name="genre"><br>
            <textarea id="lyrics" name="lyrics"></textarea><br>
          </div>
        </div>
        <input type="submit" name="Submit" value="Submit">
    </form>
        <button><a href="../../pages/front_page.php">Home</a></button>

</div>


<?php
require '../../connection/session_start.php';

if (isset($_POST['Submit'])) {
    $user_id = $user['id'];
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $lyrics = $_POST['lyrics'];
    if ($_FILES['cover']['error'] != UPLOAD_ERR_NO_FILE) {
        $cover = "../images/" . $_FILES['cover']['name'];
    } else {
        $cover = "../images/default.png";
    }

    $stmt = $conn->prepare("INSERT INTO songs (user_id, title, artist, album, release_year, genre, lyrics, cover) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssisss", $user_id, $title, $artist, $album, $release_year, $genre, $lyrics, $cover);

    if ($stmt->execute() === true) {
        echo "<b>Song added successfully</b>";
    } else {
        echo "Error: " . $stmt->error;
    }

}
?>

<script>
    const coverInput = document.getElementById('cover');
    const coverImage = document.querySelector('#cover img');

    coverInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                coverImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>


