<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.png" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>Welcome to FreshCart, where convenience meets quality! Here are compelling reasons why choosing us for your grocery needs is the best decision you'll make:</p>
<p>Wide Range of Products: From fresh produce to pantry staples, we offer a vast selection of high-quality groceries to meet your every need. Whether you're searching for organic fruits and vegetables or international delicacies, we have it all.</p>
<p>Convenience at Your Fingertips: Say goodbye to long queues and crowded aisles. With our user-friendly website and mobile app, you can browse, order, and schedule delivery or pickup with just a few clicks, anytime and anywhere.</p>
<p>Freshness Guaranteed: We understand the importance of freshness when it comes to groceries. That's why we source our products from trusted suppliers and ensure that they are delivered to you in the freshest condition possible.</p>
<p>Competitive Prices: Enjoy competitive prices on all our products without compromising on quality. With regular discounts, promotions, and loyalty programs, we make sure that you get the best value for your money.</p>

         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">client's reviews</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images\kush.jpeg" alt="">
         <p>I can't express how much FreshCart has simplified my life. As a busy professional, finding time to grocery shop was always a challenge. But with FreshCart, I can order all my essentials with just a few taps on my phone and have them delivered right to my doorstep. The quality of the products is consistently excellent, and their customer service team is always helpful and responsive. Thanks to FreshCart, I now have more time to focus on what truly matters to me.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Kush Prajapati</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images\janish.jpeg" alt="">
         <p>FreshCart has truly been a game-changer for my family. With two young children and a hectic schedule, going to the grocery store was always a dreaded task. But ever since we started using FreshCart, grocery shopping has become a breeze. Not only do they offer a wide range of products to choose from, but their delivery service is always reliable and punctual. I love that I can spend more quality time with my family instead of navigating crowded aisles.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Janish Maheta</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images\manoj.jpeg" alt="">
         <p>As someone who values both convenience and quality, FreshCart has exceeded all my expectations. I was initially skeptical about ordering groceries online, fearing that the freshness of the products wouldn't match what I could find in-store. FreshCart proved me wrong. Every item I've received has been fresh and of the highest quality. Their user-friendly website makes browsing and ordering a breeze, and I love the flexibility of their delivery options.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Manoj Dalai</h3>
      </div>

      

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>