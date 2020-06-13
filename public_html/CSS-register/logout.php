<?php
include("header.php");
echo "You have been logged out";
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<p>To go back to login :  <a href="login.php">Login</a></p>
</html>