<?php
// Main entry point for Gazi Online PHP version
ob_start();
session_start();
ini_set('display_errors', '0'); // CRITICAL: Prevents warnings from corrupting JSON
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

include_once __DIR__ . '/../includes/sheets-lib.php';
$sheets = new GoogleSheetsDB();

// Simple Routing Logic
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// Helper for clean JSON responses
function sendJSON($data)
{
  ob_clean();
  header('Content-Type: application/json');
  echo json_encode($data);
  exit;
}

// API Endpoints
if ($path === '/api/get-data' && $_SERVER['REQUEST_METHOD'] === 'GET') {
  $bookingsRaw = $sheets->getRows('Bookings');
  $messagesRaw = $sheets->getRows('Messages');

  // Format Bookings
  $bookings = [];
  if (!empty($bookingsRaw)) {
    array_shift($bookingsRaw); // remove header
    foreach ($bookingsRaw as $row) {
      if (count($row) < 7)
        continue;
      $bookings[] = [
        'id' => $row[0] ?? '',
        'name' => $row[1] ?? '',
        'phone' => $row[2] ?? '',
        'service' => $row[3] ?? '',
        'date' => $row[4] ?? '',
        'time' => $row[5] ?? '',
        'notes' => $row[6] ?? '',
        'status' => $row[7] ?? 'pending',
        'createdAt' => $row[8] ?? ''
      ];
    }
  }

  // Format Messages
  $messages = [];
  if (!empty($messagesRaw)) {
    array_shift($messagesRaw); // remove header
    foreach ($messagesRaw as $row) {
      $messages[] = [
        'name' => $row[0] ?? '',
        'phone' => $row[1] ?? '',
        'message' => $row[2] ?? '',
        'sentAt' => $row[3] ?? ''
      ];
    }
  }

  sendJSON(['bookings' => $bookings, 'messages' => $messages]);
}

if ($path === '/api/booking' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $success = false;
  $error = $sheets->getInitError() ?: "Sheets not configured";

  if ($sheets->isConfigured()) {
    $res = $sheets->appendRow('Bookings', [
      $data['id'], $data['name'], $data['phone'], $data['service'],
      $data['date'], $data['time'], $data['notes'], 'pending', date('Y-m-d H:i:s')
    ]);
    $success = ($res === true);
    $error = ($res === true) ? null : $res;
  }
  sendJSON(['success' => $success, 'error' => $error]);
}

if ($path === '/api/contact' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $success = false;
  $error = "Sheets not configured";
  if ($sheets->isConfigured()) {
    $res = $sheets->appendRow('Messages', [
      $data['name'], $data['phone'], $data['message'], date('Y-m-d H:i:s')
    ]);
    $success = ($res === true);
    $error = ($res === true) ? null : $res;
  }
  sendJSON(['success' => $success, 'error' => $error]);
}

if ($path === '/api/update-status' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $success = false;
  if ($sheets->isConfigured()) {
    $success = $sheets->updateStatus('Bookings', $data['id'], $data['status']);
  }
  sendJSON(['success' => $success]);
}

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
