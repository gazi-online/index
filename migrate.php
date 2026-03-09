<?php
require __DIR__ . '/includes/db.php';
$db = new Database();
if (!$db->isConnected()) {
    echo "DB NOT CONNECTED: " . $db->getError();
    exit;
}
// Add document_path column if not exists
$result = $db->execute("ALTER TABLE bookings ADD COLUMN IF NOT EXISTS document_path VARCHAR(255) NULL");
echo $result ? "Migration OK: document_path column added or already exists.\n" : "Migration FAILED.\n";
