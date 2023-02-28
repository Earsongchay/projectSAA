<?php include("db_connect.php"); ?>

<style>
    tr {
        display: flex;
        gap: 10px;
    }

    td {
        position: relative;
        cursor: pointer;
        background-color: #444451;
        height: 26px;
        width: 32px;
        margin: 3px;
        font-size: 50px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    td .sold{
        z-index: 20;
        position: absolute;
        background-color: blue;
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

$sql = "SELECT seat_id ,rows_number, seat_number FROM seats where seat_id=1";
$result = $connection->query($sql);



?>
<table id="table">
    <?php
    $row = 2 ;
    $col = 2 ;
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            for ($i = 1; $i < $row['rows_number'] +1; $i++) {
                if ($i == $row) { ?>

                    <tr>
                        <?php
                        for ($j = 1; $j < $row['seat_number'] + 1; $j++) { 
                            if($j == $col){ ?>

                                <td>
                                    <div class="sold"></div>
                                </td>
                            
                            <?php }
                            else {?>

                                <td>
                                    
                                </td>

                            <?php }
                        } ?>
                    </tr>

                <?php }
                else{ ?>

                    <tr>
                        <?php
                        for ($j = 1; $j < $row['seat_number'] +1; $j++) { ?>

                            <td>

                            </td>

                        <?php
                        } ?>
                    </tr>

                <?php }
            } ?>
        <?php }
    }?>
</table>
<script>
    let table = document.getElementById('table'),
        rindex, cindex;


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
                } else {
                    r = "E"
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