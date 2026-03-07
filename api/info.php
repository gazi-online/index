<?php
header('Content-Type: application/json');
echo json_encode([
    'file' => __FILE__,
    'cwd' => getcwd(),
    'uri' => $_SERVER['REQUEST_URI']
]);
?>
