<?php
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');

// Ensure the runtime has a place to write
$storagePath = '/tmp/storage/framework';
mkdir($storagePath . '/views', 0755, true);
mkdir($storagePath . '/cache', 0755, true);
mkdir($storagePath . '/sessions', 0755, true);

// Override the compiled view path in the environment
putenv("VIEW_COMPILED_PATH=$storagePath/views");

require __DIR__ . '/../public/index.php';
