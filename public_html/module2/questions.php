<?php
	require('config.php');
	$array = array();
	$response = file_get_contents('php://input');
    $array = json_decode($response,true);       

	$id = $array['titlename'];
    
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           	
			$db = new PDO($connection_string, $dbuser, $dbpass);
		
            $sql = "SELECT id FROM Survey WHERE title='$id'";
			
		if ( $stmt = $db->query($sql)) {
			$row = $stmt->fetch(PDO::FETCH_NUM);
			}	
		$id = $row[0];
		 $e = $stmt->errorInfo();
		}
        catch (Exception $e){
            echo $e->getMessage();
        }
		
		try{
           	
			$db = new PDO($connection_string, $dbuser, $dbpass);
		
            $sql = "SELECT question1, question2, question3, question4, question5 FROM Questions WHERE id='$id'";
			
		if ( $stmt = $db->query($sql)){
			$row = $stmt->fetch(PDO::FETCH_NUM);
				$question1= $row[0];
				$question2 = $row[1];
				$question3 = $row[2];
				$question4 = $row[3];
				$question5 = $row[4];
				$sendarray= array("=question1" => $question1, "question2" => $question2, "question3" => $question3, "question4" => $question4, "question5" => $question5);
			}
		$e = $stmt->errorInfo();
		$f = json_encode($sendarray);
		echo $f;
		}
        catch (Exception $e){
            echo $e->getMessage();
        }

?>

