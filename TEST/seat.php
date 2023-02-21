<style>
    tr {
        display: flex;
        gap: 10px;
    }

    td {
        cursor: pointer;
        background-color: #444451;
        height: 26px;
        width: 32px;
        margin: 3px;
        font-size: 50px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .box.active {
        background-color: green;
    }

    .active {
        background-color: red;
    }
</style>
<h3>Count: <span id="count"></span></h3>
<h4>Seat: <span id="seat"></span></h4>

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
<table id="table">
    <?php
    if ($result !== false && $result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            for ($i = 0; $i < $row['rows_number']; $i++) { ?>

                <tr>
                    <?php
                    for ($j = 0; $j < $row['seat_number']; $j++) { ?>

                        <td >

                        </td>

                    <?php
                    } ?>
                </tr>

            <?php
            } ?>
    <?php }
    } ?>
</table>

<?php
$sql = "SELECT seats_booked FROM bookingDetails b left JOIN ScheduleDetails s
    ON b.scheduleDetail_id = s.scheduleDetail_id";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $seats_booked = $row['seats_booked'];
} ?><div id="seats_booked" value="<?php echo $seats_booked ?>"><?php echo $seats_booked ?></div>
<script>
    let table = document.getElementById('table'),
        rindex, cindex;
    var seats_booked = document.getElementById('seats_booked').getAttribute('value');
    const booked = seats_booked.split(',');
    const q = [];
    console.log(booked);

    /*for (var i = 0; i < table.rows.length; i++) {
        if(booked[i]="A"){
            booked[i]=1;
        }else if (booked[i]="B"){
            booked[i]=2;
        }else if (booked[i]="A"){
            booked[i]=1;
        }else if (booked[i]="A"){
            booked[i]=1;
        }else if (booked[i]="A"){
            booked[i]=1;
        }else if (booked[i]="A"){
            booked[i]=1;
        }else (booked[i]="A"){
            booked[i]=1;
        }
        console.log(booked);
    }

    */
    let seats = [];
    let count = 0;

    for (var i = 0; i < table.rows.length; i++) {

        for (var j = 0; j < table.rows[i].cells.length; j++) {

            table.rows[i].cells[j].onclick = function() {

                rindex = this.parentElement.rowIndex;
                cindex = this.cellIndex;
                let r = rindex + 1;
                let c = cindex + 1;
                if (r == 1) {
                    r = "A"
                } else if (r == 2) {
                    r = "B"
                } else if (r == 3) {
                    r = "C"
                } else if (r == 4) {
                    r = "D"
                } else if (r == 5) {
                    r = "E"
                } else {
                    r = "F"
                }



                if (this.classList.toggle('active')) {
                    ++count;
                    seats.push(`${r}${c}`)
                    // let ind = seats.indexOf(`${r}-${c}`)
                    // console.log(Number(`${c}`))covert to number

                } else {
                    --count;
                    let inde = seats.indexOf(`${r}${c}`)
                    seats.splice(inde, 1)
                }

                document.getElementById('seat').innerHTML = seats.sort().reverse();
                document.getElementById('count').innerHTML = count;

            }
        }
    }
</script>

<script>

</script>