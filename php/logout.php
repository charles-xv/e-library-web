<?php
session_start();


if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    session_unset();
    session_destroy();

    
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");

  
    header("Location: ../html/index.html"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logout Confirmation</title>
<style>
  body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #ece9e6, #ffffff);
    height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    display: flex;
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.3s ease-in-out;
  }

  .popup {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    padding: 35px 30px;
    border-radius: 25px;
    text-align: center;
    width: 340px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    animation: popIn 0.3s ease;
  }

  .popup h2 {
    margin-bottom: 12px;
    color: #222;
    font-weight: 600;
  }

  .popup p {
    color: #555;
    margin-bottom: 25px;
  }

  .buttons {
    display: flex;
    justify-content: space-around;
    gap: 10px;
  }

  .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.25s ease;
  }

  .btn.confirm {
    background: #007bff;
    color: white;
  }

  .btn.confirm:hover {
    background: #8f00ff;
    transform: scale(1.05);
  }
   .btn.confirm:active{
    background: #400677; 
   }

  .btn.cancel {
    background: #ddd;
  }

  .btn.cancel:hover {
    background: #bbb;
    transform: scale(1.05);
  }

  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  @keyframes popIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
  }
</style>
</head>
<body>

<div class="overlay">
  <div class="popup">
    <h2>Confirm Logout</h2>
    <p>Are you sure you want to log out of your account?</p>
    <div class="buttons">
      <button class="btn confirm" onclick="confirmLogout()">Yes, Logout</button>
      <button class="btn cancel" onclick="cancelLogout()">Cancel</button>
    </div>
  </div>
</div>

<script>
function confirmLogout() {
  window.location.href = "logout.php?confirm=yes";
}

function cancelLogout() {
  window.location.href = "myBooks.php";
}
</script>

</body>
</html>
