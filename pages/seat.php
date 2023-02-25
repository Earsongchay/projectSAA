<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_movies";
$sdBooked = $_REQUEST['scheduleID'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT h.seat_id ,rows_number, seat_number FROM seats 
JOIN halls h ON h.seat_id = seats.seat_id JOIN Branches_Halls bh ON bh.hall_id = h.hall_id JOIN scheduleDetails sd ON sd.hall_branch_id = bh.hall_branch_id
WHERE sd.scheduledetail_id = $sdBooked";
$result = $conn->query($sql);
?>
<html>

<head>
    <title>
        <Select>seat</Select>
    </title>
    <link rel="stylesheet" href="../css/movie-detail.css">
</head>

<body>
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
            <li><a href="#" id="first">SELECT SHOWTIME</a></li>
            <li><a href="#" id="second">SELECT SEAT(S)</a></li>
            <li><a href="#">RESERVE | BUY</a></li>
        </ul>
    </div>
    <div id="whole-main">
        <div id="hall">
            <div id="trapezoid"></div>
            <table id="table">
                <?php
                $row_r = "";
                $row_c = "";
                if ($result !== false && $result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        for ($i = 1; $i < $row['rows_number'] + 1; $i++) { ?>
                            <tr id="row" value="<?php echo $i ?>">
                                <?php
                                for ($j = 1; $j < $row['seat_number'] + 1; $j++) { ?>
                                    <td id="col">
                                        <div id=<?php echo $i . $j ?>></div>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        } ?>
                        <div id="row" value="<?php $row_r = $row['rows_number'];
                                                echo $row['rows_number']; ?>"></div>
                        <div id="col" value="<?php $row_c = $row['seat_number'];
                                                echo $row['seat_number']; ?>"> </div>
                <?php }
                } ?>

            </table>
            <?php
            $sql = "SELECT seats_booked ,sd.scheduledetail_id FROM seats s join halls h ON s.seat_id=h.seat_id JOIN branches_halls bh ON bh.hall_id = h.hall_id JOIN  scheduledetails sd ON sd.hall_branch_id = bh.hall_branch_id JOIN bookingDetails bd 
                ON sd.scheduledetail_id= bd.scheduledetail_id WHERE sd.scheduledetail_id =$sdBooked";
            $result = $conn->query($sql);
            $seats_booked = '';
            while ($row = $result->fetch_assoc()) {
                $seats_booked .= $row['seats_booked'];
            } ?><div id="bseat" value="<?php echo $seats_booked ?>"></div>
            <link rel="stylesheet" href="../../css/movie-detail.css">
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
            $sql = "SELECT movie_title, durations, movie_image,categorie_id  FROM movies m join scheduleDetails sd ON m.movie_id = sd.movie_id WHERE scheduleDetail_id = $sdBooked;";
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
            ?>
            <div id="seat">SEAT(s)&nbsp &nbsp &nbsp &nbsp :&nbsp &nbsp<div id="selected-seat"> ...</div>
            </div>
            <div id="total">TOTAL Price &nbsp: &nbsp <div id="total-price">17</div>
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
    <script>
        var booked = document.getElementById('bseat').getAttribute('value').split(",");
        var r = [];
        var c = [];
        let table = document.getElementById('table');
        var col = document.getElementById('col').getAttribute('value');
        var row = document.getElementById('row').getAttribute('value');
        console.log(booked);
        var booked_seats = [];
        var count = 0;
        var b = [];
        var book_c = 0,
            book_r = 0;


        for (let i = 0; i < booked.length; i++) {
            if (booked[i].charAt(0) == 'A') {
                r[i] = 1;
                c[i] = booked[i].replace('A', '');
            } else if (booked[i].charAt(0) == 'B') {
                r[i] = 2;
                c[i] = booked[i].replace('B', '');
            } else if (booked[i].charAt(0) == 'C') {
                r[i] = 3;
                c[i] = booked[i].replace('C', '');
            } else if (booked[i].charAt(0) == 'D') {
                r[i] = 4;
                c[i] = booked[i].replace('D', '');
            } else if (booked[i].charAt(0) == 'E') {
                r[i] = 5;
                c[i] = booked[i].replace('E', '');
            } else if (booked[i].charAt(0) == 'F') {
                r[i] = 6;
                c[i] = booked[i].replace('F', '');
            } else if (booked[i].charAt(0) == 'G') {
                r[i] = 7;
                c[i] = booked[i].replace('G', '');
            }

        }
        var search = [];
        for (let i = 0; i < r.length; i++) {
            search[i] = r[i] + '' + c[i];
        }


        <?php
        for ($i = 1; $i <= $row_r; $i++) {
            for ($j = 1; $j <= $row_c; $j++) { ?>
                <?php {

                ?>
                    b['<?php echo $i . $j; ?>'] = document.getElementById('<?php echo $i . $j; ?>');

                    b['<?php echo $i . $j; ?>'].addEventListener("click", (e) => {

                        b['<?php echo $i . $j; ?>'].classList.toggle('active');
                        if (b['<?php echo $i . $j; ?>'].classList.contains('active') && !b['<?php echo $i . $j; ?>'].classList.contains('sold')) {
                            book_r = <?php echo $i ?>;
                            book_c = <?php echo $j ?>;
                            if (book_r == 1) {
                                book_r = "A"
                            } else if (book_r == 2) {
                                book_r = "B"
                            } else if (book_r == 3) {
                                book_r = "C"
                            } else if (book_r == 4) {
                                book_r = "D"
                            } else if (book_r == 5) {
                                book_r = "E"
                            } else if (book_r == 6) {
                                book_r = "F"
                            } else {
                                book_r = "G"
                            }
                            booked_seats.push(`${book_r}${book_c}`);
                            count++;
                            document.getElementById('seat').innerHTML = booked_seats.sort()
                            document.getElementById('total-price').innerHTML = count;
                        } else if (b['<?php echo $i . $j; ?>'].classList.contains('sold')) {
                            alert("This seat is unavailable.");
                        } else {
                            booked_seats.pop(`${book_r}${book_c}`);
                            document.getElementById('seat').innerHTML = booked_seats.sort()
                            count--;
                            document.getElementById('total-price').innerHTML = count;
                        }
                    });
        <?php }
            }
        } ?>

        for (let i = 1; i <= row; i++) {
            for (let j = 1; j <= col; j++) {
                if (search[j - 1] == i + '' + j) {
                    var z = document.getElementById(search[j - 1]);
                    z.classList.add('sold');
                }
            }
        }
    </script>
</body>

</html>