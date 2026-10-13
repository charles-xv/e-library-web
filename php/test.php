<?php
require 'db.php'; // Adjust path if db.php is in another folder

if ($conn) {
    echo "Database connected successfully!";
} else {
    echo "Failed to connect to database.";
}
?>
