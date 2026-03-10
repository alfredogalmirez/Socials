<?php

// 1. Force Laravel to use /tmp for all caches (Read-only filesystem workaround)
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');

// 2. Create the necessary folders if they don't exist
$storagePath = '/tmp/storage/framework';
$folders = [$storagePath . '/views', $storagePath . '/cache', $storagePath . '/sessions'];

foreach ($folders as $folder) {
    // Only create if it doesn't exist to prevent "File exists" warnings
    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }
}

// 3. Set the View path specifically
putenv("VIEW_COMPILED_PATH=$storagePath/views");

// 4. Critical: Tell Laravel the storage path has moved
// This prevents "Permission Denied" errors when Socials tries to log or cache data
putenv("APP_STORAGE=/tmp/storage");

require __DIR__ . '/../public/index.php';
