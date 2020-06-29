<?php

    
$filter = "";
if(isset($_POST["filter"])){
    $filter = $_POST["filter"];
	
}
?>
<form method="POST">
	<div>
    
    <button type="submit" name="asc_sort" id="asc_sort" class="button" value="1">Ascending</button>
	<button type="submit" name="dec_sort" id="dec_sort" class="button" value="1">Descending</button>
	</div>
</form>
<?php
require("common.inc.php");
if(isset($_POST['asc_sort']) && !empty($_POST['asc_sort']) && $_POST['asc_sort']==1)
{
     $query = "SELECT * FROM Survey ORDER BY title ASC";
	 
	 
	 try {
            $stmt = getDB()->prepare($query);
            
            $stmt->execute([":asc_sort"=>$filter]);
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

}
if(isset($_POST['dec_sort']) && !empty($_POST['dec_sort']) && $_POST['dec_sort']==1){

    $query = "SELECT * FROM Survey ORDER BY title DESC";
	
	try {
            $stmt = getDB()->prepare($query);
            
            $stmt->execute([":dec_sort"=>$filter]);
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
}

?>

<?php if(isset($results)):?>
    <p>we have results.</p>
    <ul>
        
        <?php foreach($results as $row):?>
            <li>
                <?php echo get($row, "title")?>
			
                <?php echo get($row, "description");?>
                
            </li>
        <?php endforeach;?>
    </ul>
<?php else:?>
    <p>we do not have results.</p>
<?php endif;?>