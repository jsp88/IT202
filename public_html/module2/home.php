
<?php
include("header.php");
?>
<a target="_blank" href="homep.jpg">
      <img src="surveyimage.jpg" width="600" height="400">
    </a>


<form method="POST">
	<br><br>
	<input type="submit" name="login" value="GET STARTED"/>
    
</form>

<?php

if(isset($_POST["login"])) {
	
	header("Location: login.php");
	
}

?>