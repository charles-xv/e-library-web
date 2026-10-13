<?php
session_start();
include 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php?redirect=settings.php");
    exit;
}

$user = $_SESSION['user'];

// Extract user info based on login type
if (isset($user['type']) && $user['type'] === 'firebase') {
    // Firebase user (Google sign-in)
    $displayName = strtoupper(substr($user['email'], 0, 1));
    $email = $user['email'];
    $join_date = 'Using Firebase Auth';
} else {
    // Local database user
    $username = $user['username'];

    $sql = "SELECT email, created_at FROM users WHERE full_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    $displayName = $username;
    $email = $userData['email'] ?? 'Not available';
    $join_date = date('F Y', strtotime($userData['created_at'] ?? 'now'));
}
?>

<?php
// Prevent back button access after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings | Horizons</title>
  <link rel="stylesheet" href="../css/settings.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
  <!-- Mobile Menu Icon -->
  <div class="menu-toggle" id="menuToggle">
    <i class="fa-solid fa-bars"></i>
  </div>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <h2>HORIZONS</h2>
      <span id="closeSidebar" class="close-btn">
        <i class="fa-solid fa-xmark"></i>
      </span>
    </div>
    <a href="myBooks.php"><i class="fa-solid fa-book"></i> My Books</a>
    <a href="Recommendation.php"><i class="fa-solid fa-heart"></i> Recommendations</a>
    <a href="News.php"><i class="fa-solid fa-newspaper"></i> News & Articles</a>
    <a href="#" class="active"><i class="fa-solid fa-gear"></i> Settings</a>
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <section class="settings-section">
      <!-- Profile Board -->
      <div class="profile-board">
        <div class="profile-header">
          <i class="fa-solid fa-user-circle profile-icon"></i>
          <div>
            <h2><?php echo htmlspecialchars($displayName); ?></h2>
            <p><i class="fa-solid fa-envelope"></i> <?php echo htmlspecialchars($email); ?></p>
            <p><i class="fa-solid fa-clock"></i> Member since <?php echo $join_date; ?></p>
          </div>
        </div>

        <div class="actions">
          <button><i class="fa-solid fa-pen"></i> Edit Profile</button>
          <button><i class="fa-solid fa-lock"></i> Change Password</button>
          <button class="danger"><i class="fa-solid fa-trash"></i> Delete Account</button>
        </div>
      </div>

      <!-- Recent Activities -->
      <div class="activity-board">
        <h3>Recent Activities</h3>
        <ul class="activity-list">
          <li>📖 Added <b>“Things Fall Apart”</b> to favorites — <span>2 days ago</span></li>
          <li>⭐ Reviewed <b>“Born a Crime”</b> (4/5) — <span>4 days ago</span></li>
          <li>🕓 Logged in from a new device — <span>1 week ago</span></li>
          <li>✏️ Updated profile information — <span>2 weeks ago</span></li>
        </ul>
      </div>
    </section>
  </div>

  <script src="../js/bookMenu.js"></script>
</body>
</html>
