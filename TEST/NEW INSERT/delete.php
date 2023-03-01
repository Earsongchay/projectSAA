<?php 
include("../../pages/db_connect.php");
$id = $_REQUEST['id'];
$sql = "DELETE FROM movies WHERE movie_id = $id";
mysqli_query($connection,$sql);
?>