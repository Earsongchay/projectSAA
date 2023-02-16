<?php
error_reporting(0);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {

	
	$title = $_POST['txt_title'];
	$durations = $_POST['txt_durations'];
	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "../image/" . $filename;
	$categorie = $_POST['categorie'];
	$db = mysqli_connect("localhost", "root", "", "db_movies");

	// Get all the submitted data from the form
	$sql = "INSERT INTO movies (movie_title, durations, movie_image, categorie_id) VALUES ('$title','$durations','$filename','$categorie')";

	// Execute query
	mysqli_query($db, $sql);

	// Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
		echo $categorie;
		echo $title;
		echo $durations;
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
	<link rel="stylesheet" type="text/css" href="style.css" />
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

				<label for="exampleFormControlSelect1">Movie Categories</label>
				<select class="form-control" id="exampleFormControlSelect1" name="categorie" >
					<?php while ($row = $result->fetch_assoc()) { ?>
						<option value="<?php echo $row['categorie_id'] ?>"> <?php echo $row['categorie_name'] ?></option>
					<?php }
					?>
				</select>

			<?php }
			?>

			<div class="form-group">
				<input class="form-control" type="text" name="txt_title" value="" />
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="txt_durations" value="" />
			</div>
			<div class="form-group">
				<input class="form-control" type="file" name="uploadfile" value="" />
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
			</div>
		</form>
	</div>

</body>

</html>