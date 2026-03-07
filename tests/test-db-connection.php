<?php
// tests/test-db-connection.php

require_once __DIR__ . '/../includes/db.php';

echo "Testing Database Connection...\n";
$db = new Database();

if ($db->isConnected()) {
    echo "✅ Connected to PostgreSQL successfully!\n";
} else {
    echo "❌ Connection failed: " . $db->getError() . "\n";
    exit(1);
}

echo "Testing Table Creation (if not exists)...\n";

$schema = "
CREATE TABLE IF NOT EXISTS bookings (
    id TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    phone TEXT NOT NULL,
    service TEXT NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    notes TEXT,
    status TEXT DEFAULT 'pending',
    created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS messages (
    id BIGSERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    phone TEXT NOT NULL,
    message TEXT NOT NULL,
    sent_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);
";

try {
    $db->getPdo()->exec($schema);
    echo "✅ Tables created or already exist.\n";
} catch (PDOException $e) {
    echo "❌ Schema creation failed: " . $e->getMessage() . "\n";
    exit(1);
}

echo "Testing Insert...\n";
$testId = 'test_' . time();
$success = $db->execute(
    "INSERT INTO bookings (id, name, phone, service, booking_date, booking_time, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
    [$testId, 'Test User', '0123456789', 'Website SEO', '2026-03-07', '10:00:00', 'Test notes', 'pending']
);

if ($success) {
    echo "✅ Insert successful!\n";
} else {
    echo "❌ Insert failed.\n";
    exit(1);
}

echo "Testing Select...\n";
$rows = $db->query("SELECT * FROM bookings WHERE id = ?", [$testId]);
if (count($rows) > 0) {
    echo "✅ Select successful! Found row for ID: " . $rows[0]['id'] . "\n";
} else {
    echo "❌ Select failed: Row not found.\n";
    exit(1);
}

echo "Testing Update...\n";
$success = $db->execute("UPDATE bookings SET status = ? WHERE id = ?", ['confirmed', $testId]);
if ($success) {
    echo "✅ Update successful!\n";
} else {
    echo "❌ Update failed.\n";
    exit(1);
}

echo "Testing Delete (Cleanup)...\n";
$success = $db->execute("DELETE FROM bookings WHERE id = ?", [$testId]);
if ($success) {
    echo "✅ Cleanup/Delete successful!\n";
} else {
    echo "❌ Cleanup/Delete failed.\n";
    exit(1);
}

echo "\n✨ All database tests passed!\n";
?>
