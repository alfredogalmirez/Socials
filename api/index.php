<?php
// Ensure the runtime has a place to write
$storagePath = '/tmp/storage/framework';
mkdir($storagePath . '/views', 0755, true);
mkdir($storagePath . '/cache', 0755, true);
mkdir($storagePath . '/sessions', 0755, true);

// Override the compiled view path in the environment
putenv("VIEW_COMPILED_PATH=$storagePath/views");

require __DIR__ . '/../public/index.php';
