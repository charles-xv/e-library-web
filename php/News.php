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
    header("Location: login.php?redirect=/php/myBooks.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | Horizons</title>
  <link rel="stylesheet" href="../css/news.css" />
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
    <a href="#" class="active"><i class="fa-solid fa-newspaper"></i> News & Articles</a>
    <a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a>
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
  </div>

  <!-- Main Content -->
  <main class="main-content">
    <header class="welcome-header"></header>

    <section class="news-hero">
      <h1>📚 Latest News & Articles</h1>
      <p>Stay updated with the latest book releases, author interviews, and literary discussions.</p>
      <input type="text" class="search-bar" placeholder="🔍 Search articles...">
    </section>

    <section class="news-grid">
      <div class="news-card">
        <img src="/images-z/book-release.jpg" alt="Book Release">
        <div class="news-content">
          <h3>New Fantasy Epic Launches Worldwide</h3>
          <p>Discover the magical universe of the new fantasy saga that has readers enchanted around the globe...</p>
          <a href="#" class="read-more">Read More →</a>
        </div>
      </div>

      <div class="news-card">
        <img src="/images-z/author-interview.jpg" alt="Author Interview">
        <div class="news-content">
          <h3>Exclusive Interview with Author Sarah N.</h3>
          <p>We sat down with the award-winning author to discuss her inspirations, writing process, and next big project...</p>
          <a href="#" class="read-more">Read More →</a>
        </div>
      </div>

      <div class="news-card">
        <img src="/images-z/author-interview.jpg" alt="Author Interview">
        <div class="news-content">
          <h3>Exclusive Interview with Author Sarah N.</h3>
          <p>We sat down with the award-winning author to discuss her inspirations, writing process, and next big project...</p>
          <a href="#" class="read-more">Read More →</a>
        </div>
      </div>

      <div class="news-card">
        <img src="/images-z/author-interview.jpg" alt="Author Interview">
        <div class="news-content">
          <h3>Exclusive Interview with Author Sarah N.</h3>
          <p>We sat down with the award-winning author to discuss her inspirations, writing process, and next big project...</p>
          <a href="#" class="read-more">Read More →</a>
        </div>
      </div>

      <div class="news-card">
        <img src="/images-z/author-interview.jpg" alt="Author Interview">
        <div class="news-content">
          <h3>Exclusive Interview with Author Sarah N.</h3>
          <p>We sat down with the award-winning author to discuss her inspirations, writing process, and next big project...</p>
          <a href="#" class="read-more">Read More →</a>
        </div>
      </div>

      <div class="news-card">
        <img src="/images-z/literary-trend.jpg" alt="Literary Trends">
        <div class="news-content">
          <h3>Trends Shaping Modern Literature</h3>
          <p>From AI-generated poetry to cross-genre storytelling — here’s what’s defining the literary world in 2025...</p>
          <a href="#" class="read-more">Read More →</a>
        </div>
      </div>
    </section>

    <footer>
      <p>© 2025 Horizons | All Rights Reserved</p>
    </footer>
  </main>


  <script src="../js/bookMenu.js"></script>
</body>
</html>
