<?php
require_once('vendor/autoload.php');
require_once('secret.php');
\Stripe\Stripe::setApiKey(API_KEY);
$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'product_data' => [
        'name' => 'Doctor Strange : Multiverse Of Madness',
        'description' => 'sdjfjdsffhdsgj',
        'images' => ["https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJ5IuxfEt-WmUIrpJldszdRJFfTubSEeQVMVNuv63Z0PNfvbWV"],
      ],
      'unit_amount' => 2000,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://localhost:4242/success',
  'cancel_url' => 'http://example.com/cancel',
]);
?>

<html>

<head>
  <title>Buy cool new product</title>
  <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
  <button id="checkout-button">Checkout</button>
  <script>
    var stripe = Stripe(PUB_KEY';
    const btn = document.getElementById("checkout-button")
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      stripe.redirectToCheckout({
        sessionId: "<?php echo $session->id; ?>"
      });
    });
  </script>
</body>

</html>