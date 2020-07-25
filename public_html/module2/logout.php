<?php
include("header.php");
echo "You have successfully logged out";
session_unset();
session_destroy();

if (ini_get("session.use_cookies")) { 
    $params = session_get_cookie_params(); 
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], 
        $params["secure"], $params["httponly"] 
    ); 
}
?>
<!DOCTYPE html>
<html>
<p>To go back to login :  <a href="login.php">Login</a></p>
</html>