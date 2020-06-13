<?php
include("header.php");
echo "You have been logged out";
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<h1>HTML Links</h1>
<p><a href="login.php">Login</a></p>
</html>