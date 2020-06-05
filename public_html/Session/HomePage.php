<?php
session_start();
echo "WELCOME, " . $_SESSION["user"]["email"];
?>
<a href="logout.php">Logout</a>