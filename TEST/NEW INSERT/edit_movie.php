<?php
include("../../pages/db_connect.php");
$id = $_REQUEST['id'];
$sql = "SELECT * FROM movies WHERE movie_id = $id";
$result = mysqli_query($connection, $sql);
$row = $result->fetch_assoc();
$old_img = $row['movie_image'];

if (isset($_REQUEST['submit'])) {
    $title = $_POST['title'];
    $durations = $_POST['durations'];
    $rating = $_POST['rating'];
    $description = $_POST['des'];
    $release_date = $_POST['date'];
    $release_date = date('Y-m-d', strtotime($release_date));
    $url_trailer = $_POST['url'];
    $movie_status = $_POST['status'];
    $categorie = $_POST['categorie'];



    $filename = $_FILES["uploadposter"]["name"];
    $tempname = $_FILES["uploadposter"]["tmp_name"];
    $folder = "../../image/" . $filename;
    //escape quotes
    $description = mysqli_real_escape_string($connection, $description);

   $sql = "UPDATE movies SET movie_title = '$title', durations = '$durations', movie_image = '$filename', categorie_id = '$categorie', rating = '$rating', description = '$description', movie_status = '$movie_status', release_date = '$release_date', url_trailer = '$url_trailer' WHERE movies.movie_id = $id";
    // Execute query
   mysqli_query($connection, $sql);
    if (move_uploaded_file($tempname, $folder))
        unlink("../../image/$old_img");
    echo "SUCESSFUL";
}
?>
<title>Update</title>
<style>
    body {
        background-color: cadetblue
    }

    * {
        border-radius: 10px;
    }

    div {
        background-color: burlywood;
        width: 500px;
        height: 1000px;
        font-size: 1.25em;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
        display: flex;
        text-align: left;
    }

    input,
    select,
    textarea,
    button {
        font-size: 1em;
        width: 100%;
        padding: 5px 10px;
        display: flex;
        justify-content: space-around;
        flex-direction: row;
    }

    h1 {
        text-align: center;
        width: 100%;
    }
</style>
<center>
    <H1><a href="movie_list.php">GO BACK</a></H1>
    <div>
        <Form method="post" enctype="multipart/form-data">
            <label for="title">Title : </label>
            <input type="text" name="title" value="<?php echo $row['movie_title']; ?>">
            </br>
            <label for="">Duration : </label>
            <input type="text" name="durations" value="<?php echo $row['durations']; ?>">
            </br>
            <label for="">Rating :</label>
            <input type="text" name="rating" value="<?php echo $row['rating']; ?>">
            </br>
            <label for="des">Description :</label>
            <textarea name="des" cols="50" rows="5"><?php echo $row['description'] ?></textarea>
            </br>
            <label for="status">Status :</label>
            <select name="status" id="">
                <option value="Up Coming">Up Coming</option>
                <option value="now showing">now showing</option>
            </select><br>
            <label for="date">Release Date :</label>
            <input type="date" name="date" id="" value="<?php echo $row['release_date']; ?>">
            </br>
            <label for="url">Trailer :</label>
            <textarea type="text" name="url" cols="50" rows="5"><?php echo $row['url_trailer']; ?></textarea>
            </br>
            <label for="">POSTER : </label>
            <input type="file" name="uploadposter">
            </br>
            <?php
            $sql = "select * from categories";
            $result = mysqli_query($connection, $sql); ?>
            <label for="Genre">Genre :</label>
            <select name="categorie">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <option value="<?php echo $row['categorie_id'] ?>"> <?php echo $row['categorie_name'] ?></option><?php } ?>
            </select>
            </br>
            <button name="submit">CONFIRM</button>
        </Form>
    </div>
</center>