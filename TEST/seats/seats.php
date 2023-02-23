<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Movie Seat Booking</title>
    <link rel="stylesheet" href="sstyle.css">
    
  </head>
  <body>
    <div class="movie-container">
      <label> Select a movie:</label>
      <select id="movie">
        <option value="10">Black Panther: Wakanda Forever</option>
        <option value="20">DC League of Super-Pets</option>
        <option value="30">Black Adam</option>
        <option value="40">John Wick</option>
      </select>
    </div>

    <ul class="showcase">
      <li>
        <div class="seat"></div>
        <small>Available</small>
      </li>
      <li>
        <div class="seat selected"></div>
        <small>Selected</small>
      </li>
      <li>
        <div class="seat sold"></div>
        <small>Sold</small>
      </li>
    </ul>

    <div class="container">
      <div class="screen"></div>

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

        $name = "Hello World";

        $sql = "SELECT seat_id ,rows_number, seat_number FROM seats where hall_id=2";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
          while ($row = $result->fetch_assoc()) {
            for ($i = 1; $i <= $row["rows_number"]; $i++) {?>
              <div class="row"><?php echo $i ?>
                <?php 
                for ($j = 1; $j <= $row["seat_number"]; $j++) { ?>
                <div class="seat"></div>
                <?php 
                }?>
              </div>
            <?php 
            }
          }
        }
        
        ?>
      <!-- <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat sold"></div>
        <div class="seat"></div>
      </div> -->
    </div>

    <p class="text"> Selected Seat
      <span id="count">0</span>. TOTAL PRICE $
      <span id="total">0</span
      >
    </p>

    <script src="sscript.js"></script>
  </body>
</html>