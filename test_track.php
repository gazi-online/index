<?php
// test_track.php — Standalone test for track-status logic
require __DIR__ . '/includes/db.php';
$db = new Database();

if (!$db->isConnected()) {
    echo "DB NOT CONNECTED: " . $db->getError();
    exit;
}

$phone = '6295051584';

$bookings = $db->query(
    "SELECT status, name, service, booking_date as date, booking_time as time, created_at, document_path 
     FROM bookings 
     WHERE phone = ? 
     ORDER BY created_at DESC LIMIT 1",
    [$phone]
);

if (!empty($bookings)) {
    echo "SUCCESS!\n";
    print_r($bookings[0]);
} else {
    echo "No booking found for phone: $phone\n";
    
    // List all phones in bookings table
    $all = $db->query("SELECT id, name, phone, status FROM bookings LIMIT 10");
    echo "\nAvailable bookings:\n";
    print_r($all);
}
