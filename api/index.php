<?php
// Main entry point for Gazi Online PHP version
ob_start();
session_start();
ini_set('display_errors', '0'); // CRITICAL: Prevents warnings from corrupting JSON
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

include_once __DIR__ . '/../includes/db.php';
$db = new Database();

// Fallback for sheets (optional, if you still want to keep it as a backup)
// include_once __DIR__ . '/../includes/sheets-lib.php';
// $sheets = new GoogleSheetsDB();

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
  $bookings = $db->query("SELECT id, name, service, phone, booking_date as date, booking_time as time, status FROM bookings ORDER BY created_at DESC");
  $messages = $db->query("SELECT name, phone, sent_at as \"sentAt\", message FROM messages ORDER BY sent_at DESC");

  sendJSON([
    'bookings' => $bookings,
    'messages' => $messages,
    'configured' => $db->isConnected()
  ]);
}

if ($path === '/api/booking' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $success = false;
  $error = $db->getError() ?: "Database not connected";

  if ($db->isConnected()) {
    $success = $db->execute(
      "INSERT INTO bookings (id, name, phone, service, booking_date, booking_time, notes, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
      [
        $data['id'], $data['name'], $data['phone'], $data['service'],
        $data['date'], $data['time'], $data['notes'], 'pending', date('Y-m-d H:i:s')
      ]
    );
    $error = $success ? null : "Failed to record booking.";
  }
  sendJSON(['success' => $success, 'error' => $error]);
}

if ($path === '/api/contact' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $success = false;
  $error = $db->getError() ?: "Database not connected";
  if ($db->isConnected()) {
    $success = $db->execute(
      "INSERT INTO messages (name, phone, message, sent_at) VALUES (?, ?, ?, ?)",
      [
        $data['name'], $data['phone'], $data['message'], date('Y-m-d H:i:s')
      ]
    );
    $error = $success ? null : "Failed to send message.";
  }
  sendJSON(['success' => $success, 'error' => $error]);
}

if ($path === '/api/update-status' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $success = false;
  if ($db->isConnected()) {
    $success = $db->execute(
      "UPDATE bookings SET status = ? WHERE id = ?",
      [$data['status'], $data['id']]
    );
  }
  sendJSON(['success' => $success]);
}

if ($path === '/api/track-status' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  ob_clean(); // Force clear any leading whitespace/HTML
  
  $data = json_decode(file_get_contents('php://input'), true);
  
  if (empty($data['phone'])) {
    sendJSON(['success' => false, 'error' => 'Phone number is required.']);
  }
  
  $phone = filter_var($data['phone'], FILTER_SANITIZE_STRING);
  
  if ($db->isConnected()) {
      $bookings = $db->query(
          "SELECT status, name, service, booking_date as date, booking_time as time, created_at 
           FROM bookings 
           WHERE phone = ? 
           ORDER BY created_at DESC LIMIT 1",
          [$phone]
      );
      
      if (!empty($bookings) && count($bookings) > 0) {
          sendJSON(['success' => true, 'data' => $bookings[0]]);
      } else {
          sendJSON(['success' => false, 'error' => 'No booking found.']);
      }
  } else {
       sendJSON(['success' => false, 'error' => 'Database connection failed.']);
  }
}

// Ensure execution stops after handling API calls
if (strpos($path, '/api/') === 0) {
    http_response_code(404);
    sendJSON(['success' => false, 'error' => 'API endpoint not found.']);
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
    if ($username === 'admin' && $password === 'Droidnur@9733') {
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
    <link rel="stylesheet" href="/assets/css/style.css?v=2" />
    <style>
      /* Additional styles for the admin dashboard/login */
      .glass { background: var(--glass-bg); backdrop-filter: blur(var(--glass-blur)); border: 1px solid var(--glass-border); }
    </style>
    <script>
      (function() {
        const theme = localStorage.getItem('theme') || 'dark';
        if (theme === 'dark') {
          document.documentElement.setAttribute('data-theme', 'dark');
        } else {
          document.documentElement.removeAttribute('data-theme');
        }
      })();
    </script>
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
  include __DIR__ . '/../includes/track-status-dialog.php';
}
?>
    </div>

    <!-- Main JavaScript Logic -->
    <script src="/assets/js/main.js?v=2"></script>
  </body>
</html>
