<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homepage</title>
    <link rel="stylesheet" href="../css/style.css">
    
</head>

<body>
    <p id="co"></p>
    <p id="demo"></p>
    <div class="wrapper">
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

        $sql = "SELECT seat_id ,rows_number, seat_number FROM seats where hall_id=4";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                for ($i = 1; $i <= $row["rows_number"]; $i++) {
                    for ($j = 1; $j <= $row["seat_number"]; $j++) { ?>
                        <div class="box"><?php echo $j ?></div>
                        <?php
                    }
                        ?><?php
                    }
                }
            } else {
                echo "0 results";
            }
            
                        ?>


    </div>
    <script src="../js/script.js"></script>
</body>
</html>