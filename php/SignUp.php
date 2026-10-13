<?php
session_start();
require_once __DIR__ . 'db.php';
// Database connection

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');

    // Basic validation
    if (!$full_name) $errors[] = "Full name is required";
    if (!$email) $errors[] = "Email is required";
    if (!$password) $errors[] = "Password is required";
    if ($password !== $confirm) $errors[] = "Passwords do not match";

    if (empty($errors)) {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Email already registered";
        } else {
            // Hash password
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $full_name, $email, $hashed);

            if ($stmt->execute()) {
                $_SESSION['user'] = [
                    'type' => 'traditional',
                    'username' => $full_name
                ];
                header("Location: ../php/myBooks.php");
                exit;
            } else {
                $errors[] = "Failed to register, try again";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up | Horizons</title>
<link rel="stylesheet" href="SignUp.css">
</head>
<body>
<div class="login-container">
  <div class="logo">HORIZONS
    <img class="map" src="../images-z/Drum4.png" alt="image of a drum" />
  </div>

  <!-- Display Errors -->
  <?php if(!empty($errors)): ?>
      <div class="error-messages">
          <?php foreach($errors as $err): ?>
              <p><span class="red-x">✖</span> <?php echo htmlspecialchars($err); ?></p>
          <?php endforeach; ?>
      </div>
  <?php endif; ?>

  <form id="signupForm" method="POST">
    <input type="text" name="full_name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit" class="auth-btn">Sign Up</button>
  </form>

  <div class="signup-link">
    Already have an account? <a href="login.php">Login</a>
  </div>
</div>
</body>
</html>
