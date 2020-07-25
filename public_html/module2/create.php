<?php
include("header.php");

?>
<div>
<form method="POST">
    <label for="title">title
	<input type="text" id="title" name="title" />
	<span class="error" id="title">* <?php echo $titlError;?></span>
	</label><br><br>
	<label for="description">Description
	<input type="text" id="description" name="description" />
	<span class="error" id="description">* <?php echo $descriptionErr;?></span>
	</label><br><br>
    <input type="submit" name="created" value="Create Survey"/>
</form>
</div>

<?php
if(isset($_POST["created"])){
	
	if(empty($_POST["title"])){
			
			$titleError = "Title is missing";
			
		}
		else{
			$title = $_POST["title"];
		}
	if(empty($_POST["description"])){
			
			$descriptionErr = "Description is missing";
			
		}
		else{
			$description = $_POST["description"];
		}
		
	
	
    if(!empty($title) && !empty($description)){
		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
			$db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO Survey (title, description) VALUES (:title, :description)");
            $result = $stmt->execute(array(
                ":title" => $title,
                ":description" => $description,
				
            ));
			
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                
                if ($result){
					
					header('Location: create_question.php');

                }
                else{
                    echo "Error creating data";
                }
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
	
}
?>


