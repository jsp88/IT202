<form method="POST">
    <label for="firstname">firstname
    <input type="firstname" id="firstname" name="firstname" autocomplete="off" />
    </label>
    <label for="lastname">lastname
    <input type="lastname" id="lastname" name="lastname" autocomplete="off" />
    </label>
	<label for="email">Email
	<input type="email" id="email" name="email" autocomplete="off" />
	</label>
	<label for="p">Password
	<input type="password" id="p" name="password" autocomplete="off"/>
	</label>
	<label for="cp">Confirm Password
	<input type="password" id="cp" name="cpassword"/>
	</label>
	<input type="submit" name="register" value="Register"/>
</form>

<?php
if(isset($_POST["register"])){
	if(isset($_POST["password"]) && isset($_POST["cpassword"]) && isset($_POST["email"]) && isset($_POST["firstname"]) && isset($_POST["lastname"])){
		$password = $_POST["password"];
		$cpassword = $_POST["cpassword"];
		$email = $_POST["email"];
        $firstname = $_POST["firstname"];
        $lastname= $_POST["lastname"];
		if($password == $cpassword){
			require("config.php");
			$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
			try{
				$db = new PDO($connection_string, $dbuser, $dbpass);
				$hash = password_hash($password, PASSWORD_BCRYPT);
				$stmt = $db->prepare("INSERT INTO Users (email,firstname,lastname,password) VALUES(:email, :firstname, :lastname, :password)");
				$stmt->execute(array(
					":email" => $email,
                    ":firstname" => $firstname,
                    ":lastname" => $lastname,
					":password" => $hash // Use to protect your password 
				));
				$e = $stmt->errorInfo();
				if($e[0] != "00000"){
					echo var_export($e, true);
				}
				else{
					echo "<div>Successfully registered!</div>";
				}
			}
			catch (Exception $e){
				echo $e->getMessage();
			}
		}
		else{
			echo "<div>Passwords dones not match</div>";
		}
	}
}
?>
