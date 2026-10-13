<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php?redirect=myBooks.php");
    exit;
}
$user = $_SESSION['user'];
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Prevent back button access after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Check login
if (!isset($_SESSION['user'])) {
    header("Location: login.php?redirect=myBooks.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recommendations | Horizons</title>
  <link rel="stylesheet" href="../css/Recommendation.css" />
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
    <a href="#" class="active"><i class="fa-solid fa-heart"></i> Recommendations</a>
    <a href="News.php"><i class="fa-solid fa-newspaper"></i> News & Articles</a>
    <a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a>
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
  </div>

  <!-- Main Grid Layout -->
  <div class="grid-layout">
    <!-- Main Content -->
    <main class="main-content">
      <section class="books-section">
        <h2>Recommended For You</h2>
        <p class="intro">
          Based on your reading history and favorite authors.
        </p>

        <div class="cards">
          <div class="card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c2/01_khafre_north.jpg" alt="Book Cover">
            <h3>The Black Heritage</h3>
            <p>Discover African stories that shaped generations — a timeless
            reflection on identity and legacy.</p>
          </div>
          <div class="card">
            <img src="https://m.media-amazon.com/images/I/81xHkY9QOaL._AC_UF1000,1000_QL80_.jpg" alt="Book Cover">
            <h3>Echoes of Time</h3>
            <p>A poetic journey through history and resilience by contemporary
            African poets.</p>
          </div>
          <div class="card">
            <img src="https://marcellus.in/wp-content/uploads/2019/05/Working-Habits-of-Great-Minds.jpg" alt="Book Cover">
            <h3>Boundless Minds</h3>
            <p>Explore how visionaries across generations broke boundaries and
            redefined creativity.</p>
          </div>
          <div class="card">
            <img src="https://cdn.pixabay.com/photo/2016/11/29/12/54/book-1869949_1280.jpg" alt="Book Cover">
            <h3>Modern Voices</h3>
            <p>Contemporary authors reshaping African literature with digital
            storytelling and bold narratives.</p>
          </div>
          <div class="card">
            <img src="https://cdn.pixabay.com/photo/2017/01/10/23/01/reading-1977615_1280.jpg" alt="Book Cover">
            <h3>Whispers of Lagos</h3>
            <p>A vibrant collection capturing the rhythm, chaos, and charm of
            Nigeria’s megacity.</p>
          </div>
          <div class="card">
            <img src="https://cdn.pixabay.com/photo/2016/03/27/19/50/books-1281581_1280.jpg" alt="Book Cover">
            <h3>Pages of Freedom</h3>
            <p>Memoirs and essays on liberation movements and voices that
            refused to be silenced.</p>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
      <footer>
      <p>© 2025 Horizons | All Rights Reserved</p>
    </footer>

  <script src="../js/bookMenu.js"></script>
</body>
</html>
