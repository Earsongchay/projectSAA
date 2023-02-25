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
                $count = 1;
                $id = $_REQUEST['movie_id'];
                $sql_branch = 'SELECT distinct branch_name,bh.branch_id FROM scheduledetails sd JOIN branches_halls bh on bh.hall_branch_id = sd.hall_branch_id JOIN branches b on bh.branch_id = b.branch_id
                                WHERE sd.movie_id =' . $id . ' AND end_time > NOW();';
                $result_branch = $connection->query($sql_branch);
                while ($branch = $result_branch->fetch_assoc()) { ?>
                    <div class="widget">
                        <div class="all logo">
                            <div id="logo">
                                <img src="../image/bird-logo.png" alt="">
                            </div>
                        </div>
                        <?php
                        $branch_name = $branch['branch_name'];
                        $sql_hall = "SELECT hall_name from halls h join branches_halls bh on h.hall_id = bh.hall_id join scheduledetails sd on sd.hall_branch_id = bh.hall_branch_id join branches b on bh.branch_id = b.branch_id
                                     WHERE sd.movie_id = $id and end_time > now() and b.branch_name = '$branch_name' ";
                        $result_hall = $connection->query($sql_hall);
                        ?>
                        <div class="schedule-list">
                            <div class="location"><?php echo $branch_name ?></div>
                            <div class="theatre-list">
                                <?php
                                while ($hall = $result_hall->fetch_assoc()) {
                                    $hall_name = $hall['hall_name']; ?>
                                    <div class="theatre"><?php echo $hall_name ?></div>
                                    <ul>
                                        <?php
                                        $sql_st = "SELECT start_time ,sd.scheduleDetail_id FROM scheduledetails sd JOIN branches_halls bh ON sd.hall_branch_id = bh.hall_branch_id JOIN branches b ON b.branch_id=bh.branch_id
                                            JOIN halls h ON h.hall_id=bh.hall_id LEFT JOIN bookingdetails bd
                                            ON bd.scheduleDetail_id = sd.scheduleDetail_id WHERE movie_id=$id AND start_time>NOW() AND branch_name='$branch_name' AND hall_name='$hall_name'";
                                        $result_start_time = $connection->query($sql_st);
                                        if ($result_start_time->num_rows > 0) {
                                            while ($st = $result_start_time->fetch_assoc()) { ?>
                                                <li><a id="<?php echo $count; ?>" <?php $sdBooked = $st['scheduleDetail_id']; ?> value="<?php echo $sdBooked; ?>" href="seat.php?scheduleID=<?php echo $sdBooked ?>"><?php $time = $st['start_time'];
                                                                                                                                                                                                                        $count += 1;
                                                                                                                                                                                                                        echo date('h:i a', strtotime($time)); ?></a></li>
                                        <?php
                                            }
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
        </div>
    </div>
</body>

</html>