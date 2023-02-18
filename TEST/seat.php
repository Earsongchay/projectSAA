<style>
    td {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        width: 30px;
        height: 30px;
        cursor: pointer;
        background-color: gray;
        margin-bottom: 20px;
        border: 1px solid black;
    }

    .box.active {
        background-color: green;
    }

    .active {
        background-color: red;
    }
</style>
<h3>Count: <span id="count"></span></h3>
<h5>Seat: <span id="seat"></span></h5>
<p>Rows: <span id="row"></span><span>-</span><span id="cell"></span></p>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "_movies";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT seat_id ,rows_number, seat_number FROM seats where hall_id=4";
$result = $conn->query($sql);



?>
<table id="table">
    <?php
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            for ($i = 0; $i < $row['rows_number']; $i++) { ?>
                <tr>
                    <?php
                    for ($j = 0; $j < $row['seat_number']; $j++) { ?>

                        <td>
                            <!-- <div class="box"></div> -->
                        </td>

                    <?php
                    } ?>
                </tr>

            <?php
            } ?>
    <?php }
    } ?>
</table>
<script>
    let table = document.getElementById('table'),
        rindex, cindex;


    let seats = [];
    let count = 0;

    for (var i = 0; i < table.rows.length; i++) {

        for (var j = 0; j < table.rows[i].cells.length; j++) {

            table.rows[i].cells[j].onclick = function() {
                if (this.classList.toggle('active')) {
                    ++count;
                    rindex = this.parentElement.rowIndex;
                    cindex = this.cellIndex;
                    let r = rindex + 1;
                    let c = cindex + 1;
                    seats.push(`${r}-${c}`)
                    
                    // document.getElementById('row').innerHTML = r
                    // document.getElementById('cell').innerHTML = c
                } else {
                    --count;
                    rindex = this.parentElement.rowIndex;
                    cindex = this.cellIndex;
                    let r = rindex + 1;
                    let c = cindex + 1;
                    let inde = seats.indexOf(`${r}-${c}`)
                    seats.splice(inde,1)
                  
                    // var ind = seats.indexOf(r + "-" + c)
                    // console.log(ind)
                    // document.getElementById('row').innerHTML = ""
                    // document.getElementById('cell').innerHTML = ""
                }
                document.getElementById('seat').innerHTML = seats;
                document.getElementById('count').innerHTML = count;

            }
        }
    }
</script>

<script>

</script>