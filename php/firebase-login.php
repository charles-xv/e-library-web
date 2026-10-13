<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php'; // Composer autoload
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Factory;

header('Content-Type: application/json');

// Use your one Firebase service account
$serviceAccountFile = __DIR__ . '/firebase_credentials.json';
if (!file_exists($serviceAccountFile)) {
    echo json_encode(['success' => false, 'message' => 'Firebase service account file not found']);
    exit;
}

$factory = (new Factory)->withServiceAccount($serviceAccountFile);
$auth = $factory->createAuth();

// Read JSON input from JS
$input = json_decode(file_get_contents('php://input'), true);
$idToken = $input['idToken'] ?? '';

if (!$idToken) {
    echo json_encode(['success' => false, 'message' => 'No ID token provided']);
    exit;
}

try {
    $verifiedIdToken = $auth->verifyIdToken($idToken);
    $uid = $verifiedIdToken->claims()->get('sub');
    $email = $verifiedIdToken->claims()->get('email');
    $name = $verifiedIdToken->claims()->get('name') ?? '';

    $_SESSION['user'] = [
        'type' => 'firebase',
        'uid' => $uid,
        'email' => $email,
        'username' => $name
    ];

    echo json_encode(['success' => true]);

} catch (InvalidToken $e) {
    echo json_encode(['success' => false, 'message' => 'Invalid token: '.$e->getMessage()]);
} catch (\Throwable $e) {
    echo json_encode(['success' => false, 'message' => 'Error verifying token: '.$e->getMessage()]);
}
