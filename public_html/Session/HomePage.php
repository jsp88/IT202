<?php
session_start();
echo "WELCOME, " . $_SESSION["user"]["email"];
?>
<a href="RegLogout.php">Logout</a>
