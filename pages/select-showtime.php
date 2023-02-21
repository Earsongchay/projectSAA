<?php
include("db_connect.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/movie-detail.css">
    <title>Cinema Details</title>
</head>

<body>

    <body>
        <div id="main">
            <div id="nav">
                <ul>
                    <li><a href="/movie-detail.html">Movie</a></li>
                    <li><a href="#">Cinemas</a></li>
                    <li><a href="#">Promotion</a></li>
                    <li><a href="#">News & Activities</a></li>
                    <li><a href="#">Contact us</a></li>
                </ul>
            </div>
            <div id="nav-seat">
                <ul>
                    <li><a href="#">SELECT SHOWTIME</a></li>
                    <li><a href="#">SELECT SEAT(S)</a></li>
                    <li><a href="#">RESERVE | BUY</a></li>
                </ul>
            </div>
            <div id="select-showtime-details">
                <div id="showtime-details">
                    <?php
                    $id = $_REQUEST['movie_id'];
                    $sql_branch = 'SELECT branch_name,bh.branch_id
                            FROM scheduledetails sd
                            JOIN branches_halls bh on bh.hall_branch_id = sd.hall_branch_id
                            JOIN branches b on bh.branch_id = b.branch_id
                            WHERE sd.movie_id =' . $id . ' AND end_time > NOW();';
                    $result_branch = $connection->query($sql_branch);
                    while ($branch = $result_branch->fetch_assoc()) {
                    ?>
                        <div class="widget">
                            <div class="all logo">
                                <div id="logo">
                                    <img src="../image/bird-logo.png" alt="">
                                </div>
                            </div>
                            <?php
                            $branch_name = $branch['branch_name'];
                            $sql_hall = "SELECT hall_name from halls h join branches_halls bh on h.hall_id = bh.hall_id join scheduledetails sd on sd.hall_branch_id = bh.hall_branch_id join branches b on bh.branch_id = b.branch_id
                            where sd.movie_id = $id and end_time > now() and b.branch_name = '$branch_name' ";
                            $result_hall = $connection->query($sql_hall);
                            ?>
                            <div class="schedule-list">
                                <div class="location"><?php echo $branch_name ?></div>
                                <div class="theatre-list">
                                    <?php
                                    while ($hall = $result_hall->fetch_assoc()) {
                                        $hall_name = $hall['hall_name'];
                                    ?>
                                        <div class="theatre"><?php echo $hall_name ?> </div>
                                        <ul><?php
                                            $sql_st = "SELECT start_time from halls h join branches_halls bh on h.hall_id = bh.hall_id join scheduledetails sd on sd.hall_branch_id = bh.hall_branch_id where sd.movie_id = $id and end_time > now() and hall_name = '$hall_name'";
                                            $result_start_time = $connection->query($sql_st);
                                            if ($result_start_time->num_rows > 0) {
                                                while ($st = $result_start_time->fetch_assoc()) {
                                            ?>
                                                    <li><a href="#"><?php $time = $st['start_time'];
                                                                    echo date('h:i a', strtotime($time))
                                                                    ?></a></li>
                                            <?php }
                                            }
                                            ?>
                                        </ul>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>


                <div id="summary-details">
                    <div id="summary">Summary</div>

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
                    if (isset($_GET["movie_id"])) {
                        $id = $_GET["movie_id"];
                        echo $id;

                        $sql = "SELECT movie_title, durations, movie_image,categorie_id  FROM movies where movie_id = $id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            $row = $result->fetch_assoc() ?>

                            <div id="box">
                                <div id="image"><img src="../image/<?php echo $row['movie_image']; ?>" alt=""></div>
                                <div id="description">
                                    <div id="title"> <?php echo $row['movie_title'] ?> </div>
                                    <div id="schedule"><big><b>Showtime</b></big> <br> <small> ---- <br> 12th June 2022</small></div>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>

                    <div id="seat">SEAT(s)&nbsp &nbsp &nbsp &nbsp :&nbsp &nbsp<div id="selected-seat"> F4, F5, F6</div>
                    </div>
                    <div id="total">TOTAL Price &nbsp: &nbsp $<div id="total-price">17</div>
                    </div>

                    <div id="customer-info">
                        Customer Information
                        <form>
                            <input type="text" class="name" placeholder="FIRST NAME">
                            <input type="text" class="name" placeholder="LAST NAME">
                            <input type="text" class="name" placeholder="PHONE NUMBER">
                            <input type="text" class="name" placeholder="EMAIL">
                        </form>
                    </div>
                    <div id="btn">
                        <a href="#" id="payment">PAYMENT</a>
                        <a href="#" id="reserve">RESERVE</a>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>