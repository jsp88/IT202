<?php
include("header.php");
session_unset();
session_destroy();
echo "You have been logged out";
header( 'Location: login.php' ) ;

?>