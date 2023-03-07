<?php
include('../../db_connect.php');
//reserve

$sdBooked = $_REQUEST['scheduleID'];
$branch = "";
$hall = "";
$title = "";
if (isset($_REQUEST['reserve'])) {
    $phone = $_REQUEST['phone_number'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    echo $first_name . $last_name . $phone;
    $date_issue = date('Y-m-d h:i:s');
    $subject = "SS11 CINEMA TICKET ";
    $header = "earsongchay@gmail.com";
    $to = $_COOKIE['email'];
    $ticket = $_COOKIE['seat'];
    $amount = str_replace('$', '', $_COOKIE['amount']);
    $message = "Thank you very much. You've ordered ticket(s) for <b>" . $title . "</b> at " . $branch . ". \r\nTicket : $ticket\r\nHall : " . $hall . "";
    $message .= "\r\nAnd please see the counter to check the bill.";
    //mail($to, $subject, $message);
    $sql = "INSERT INTO bookingdetails (bookingDetail_id, amount, issueDate, seats_booked, scheduleDetail_id,status) VALUES (NULL,$amount ,'$date_issue', '$ticket', $sdBooked,'Reserved');";

    if (str_contains($to, '@') && $phone && $last_name && $first_name) {
        mysqli_query($connection, $sql);
        header("Location: /movies/Movies/pages/");
        setcookie('email', null, -1);
        setcookie('amount', null, -1);
        setcookie('seat', null, -1);
        exit();
    } else {
        header("Location: /movies/Movies/pages/seat.php?scheduleID=$sdBooked");
        exit();
    }
}
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
$sql = "SELECT h.seat_id ,rows_number, seat_number FROM seats
JOIN halls h ON h.seat_id = seats.seat_id JOIN Branches_Halls bh ON bh.hall_id = h.hall_id JOIN scheduleDetails sd ON sd.hall_branch_id = bh.hall_branch_id
WHERE sd.scheduledetail_id = $sdBooked";
$result = $conn->query($sql);
?>
<html>

<head>
    <title>
        SELECT YOUR SEAT
    </title>
    <link rel="stylesheet" href="../../../css/movie-detail.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <div id="nav">
        <ul>
            <li><a href="index.php">Movie</a></li>
            <li><a href="index.php">Cinemas</a></li>
            <li><a href="index.php">Promotion</a></li>
            <li><a href="index.php">News & Activities</a></li>
            <li><a href="index.php">Contact us</a></li>
        </ul>
    </div>
    <div id="nav-seat">
        <ul>
            <li><a href="#" id="first">SELECT SHOWTIME</a></li>
            <li><a href="#" id="second">SELECT SEAT(S)</a></li>
            <li><a href="#" id="third">RESERVE | BUY</a></li>
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
            $count = 1;
            while ($row = $result->fetch_assoc()) {
                if ($count <= 1) {
                    $seats_booked .= $row['seats_booked'];
                } else {
                    $seats_booked .= "," . $row['seats_booked'];
                }
                $count++;
            } ?><div id="bseat" value="<?php echo $seats_booked ?>"></div>
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
            $ticketPrice = "";
            $sql = "SELECT movie_title,branch_name,start_time,hall_name, durations,ticket_price, movie_image,categorie_id  FROM movies m join scheduleDetails sd ON m.movie_id = sd.movie_id JOIN branches_halls bh ON bh.hall_branch_id = sd.hall_branch_id JOIN Branches b ON b.branch_id = bh.branch_id JOIN halls h ON h.hall_id=bh.hall_id WHERE scheduleDetail_id = $sdBooked;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
                $ticketPrice = $row['ticket_price'];
                $branch = $row['branch_name'];
                $hall = $row['hall_name'];
                $title = $row['movie_title'];
            ?>
                <div id="box">
                    <div id="image"><img src="../../../image/<?php echo $row['movie_image']; ?>" alt=""></div>
                    <div id="description">
                        <div id="title"> <?php echo $row['movie_title'] ?> </div>
                        <div id="schedule"><big><b>Showtime</b></big> <br> <br><small> <?php echo $row['branch_name'];  ?> <br><?php echo date('d M Y  h:i a', strtotime($row['start_time'])) ?></small></div>
                    </div>
                </div>
            <?php }
            ?>
            <div id="seat">SEAT(S) &nbsp &nbsp &nbsp: &nbsp &nbsp &nbsp<div id="selected-seat"> ...</div>
            </div>
            <div id="total">TOTAL PRICE &nbsp: &nbsp <div id="total-price">...</div>
            </div>
            <div id="customer-info">
                Customer Information
                <form method="post">
                    <input type="text" class="name" name="first_name" placeholder="FIRST NAME">
                    <input type="text" class="name" name="last_name" placeholder="LAST NAME">
                    <input type="text" class="name" name="phone_number" placeholder="PHONE NUMBER">
                    <input type="text" class="name" id="email" name="email" placeholder="EMAIL">
            </div>
            <div id="btn">
                <button id="reserve" name="reserve">RESERVE</button>
                </form>
                <form action="http://localhost/projectssa/projectSAA/pages/payment/public/checkout.php?id=<?php echo $sdBooked ?>" method="post">
                    <button type="submit" id="checkout-button">PAY NOW</button>
                </form>

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
        var btnReserve = document.getElementById('reserve');

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
        console.log(search);

        function showOnBtn() {
            document.getElementById('third').style.backgroundColor = 'white';
            document.getElementById('third').style.color = 'hsl(228, 13%, 15%)';
            document.getElementById('checkout-button').style.opacity = '1';
            btnReserve.style.opacity = '1';
            document.getElementById('checkout-button').style.pointerEvents = "all";
            btnReserve.style.pointerEvents = "all";
        }

        function hideOnBtn() {
            document.getElementById('third').style.backgroundColor = 'hsl(228, 13%, 15%)';
            document.getElementById('third').style.color = 'white';
            document.getElementById('checkout-button').style.opacity = '0';
            btnReserve.style.opacity = '0';
        }
        var selectedSeat = document.getElementById('selected-seat').innerHTML;
        var totalPrice = document.getElementById('total-price').innerHTML;
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
                            document.getElementById('selected-seat').innerHTML = booked_seats.sort()
                            document.getElementById('total-price').innerHTML = '$' + count * '<?php echo $ticketPrice ?>';
                            if (count != 0) {
                                showOnBtn();
                            } else {
                                hideOnBtn();
                            }
                            document.cookie = "amount=" + document.getElementById('total-price').innerHTML;
                            document.cookie = "seat=" + booked_seats;
                        } else if (b['<?php echo $i . $j; ?>'].classList.contains('sold')) {
                            alert("This seat is unavailable.");
                        } else {
                            booked_seats.pop(`${book_r}${book_c}`);
                            document.getElementById('selected-seat').innerHTML = booked_seats.sort()
                            count--;
                            document.getElementById('total-price').innerHTML = '$' + count * '<?php echo $ticketPrice ?>';
                            if (count == 0) {
                                hideOnBtn()
                            } else {
                                showOnBtn();
                            }
                            document.cookie = "amount=" + totalPrice;
                            document.cookie = "seat=" + booked_seats;
                        }
                    });
        <?php }
            }
        } ?>

        var k = "";
        search.sort();
        for (let i = 1; i <= r.length; i++) {
            for (let j = 1; j <= c.length; j++) {
                k = i + '' + j;
                if (search.includes(`${k}`)) {
                    var z = document.getElementById(`${k}`);
                    z.classList.add('sold');
                }
            }
        }
        let email = "";
        btnReserve.addEventListener("click", () => {
            email = document.getElementById('email').value;
            if (!email.includes('@', 0)) {
                alert('Your email is incorrect');
            } else {
                alert('Thank you. You have sucessfully ordered the ticket(s). Please check your email!!');
                document.cookie = "email=" + email;
            }
        });
    </script>
</body>

</html>