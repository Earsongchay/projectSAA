<Section id="popup">
  <div id="trapezoid"></div>
  <table id="table">
    <?php
    $sql = "SELECT h.seat_id ,rows_number, seat_number,sd.scheduledetail_id FROM seats
            JOIN halls h ON h.seat_id = seats.seat_id JOIN Branches_Halls bh ON bh.hall_id = h.hall_id JOIN scheduleDetails sd ON sd.hall_branch_id = bh.hall_branch_id
            WHERE sd.scheduledetail_id = 23";
    $result = $conn->query($sql);
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
  <!-- SOLD SEATS  -->
  <?php
  $sdBooked = $_COOKIE['sdBooked'];
  $sdBooked = str_replace(',', '', $sdBooked);
  $sql = "SELECT seats_booked ,sd.scheduledetail_id FROM seats s join halls h ON s.seat_id=h.seat_id JOIN branches_halls bh ON bh.hall_id = h.hall_id JOIN  scheduledetails sd ON sd.hall_branch_id = bh.hall_branch_id JOIN bookingDetails bd ON sd.scheduledetail_id= bd.scheduledetail_id WHERE sd.scheduledetail_id = $sdBooked;";
  $result = $conn->query($sql);
  $seats_booked = '';
  while ($row = $result->fetch_assoc()) {
    $seats_booked .= $row['seats_booked'];
  }
  ?><div id="bseat" value="<?php echo $seats_booked ?>"></div>

</Section>
<script>
  //CLICK ON TIME 
  var count = 0;
  var id = [];
  var value = [];
  var show_tb = document.getElementById('popup');
  <?php
  for ($a = 1; $a < $count; $a++) { ?>
    id[<?php echo  $a; ?>] = document.getElementById('<?php echo $a; ?>');

    id[<?php echo  $a; ?>].addEventListener("click", (e) => {
      show_tb.classList.add('show');
      value[<?php echo $a; ?>] = document.getElementById('<?php echo $a; ?>').getAttribute('value');
      document.cookie = "sdBooked=" + value;

      show_tb.removeAttribute('id');
    });

  <?php } ?>


  //SOLD SEAT
  var r = [];
  var c = [];
  var booked = document.getElementById('bseat').getAttribute('value').split(",");
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
  var col = document.getElementById('col').getAttribute('value');
  var row = document.getElementById('row').getAttribute('value');
  for (let i = 1; i <= row; i++) {
    for (let j = 1; j <= col; j++) {
      if (search[j - 1] == i + '' + j) {
        var z = document.getElementById(search[j - 1]);
        z.classList.add('sold');
      }
    }
  }








  //CLICK SEAT
  var booked_seats = [];
  var b = [];
  var book_c = 0, book_r = 0;

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
</script>
<script src="script.js"></script>