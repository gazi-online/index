<?php
// Main entry point for Gazi Online PHP version
ob_start();
session_start();
ini_set('display_errors', '0'); // CRITICAL: Prevents warnings from corrupting JSON
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

// Cache raw input early — php://input can only be read once
$raw_input = file_get_contents('php://input');

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
  $bookings = $db->query("SELECT id, name, service, phone, booking_date as date, booking_time as time, status, document_path FROM bookings ORDER BY created_at DESC");
  $messages = $db->query("SELECT name, phone, sent_at as \"sentAt\", message FROM messages ORDER BY sent_at DESC");

  sendJSON([
    'bookings' => $bookings,
    'messages' => $messages,
    'configured' => $db->isConnected()
  ]);
}

if ($path === '/api/booking' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode($raw_input, true);
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
  $data = json_decode($raw_input, true);
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
  // Support both JSON (old way) and multipart/form-data (new way with file)
  $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
  
  if (strpos($contentType, 'application/json') !== false) {
    $data = json_decode(file_get_contents('php://input'), true);
    $status = $data['status'] ?? null;
    $id = $data['id'] ?? null;
  } else {
    $status = $_POST['status'] ?? null;
    $id = $_POST['id'] ?? null;
  }

  $success = false;
  $document_path = null;

  if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
      $uploadDir = __DIR__ . '/../public/uploads/';
      if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
      }
      
      $fileInfo = pathinfo($_FILES['document']['name']);
      $ext = strtolower($fileInfo['extension'] ?? '');
      $allowed = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
      
      if (in_array($ext, $allowed)) {
          $filename = 'doc_' . time() . '_' . uniqid() . '.' . $ext;
          $targetPath = $uploadDir . $filename;
          
          if (move_uploaded_file($_FILES['document']['tmp_name'], $targetPath)) {
              $document_path = '/uploads/' . $filename;
          }
      }
  }

  if ($db->isConnected() && $id && $status) {
    if ($document_path) {
        $success = $db->execute(
        "UPDATE bookings SET status = ?, document_path = ? WHERE id = ?",
        [$status, $document_path, $id]
        );
    } else {
        $success = $db->execute(
        "UPDATE bookings SET status = ? WHERE id = ?",
        [$status, $id]
        );
    }
  }
  sendJSON(['success' => $success, 'document_path' => $document_path]);
}

if ($path === '/api/track-status' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  ob_clean(); // Force clear any leading whitespace/HTML
  
  $data = json_decode($raw_input, true);
  
  if (empty($data['phone'])) {
    sendJSON(['success' => false, 'error' => 'Phone number is required.']);
  }
  
  $phone = trim(strip_tags($data['phone']));
  
  if ($db->isConnected()) {
      $bookings = $db->query(
          "SELECT status, name, service, booking_date as date, booking_time as time, created_at, document_path 
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

// --- OTP Endpoints using Fonnte API ---
if ($path === '/api/otp-send' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  ob_clean();
  $data = json_decode($raw_input, true);
  $phone = trim(strip_tags($data['phone'] ?? ''));
  
  if (empty($phone)) {
    sendJSON(['success' => false, 'error' => 'Phone number is required.']);
  }

  // Generate 6 digit OTP
  $otp = sprintf("%06d", mt_rand(1, 999999));
  
  // Store in session with 10 min expiration
  $_SESSION['otp_' . $phone] = [
    'code' => $otp,
    'expires' => time() + 600 // 10 minutes
  ];

  // Send via Fonnte
  $token = $_ENV['FONNTE_TOKEN'] ?? '';
  if (empty($token) || $token === 'YOUR_FONNTE_TOKEN_HERE') {
    // For local testing if token is not set, just assume success and log it
    error_log("OTP for $phone is $otp");
    sendJSON(['success' => true, 'message' => 'OTP generated (Token not configured, check logs)']);
  }

  $message = "Your Gazi Online OTP code is: {$otp}. It is valid for 10 minutes.";
  
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
      'target' => $phone,
      'message' => $message,
      'countryCode' => '91', // Assuming India, replace as needed
    ),
    CURLOPT_HTTPHEADER => array(
      'Authorization: ' . $token
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {
    sendJSON(['success' => false, 'error' => 'cURL Error: ' . $err]);
  } else {
    $resData = json_decode($response, true);
    if (isset($resData['status']) && $resData['status'] == true) {
      sendJSON(['success' => true, 'message' => 'OTP sent successfully']);
    } else {
      sendJSON(['success' => false, 'error' => 'Fonnte API Error: ' . ($resData['reason'] ?? 'Unknown error')]);
    }
  }
}

if ($path === '/api/otp-verify' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  ob_clean();
  $data = json_decode($raw_input, true);
  $phone = trim(strip_tags($data['phone'] ?? ''));
  $code = trim(strip_tags($data['code'] ?? ''));

  if (empty($phone) || empty($code)) {
    sendJSON(['success' => false, 'error' => 'Phone and OTP code are required.']);
  }

  if (isset($_SESSION['otp_' . $phone])) {
    $sessionOtp = $_SESSION['otp_' . $phone];
    
    if (time() > $sessionOtp['expires']) {
      unset($_SESSION['otp_' . $phone]);
      sendJSON(['success' => false, 'error' => 'OTP has expired. Please request a new one.']);
    }
    
    if ($sessionOtp['code'] === $code) {
      // Mark as verified
      $_SESSION['otp_verified_' . $phone] = true;
      unset($_SESSION['otp_' . $phone]);
      sendJSON(['success' => true, 'message' => 'OTP verified successfully.']);
    } else {
      sendJSON(['success' => false, 'error' => 'Invalid OTP code.']);
    }
  } else {
    sendJSON(['success' => false, 'error' => 'No OTP request found for this number.']);
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
    // Basic Username & Password Login (requested to remove OTP)
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hardcoded credentials for now
    if ($username === 'admin' && $password === 'Droidnur@9733') {
        $_SESSION['user_role'] = 'admin';
        header('Location: /admin');
        exit;
    } else {
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
    <link rel="stylesheet" href="/assets/css/style.css?v=3" />
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
    <script src="/assets/js/main.js?v=3"></script>
  </body>
</html>
