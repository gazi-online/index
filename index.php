<?php
// Main entry point for Gazi Online PHP version
$activePage = 'home';
$language = 'bn'; // default language
$theme = 'light';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/png" href="/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gazi Online – Premium Digital Banking Center</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css" />
  </head>
  <body class="transition-colors duration-300">
    <div id="root-php">
      <?php include 'includes/navbar.php'; ?>
      
      <main>
        <?php include 'includes/hero.php'; ?>
        <?php include 'includes/services.php'; ?>
        <?php include 'includes/reviews.php'; ?>
        <?php include 'includes/contact.php'; ?>
      </main>

      <?php include 'includes/footer.php'; ?>
      <?php include 'includes/booking-dialog.php'; ?>
    </div>

    <!-- Main JavaScript Logic -->
    <script src="/assets/js/main.js"></script>
  </body>
</html>
