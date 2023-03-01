<?php
error_reporting(0);

$msg = "";
function hoursandmins($time)
{
	if ($time < 1) {
		return;
	} else {
		$hour = floor($time / 60);
		$min = ($time % 60);
		if ($min == 1) {
			$format = '%01dh %02d minute';
		} else {
			$format = '%01dh %02d minutes';
			if ($hour < 1) {
				$format = '%02d minutes';
				return sprintf($format, $min);
			}
		}
		return sprintf($format, $hour, $min);
	}
}
// If upload button is clicked ...
if (isset($_POST['upload'])) {
	$title = $_POST['txt_title'];
	$durations = $_POST['txt_durations'];
	$durations = hoursandmins($durations);
	$rating = $_POST['rating'];
	$description = $_POST['description'];
	$release_date = $_POST['release_date'];
	$release_date = date('Y-m-d', strtotime($release_date));
	$url_trailer = $_POST['url_trailor'];
	$movie_status = $_POST['movie_status'];
	//escape single quote

	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "../image/" . $filename;
	$categorie = $_POST['categorie'];
	$db = mysqli_connect("localhost", "root", "", "db_movies");
	$description = mysqli_real_escape_string($db, $description);
	$title = trim($title);
	$sql = "INSERT INTO movies (movie_title, durations, movie_image, categorie_id,rating,description,release_date,movie_status,url_trailer) VALUES ('$title','$durations','$filename',$categorie,$rating,'$description','$release_date','$movie_status','$url_trailer')";
	// Execute query
	mysqli_query($db, $sql);

	// Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
		echo $categorie . "<br>";
		echo $title . "<br>";
		echo $durations . "<br>";
		echo $description . "<br>";
		echo $rating . "<br>";
		echo $movie_status . "<br>";
		echo $release_date . "<br>";
		echo $url_trailor . "<br>";
		echo $sql;
	} else {
		echo "<h3> Failed to upload image!</h3>";
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Image Upload</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<style>
		#content {
			background-color: aqua;
			padding: 20px;
			margin: 50px 50px;
			border-radius: 15px;
		}
	</style>
</head>

<body>
	<div id="content">
		<form method="POST" action="" enctype="multipart/form-data">

			<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "db_movies";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}


			$sql = "SELECT categorie_id, categorie_name  FROM categories";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
			?>

				<select class="form-control" id="exampleFormControlSelect1" name="categorie">
					<?php while ($row = $result->fetch_assoc()) { ?>
						<option value="<?php echo $row['categorie_id'] ?>"> <?php echo $row['categorie_name'] ?></option>
					<?php }
					?>
				</select>
			<?php }
			?>
			<br>
			<div class="form-group">
				<input class="form-control" type="text" name="txt_title" placeholder="Title" />
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="txt_durations" placeholder="How many minutes long are the movies?" />
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="rating" placeholder="rating" />
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="description" placeholder="description" />
			</div>
			<div class="form-group">
				<input class="form-control" type="date" name="release_date" placeholder="release date" />
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="url_trailor" placeholder="url trailor" />
			</div>
			<select class="form-control" id="exampleFormControlSelect1" name="movie_status">
				<option value="up coming">up coming</option>
				<option value="now showing">now showing</option>
			</select><br>

			<div class="form-group">
				<input class="form-control" type="file" name="uploadfile" placeholder="file" />
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
			</div>
		</form>
	</div>

</body>

</html>