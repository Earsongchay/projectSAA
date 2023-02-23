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


$sql = "SELECT seat_id ,rows_number, seat_number FROM seats where seat_id=1";
$result = $conn->query($sql);
?>
<h3>Count: <span id="count"></span></h3>
<h4>Seat: <span id="seat"></span></h4>
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
    <link rel="stylesheet" href="../css/movie-detail.css" />
</table>

<?php
$sql = "SELECT seats_booked FROM bookingDetails b left JOIN ScheduleDetails s
    ON b.scheduleDetail_id = s.scheduleDetail_id";
$result = $conn->query($sql);
$seats_booked = '';
while ($row = $result->fetch_assoc()) {
    $seats_booked .= $row['seats_booked'];
} ?><div id="bseat" value="<?php echo $seats_booked ?>"></div>

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