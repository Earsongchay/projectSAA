<?php
require_once '../vendor/autoload.php';
require_once '../secrets.php';
require_once('../../db_connect.php');
$sd = $_REQUEST['id'];
\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');
$YOUR_DOMAIN = 'http://localhost/projectssa/projectSAA/pages/payment/public';

//retrieve data
$sql = "SELECT url_poster,movie_title,branch_name,start_time,hall_name, durations,ticket_price, movie_image,categorie_id  FROM movies m join scheduleDetails sd ON m.movie_id = sd.movie_id JOIN branches_halls bh ON bh.hall_branch_id = sd.hall_branch_id JOIN Branches b ON b.branch_id = bh.branch_id JOIN halls h ON h.hall_id=bh.hall_id WHERE scheduleDetail_id = $sd";
$result = mysqli_query($connection, $sql);
$row = $result->fetch_assoc();
$hall = $row['hall_name'];
$branch = $row['branch_name'];
$seat = $_COOKIE['seat'];
$amount = str_replace('$', '', $_COOKIE['amount']);
$amount_as_cent = floatval($amount) * 100;
$title = $row['movie_title'];
$poster = $row['url_poster'];
$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price_data' => [
      'currency' => 'usd',
      'product_data' => [
        'name' => "$title",
        'description' => "$branch" . ', ' . "$hall" . ' - ' . "$seat",
        'images' => ["$poster"],
      ],
      'unit_amount' => $amount_as_cent,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php?id=' . $sd,
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php?id=' . $sd,
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
