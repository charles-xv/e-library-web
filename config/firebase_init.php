<?php
// config/firebase_init.php
// Connects PHP with Firebase using Kreait SDK

require_once __DIR__ . '/../vendor/autoload.php'; // Composer autoloader

use Kreait\Firebase\Factory;

// Define Firebase service account path
$serviceAccountPath = __DIR__ . '/firebase_credentials.json';

// Check if credentials file exists
if (!file_exists($serviceAccountPath)) {
    exit("❌ Firebase service account file missing: $serviceAccountPath");
}

// Initialize Firebase factory
$factory = (new Factory)
    ->withServiceAccount($serviceAccountPath);

// Create Firebase Auth instance
$auth = $factory->createAuth();

// Optional test message (remove later)
if (php_sapi_name() === 'cli') {
    echo "✅ Firebase initialized successfully\n";
}
