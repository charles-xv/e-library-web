<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Redirect to login if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php?redirect=myBooks.php");
    exit;
}

$user = $_SESSION['user'];

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
  <title>Dashboard | Horizons</title>
  <link rel="stylesheet" href="../css/myBooks.css" />
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
    <a href="#" class="active"><i class="fa-solid fa-book"></i> My Books</a>
    <a href="Recommendation.php"><i class="fa-solid fa-heart"></i> Recommendations</a>
    <a href="News.php"><i class="fa-solid fa-newspaper"></i> News & Articles</a>
    <a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a>
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="mainContent">
    <section class="profile-section">
      <div class="search-profile-card">
        <div class="search-top">
          <h2>Search:</h2>
          <input type="text" placeholder="Search books, authors, genres..." />
        </div>

        <div class="profile-box">
          <div class="profile-left">
            <div class="avatar">
              <i class="fa-solid fa-user"></i>
            </div>
            <div class="profile-text">
              <h2>
                <?php 
                  if (isset($user['type']) && $user['type'] === 'firebase') {
                      // Firebase user (Google login)
                      echo strtoupper(substr($user['email'], 0, 1));
                  } elseif (isset($user['username'])) {
                      // Traditional login user
                      echo htmlspecialchars($user['username']);
                  } else {
                      echo "User";
                  }
                ?> 👋
              </h2>
              <p>Welcome back, reader!</p>
            </div>
          </div>

          <div class="profile-right">
            <div class="book-stat">
              <i class="fa-solid fa-book"></i>
              <div><strong>12 </strong><span> Books Read</span></div>
            </div>
            <div class="book-stat">
              <i class="fa-solid fa-book-open-reader"></i>
              <div><strong>1 </strong><span> Currently Reading</span></div>
            </div>
            <div class="book-stat">
              <i class="fa-solid fa-heart"></i>
              <div><strong>5 </strong><span> Favorites</span></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="books-section">
      <h2>My Library</h2>
      <div class="cards">
        <div class="card">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/01_khafre_north.jpg/500px-01_khafre_north.jpg" alt="Book Cover">
          <h3>The Black Heritage</h3>
          <p>Discover African stories that shaped generations.</p>
        </div>
        <div class="card">
          <img src="https://cdn.britannica.com/64/196564-050-7EF5284E/Chinua-Achebe-2008.jpg" alt="Book Cover">
          <h3>Voices of the Land</h3>
          <p>Reflections of unity, struggle, and triumph.</p>
        </div>
      </div>
    </section>
  </div>

  <script src="../js/bookMenu.js"></script>
</body>
</html>
