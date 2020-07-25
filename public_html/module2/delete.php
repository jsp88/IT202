<?php
require("functions.php");
$db = getDB();
$idnumber = -1;
$result = array();

if(isset($_GET["idnumber"])){
    $idnumber = $_GET["idnumber"];
    $stmt = $db->prepare("SELECT * FROM Survey where id = :id");
    $stmt->execute([":id"=>$idnumber]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
else{
    echo "ID is not provided in url. Please put the id'?idnumber=(id number where you want to update data)' at the end of URL. ";
}
?>

<form method="POST">
    <label for="title">Title
	<input type="text" id="title" name="title" value="<?php echo get($result, "title");?>"/>
	</label>
	<label for="description">Description
	<input type="text" id="description" name="description" value="<?php echo get($result, "description");?>"/>
	</label>
	<input type="submit" name="delete" value="Delete Survey"/>
</form>

<?php
if(isset($_POST["delete"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
    if(!empty($title) && !empty($description)){
        try{
            $stmt = $db->prepare("DELETE FROM Survey where id=:id");
            $result = $stmt->execute(array(
                
                ":id" => $idnumber
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                
                if ($result){
                    echo "Successfully deleted data: " . $title;
                }
                else{
                    echo "Error deleting data";
                }
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
    else{
        echo "Title and  Description fields cannot be empty.";
    }
}
?>