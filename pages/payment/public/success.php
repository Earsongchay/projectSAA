<?php
include('../../db_connect.php');
$sdBooked = $_REQUEST['id'];
$date_issue = date('Y-m-d h:i:s');
$ticket = $_COOKIE['seat'];
$amount =  str_replace('$', '', $_COOKIE['amount']);

$sql = "INSERT INTO bookingdetails (bookingDetail_id, amount, issueDate, seats_booked, scheduleDetail_id,status) VALUES (NULL,$amount ,'$date_issue', '$ticket', $sdBooked,'Paid');";
mysqli_query($connection, $sql);
setcookie('seat', '', -1);
setcookie('amount', '', -1);
?>
<!DOCTYPE html>
<html>

<head>
  <title>Thanks for your order!</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <section>
    <p>
      We appreciate your business! If you have any questions, please email :
    </p>
    <a href="http://localhost/cinema/pages/">BoreySongchayBunghengPhanith@gmail.com</a>
  </section>
</body>
</html>