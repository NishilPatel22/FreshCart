<?php

include 'components/connect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
   header('Location: user_login.php');
   exit; // Ensure script stops after redirecting
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['order'])) {

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   // Validate and sanitize input data
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $flat = filter_var($flat, FILTER_SANITIZE_STRING);
   $street = filter_var($street, FILTER_SANITIZE_STRING);
   $city = filter_var($city, FILTER_SANITIZE_STRING);
   $state = filter_var($state, FILTER_SANITIZE_STRING);
   $country = filter_var($country, FILTER_SANITIZE_STRING);
   $pin_code = filter_var($pin_code, FILTER_SANITIZE_STRING);
   $total_products = filter_var($total_products, FILTER_SANITIZE_STRING);
   $total_price = filter_var($total_price, FILTER_SANITIZE_STRING);

   // Insert order into database
   $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
   $insert_order->execute([$user_id, $name, $number, $email, $method, "$flat, $street, $city, $state, $country - $pin_code", $total_products, $total_price]);

   // Delete cart items
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$user_id]);

   $message = 'Order placed successfully!';
} else {
   $message = 'Your cart is empty';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="checkout-orders">

      <form action="" method="POST">

         <h3>Your Orders</h3>

         <div class="display-orders">
            <?php
            $grand_total = 0;
            $cart_items = [];
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
               while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  $cart_items[] = $fetch_cart['name'] . ' (' . '$' . $fetch_cart['price'] . '/- x ' . $fetch_cart['quantity'] . ')';
                  $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
            ?>
                  <p><?= $fetch_cart['name']; ?> <span>(<?= '$' . $fetch_cart['price'] . '/- x ' . $fetch_cart['quantity']; ?>)</span> </p>
            <?php
               }
            } else {
               echo '<p class="empty">Your cart is empty!</p>';
            }
            ?>
            <input type="hidden" name="total_products" value="<?= implode(', ', $cart_items); ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
            <div class="grand-total">Grand Total: <span>$<?= $grand_total; ?>/-</span></div>
         </div>

         <h3>Place Your Orders</h3>

         <div class="flex">
            <div class="inputBox">
               <span>Your Name:</span>
               <input type="text" name="name" placeholder="Enter your name" class="box" maxlength="20" required>
            </div>
            <div class="inputBox">
               <span>Your Number:</span>
               <input type="text" name="number" placeholder="Enter your number" class="box" minlength="10" maxlength="10" required>
            </div>
            <div class="inputBox">
               <span>Your Email:</span>
               <input type="email" name="email" placeholder="Enter your email" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Payment Method:</span>
               <select name="method" class="box" required>
                  <option value="cash on delivery">Cash on Delivery</option>
                  <option value="credit card">Credit Card</option>
                  <option value="paytm">Paytm</option>
                  <option value="paypal">Paypal</option>
               </select>
            </div>
            <div class="inputBox">
               <span>Address Line 01:</span>
               <input type="text" name="flat" placeholder="e.g. Flat number" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Address Line 02:</span>
               <input type="text" name="street" placeholder="e.g. Street name" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>City:</span>
               <input type="text" name="city" placeholder="e.g. Mumbai" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>State:</span>
               <input type="text" name="state" placeholder="e.g. Maharashtra" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Country:</span>
               <input type="text" name="country" placeholder="e.g. India" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Pin Code:</span>
               <input type="text" name="pin_code" placeholder="e.g. 123456" class="box" minlength="6" maxlength="6" required>
            </div>
         </div>

         <input type="submit" name="order" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" value="Place Order">

      </form>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>
