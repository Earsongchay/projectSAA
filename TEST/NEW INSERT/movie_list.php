<?php
include("../../pages/db_connect.php");
if (isset($_REQUEST['EDIT'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 600;
            background-color: beige;
        }

        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        table,
        tr,
        td,
        th {
            border: 1px dashed;
            border-collapse: collapse;
            padding: 10px;
            background-color: blanchedalmond;
        }

        td div {
            width: 200px;
            background-color: blanchedalmond;
        }

        #edit {

            background-color: red;
            color: white;
            margin-right: 3px;
        }

        a {
            border-radius: 5px;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid white;
            cursor: pointer;
        }

        #delete {
            background-color: yellow;
            color: black;
            margin-right: 3px;
        }
    </style>
</head>

<body>
    <h1><a href="../../pages/create.php">Add New Movies</a></h1>
    <center>
        <table>
            <?php
            $sql = "SELECT * FROM movies";
            $result = mysqli_query($connection, $sql);
            if ($result->num_rows > 0) {

                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Title</th>";
                echo "<th>Duration</th>";
                echo "<th>Image</th>";
                echo "<th>Category ID</th>";
                echo "<th>Release Date</th>";
                echo "<th>Status</th>";
                echo "<th>Description</th>";
                echo "<th>Change</th>";
                echo "</tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["movie_id"] . "</td>";
                    echo "<td>" . $row["movie_title"] . "</td>";
                    echo "<td>" . $row["durations"] . "</td>";
                    echo "<td>" . $row["movie_image"] . "</td>";
                    echo "<td>" . $row['categorie_id'] . "</td>";
                    echo "<td>" . $row["release_date"] . "</td>";
                    echo "<td>" . $row["movie_status"] . "</td>";
                    echo "<td><div>" . $row["description"] . "<div></td>";
                    echo "<td><a id='edit' href='edit_movie.php?id=" . $row['movie_id'] . "'/>EDIT</a><a id='delete' href='delete.php?id=" . $row['movie_id'] . "'>DELETE</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_close($connection);
            }
            ?>
        </table>
    </center>
</body>

</html>