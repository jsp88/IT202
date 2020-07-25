
<?php
include("header.php");
?>
<h1>     </h1>
<h1>  </h1>
<h2>  </h2>
<html>
    body  
    {
    background-image: url("surveyimage.jpg");
    }
</html>

<form method="POST">
	<br><br>
	<input type="submit" name="login" value="GET STARTED"/>
    
</form>

<?php
//session_start();
//echo "Welcome to the survey page, " . $_SESSION["user"]["email"];
//width="600" height="400"
if(isset($_POST["login"])) {
	
	header("Location: login.php");
	
}

?>