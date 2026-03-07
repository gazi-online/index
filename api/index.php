<?php
// Main entry point for Gazi Online PHP version
session_start();

// Simple Routing Logic
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

$activePage = 'home';
$language = 'bn'; // default language
$theme = 'light';

// Authentication Logic
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';

if ($path === '/login') {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hardcoded credentials for now
    if ($username === 'admin' && $password === 'gazi_online_admin') {
      $_SESSION['user_role'] = 'admin';
      header('Location: /admin');
      exit;
    }
    else {
      $login_error = "Invalid username or password.";
    }
  }
  $activePage = 'login';
}
elseif ($path === '/admin') {
  if (!$isAdmin) {
    header('Location: /login');
    exit;
  }
  $activePage = 'admin';
}
elseif ($path === '/logout') {
  session_destroy();
  header('Location: /');
  exit;
}

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
    <style>
      /* Additional styles for the admin dashboard/login */
      .glass { background: var(--glass-bg); backdrop-filter: blur(var(--glass-blur)); border: 1px solid var(--glass-border); }
    </style>
  </head>
  <body class="transition-colors duration-300">
    <div id="root-php">
      <?php
if ($activePage !== 'admin' && $activePage !== 'login') {
  include __DIR__ . '/../includes/navbar.php';
}
?>
      
      <main>
        <?php
if ($activePage === 'admin') {
  include __DIR__ . '/../includes/admin-dashboard.php';
}
elseif ($activePage === 'login') {
  include __DIR__ . '/../includes/login.php';
}
else {
  include __DIR__ . '/../includes/hero.php';
  include __DIR__ . '/../includes/services.php';
  include __DIR__ . '/../includes/reviews.php';
  include __DIR__ . '/../includes/contact.php';
}
?>
      </main>

      <?php
if ($activePage !== 'admin' && $activePage !== 'login') {
  include __DIR__ . '/../includes/footer.php';
  include __DIR__ . '/../includes/booking-dialog.php';
}
?>
    </div>

    <!-- Main JavaScript Logic -->
    <script src="/assets/js/main.js"></script>
  </body>
</html>
