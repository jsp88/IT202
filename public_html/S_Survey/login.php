<?php
include("header.php");

?>




<?php
//session_start();

$emailerr = $passerr = "";
$email = $password = "";

if(isset($_POST["login"])) {	
	
		//$password = $_POST["password"];
		//$email = $_POST["email"];
		
		if(empty($_POST["email"])){
			
			$emailerr = "Email required";
			
			
		} else {
			$email = $_POST["email"];
		}
		if(empty($_POST["password"])){
			
			$passerr = "Password required";
		} else {
			$password = $_POST["password"];
			
		}
		
		
		
		if(!empty($email) && !empty($password)){
	
		
					$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
					try{
						$db = new PDO($connection_string, $dbuser, $dbpass);
						$stmt = $db->prepare("SELECT * FROM Users where email = :email LIMIT 1");
						$stmt->execute(array(
							":email" => $email
						));
						$e = $stmt->errorInfo();
						if($e[0] != "00000"){
							echo var_export($e, true);
						}
						else{
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
							if ($result){
								$rpassword = $result["password"];
								if(password_verify($password, $rpassword)){
									echo "<div>Passwords matched! You are logged in!</div>";
									$_SESSION["user"] = array(
										"id"=>$result["id"],
										"email"=>$result["email"],
										"first_name"=>$result["first_name"],
										"last_name"=>$result["last_name"]
									);
									echo var_export($_SESSION, true);
									//echo "<a href='home.php'>Go to home page</a>";
									header("Location: response.php");
								}
								else{
									echo "<div>Not a valid password!</div>";
								}
							}
							else{
								echo "<div>Not a valid user</div>";
								
							}
							
						}
					}
					catch (Exception $e){
						echo $e->getMessage();
					}
					
				
			
	
		}
		
		


	
	
	
}




?>



<h1>  </h1>
<h2>Please Login here with your existing account.</h2>

<div>
<span class="error">* required field</span>
<form method="POST">
	<label for="email">Email
	<input type="email" id="email" name="email" />
	<span class="error" id="email">* <?php echo $emailerr;?></span>
	</label><br><br>
	
	<label for="p">Password
	<input type="password" id="p" name="password" />
	<span class="error" id="p">* <?php echo $passerr;?></span>
	</label><br><br><br>
	<input type="submit" name="login" value="Login"/>
	
	<p>Not registered yet?  <a href="register.php">Click Here</a></p>
	<br><br>
</form>
</div>
