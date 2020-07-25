<?php
include("header.php");
?>
<?php
$fnameErr=$LnameErr= "";
$firstname=$lastname= "";
$emailError = $passErr = "";
$email = $password = "";
if(isset($_POST["register"]))
{
    if(empty($_POST["firstname"]))
       {
        $fnameErr = "First name required";	
		} 
       else {
			$firstname = $_POST["firstname"];
		}
    if(empty($_POST["lastname"])){
			$LnameErr = "Last name required";	
		} 
       else {
			$email = $_POST["email"];
		} 
	
    if(empty($_POST["email"])){
			$emailError = "Email required";		
		} 
       else {
			$email = $_POST["email"];
		}
    if(empty($_POST["password"])){
			
			$passErr = "Password required";
		} 
       else {
			$password = $_POST["password"];
			
		}
    if(empty($_POST["cpassword"])){
			
			$passErr1 = "Password confirmation required";
		} 
       else {
			$cpassword = $_POST["cpassword"];
			
		}
		
	if(!empty($email) && !empty($password) && !empty($_POST["cpassword"]) && !empty($firstname) && !empty($lastname)){
		if($password == $cpassword){
			$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
			try{
				$db = new PDO($connection_string, $dbuser, $dbpass);
				$hash = password_hash($password, PASSWORD_BCRYPT);
				$stmt = $db->prepare("INSERT INTO Users ( email, firstname, lastname, password) VALUES(:email, :firstname, :lastname, :password)");
				$stmt->execute(array(
					":email" => $email,
                    ":firstname" => $firstname,
                    ":lastname" => $lastname,
					":password" => $hash
				));
				$e = $stmt->errorInfo();
				if($e[0] != "00000"){
					echo var_export($e, true);
				}
				else{
					echo "<div>REGISTRATION SUCCEED!</div>";
				}
			}
			catch (Exception $e){
				echo $e->getMessage();
			}
		}
		else{
			echo "<div>Passwords don't match</div>";
		}
	}
}
?>
<h1> Register here. </h1>
<div>
<span class="error">* REQUIRE FIELDS</span>
<form method="POST">
    <label for="firstname">firstname
    <input type="firstname" id="firstname" name="firstname" autocomplete="off" />
    <span class="error" id="firstname">* <?php echo $fnameErr;?></span>
    </label> <br><br>
    
    <label for="lastname">lastname
    <input type="lastname" id="lastname" name="lastname" autocomplete="off" />
    <span class="error" id="lastname">* <?php echo $LnameErr;?></span>
    </label><br><br>
        
	<label for="email">Email
	<input type="email" id="email" name="email" />
	<span class="error" id="email">* <?php echo $emailError; ?></span>
	</label><br><br>

	<label for="p">Password
	<input type="password" id="p" name="password" autocomplete="off"/>
    <span class="error" id="p">* <?php echo $passErr;?></span>
    </label><br><br>

	<label for="cp">Confirm Password
	<input type="password" id="cp" name="cpassword"/>
    <span class="error" id="p">* <?php echo $passErr1;?></span>
	</label><br><br>

	<input type="submit" name="register" value="Register"/>
</form>