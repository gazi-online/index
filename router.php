<?php
// Local Router for PHP Built-in Server
// Mimics the Vercel routing defined in vercel.json: all paths -> /api/index.php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve real static files that exist inside /public
$publicFile = __DIR__ . '/public' . $uri;
if ($uri !== '/' && file_exists($publicFile) && !is_dir($publicFile)) {
    return false; // Let PHP serve it natively
}

// All other requests (including /api/*) go to the PHP entry point
// Force include — don't let the filesystem short-circuit this
require __DIR__ . '/api/index.php';
