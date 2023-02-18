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
                    <div class="widget">
                        <?php
                        $id = $_REQUEST['movie_id'];
                        $sql2 = 'SELECT bh.hall_branch_id,
                            bh.branch_id,
                            bh.hall_id,
                            movie_title,
                            rating,
                            start_time,
                            end_time,
                            hall_name,
                            hall_type,
                            branch_name
                            from scheduledetails sd
                            join branches_halls bh on bh.hall_branch_id = sd.hall_branch_id
                            join movies m on sd.movie_id = m.movie_id
                            JOIN branches b on bh.branch_id = b.branch_id
                            join halls h on h.hall_id = bh.hall_id
                            where sd.movie_id =' . $id . ' AND end_time > NOW();';
                        $result = $connection->query($sql2);
                        while ($branch = $result->fetch_assoc()) {
                        ?>
                            <div class="all logo">
                                <div id="logo">
                                    <img src="../image/bird-logo.png" alt="">
                                </div>
                            </div>
                            <div class="schedule-list">
                                <?php
                                $result = $connection->query($sql2);
                                while ($hall = $result->fetch_assoc()) {
                                ?>
                                    <div class="location"><?php $branch_name = $branch['branch_name'];
                                                            echo $branch_name ?></div>
                                    <div class="theatre-list">
                                        <div class="theatre"><?php echo $hall['hall_name'] ?> </div>
                                        <ul><?php
                                            $result = $connection->query($sql2);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <li><a href="#"><?php $time = $row['start_time'];
                                                                    echo date('h:i a', strtotime($time)) ?></a></li>
                                                <?php } ?>
                                        </ul>
                                    </div>
                            </div>
                <?php   }
                                        }
                                    } ?>
                    </div>
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