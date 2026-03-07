<?php
header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'message' => 'API is active and updated!',
    'time' => date('Y-m-d H:i:s'),
    'database' => 'PostgreSQL (Supabase)'
]);
exit;
?>
