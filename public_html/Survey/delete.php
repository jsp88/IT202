<?php
require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);
$Id = -1;
$result = array();
function get($arr, $key){
    if(isset($arr[$key])){
        return $arr[$key];
    }
    return "";
}
if(isset($_GET["Id"])){
    $Id = $_GET["Id"];
    $stmt = $db->prepare("SELECT * FROM Survey where id = :id");
    $stmt->execute([":id"=>$Id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
else{
    echo "No Id provided in url";
}
?>

<form method="POST">
    <label for="title">Title
	<input type="text" id="title" name="title" value="<?php echo get($result, "title");?>"/>
	</label>
	<label for="description">Description
	<input type="text" id="description" name="description" value="<?php echo get($result, "description");?>"/>
	</label>
	<label for="visibility">Visibility
	<input type="number" id="visibility" name="visibility" value="<?php echo get($result, "visibility");?>" />
	</label>
	<input type="submit" name="delete" value="Delete Survey"/>
</form>

<?php
if(isset($_POST["delete"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $visibility = $_POST["visibility"];
    if(!empty($title) && !empty($description) && !empty($visibility)){
        try{
            $stmt = $db->prepare("DELETE FROM Survey where id=:id");
            $result = $stmt->execute(array(
                
                ":id" => $Id
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                
                if ($result){
                    echo "Successfully deleted records: " . $title;
                }
                else{
                    echo "Error deleting records";
                }
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
    else{
        echo "Title, Description and Visibility fields cannot be empty.";
    }
}
?>