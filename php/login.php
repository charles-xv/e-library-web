
<?php
session_start();
require_once __DIR__ . '/../config/firebase_init.php'; // Firebase setup (no logic change)
require_once __DIR__ . '/db.php'; // DB connection

$errors = [];

// Traditional login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$email) $errors[] = "Email is required";
    if (!$password) $errors[] = "Password is required";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT full_name, password FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user'] = [
                    'type' => 'traditional',
                    'username' => $row['full_name']
                ];
                header("Location: myBooks.php");
                exit;
            } else {
                $errors[] = "Incorrect password";
            }
        } else {
            $errors[] = "No account found with that email";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Horizons</title>
<link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="login-container">
  <div class="logo">
    HORIZONS
    <img class="map" src="../images-z/Drum4.png" alt="image of a drum" />
  </div>

  <!-- Error messages -->
  <?php if(!empty($errors)): ?>
    <div class="error-messages">
      <?php foreach($errors as $err): ?>
        <p><span class="red-x">✖</span> <?php echo htmlspecialchars($err); ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <!-- Traditional login form -->
  <form id="loginForm" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" class="auth-btn">Login</button>
  </form>

  <!-- Divider -->
  <div class="divider"><span>OR</span></div>

  <!-- Google Firebase login -->
  <button id="firebase-google-login" class="google-btn">
    <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google logo">
    Continue with Google
  </button>

  <div class="signup-link">
    Don’t have an account? <a href="SignUp.php">Sign up</a>
  </div>
</div>

<!-- Firebase + Auth JS -->
<script type="module" src="../js/firebase.js"></script>
<script type="module" src="../js/auth.js"></script>
</body>
</html>
