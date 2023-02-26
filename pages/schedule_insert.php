<?php
error_reporting(0);
include("db_connect.php");
$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
	$end_date = $_POST['End_date'];
	$end_date = date( 'y-m-d H:i:s',strtotime($end_date));
	$start_date = $_POST['Start_date'];
	$start_date = date( 'Y-m-d h:i:s',strtotime($start_date));
	if ($start_date < date("Y-m-d H:i:s")) {
		print("<h1>Start Date must be in the future. Thanks!</h1>");
		echo $start_date . "<br>";
		echo date("Y/m/d H:i:s");
		goto A;
	}
	$hall_id = $_POST['hall_id'];
	$branch_id = $_POST['branch_id'];
	$movie_id = $_POST['movie_id'];


	$sql = 'SELECT hall_branch_id FROM Branches_Halls WHERE
	branch_id=' . $branch_id . ' and hall_id =' . $hall_id;
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();
	$hall_branch_id = $row['hall_branch_id'];
	$sql = "INSERT INTO scheduledetails (scheduleDetail_id, schedule_id, movie_id, start_time, end_time, 	hall_branch_id) VALUES (NULL, NULL,$movie_id,'$start_date','$end_date',$hall_branch_id)";
	mysqli_query($connection,$sql);


	echo '<h1>Sucessfully Insert into Schedule Details</h1><br>';
	echo 'Sql :' . $sql . '<br>';
	echo 'schedule_id : ' . $schedule_id . "<br>";
	echo 'branch_id : ' . $branch_id . "<br>";
	echo 'hall_id : ' . $hall_id . "<br>";
	echo 'hall_branch_id : ' . $hall_branch_id . "<br>";
	echo 'end_date : ' . $end_date . "<br>";
	echo 'movie_id : ' . $movie_id . "<br>";
	echo  'start_date : ' . $start_date;
	A:
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


			$sql = "SELECT branch_id, branch_name FROM branches";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
			?>

				<select class="form-control" id="exampleFormControlSelect1" name="branch_id">
					<?php while ($row = $result->fetch_assoc()) { ?>
						<option value="<?php echo $row['branch_id'] ?>"> <?php echo $row['branch_name'] ?></option>
					<?php }
					?>
				</select>
			<?php }
			?>
			<br>
			<?php
			$sql = "SELECT movie_id, movie_title FROM movies";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
			?>
				<select class="form-control" id="exampleFormControlSelect1" name="movie_id">
					<?php while ($row = $result->fetch_assoc()) { ?>
						<option value="<?php echo $row['movie_id'] ?>"> <?php echo $row['movie_title'] ?></option>
					<?php }
					?>
				</select>
			<?php }
			?>
			<br>
			<?php
			$sql = "SELECT hall_id, hall_name FROM halls";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
			?>
				<select class="form-control" id="exampleFormControlSelect1" name="hall_id">
					<?php while ($row = $result->fetch_assoc()) { ?>
						<option value="<?php echo $row['hall_id'] ?>"> <?php echo $row['hall_name'] ?></option>
					<?php }
					?>
				</select>
			<?php }
			?>
			<br>
			<label>Start time</label>
			<div class="form-group">
				<input class="form-control" type="datetime-local" name="Start_date" />
			</div>
			<label>End time</label>
			<?php

			?>
			<div class="form-group">
				<input class="form-control" type="datetime-local" name="End_date" />
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
			</div>
		</form>
	</div>

</body>

</html>