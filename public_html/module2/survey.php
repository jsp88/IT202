




<?php



include("header.php");

	//$response = file_get_contents('php://input');
	//$send = json_decode($response,true);
	
	//echo $field;

		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           	
			$db = new PDO($connection_string, $dbuser, $dbpass);
		
            $sql = "SELECT Title FROM Survey";
            //$stmt = $db->query($sql);
			
			
 
 

			
			
		if ( $stmt = $db->query($sql)) {
			while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			printf ("%s \n", $row[0]) ;
			
			}
			}
		 $e = $stmt->errorInfo();
		
		}
        catch (Exception $e){
            echo $e->getMessage();
        }

				 
echo "bitch";
echo "bitch";
echo "bitch";
echo "bitch";
echo "bitch";
echo "bitch";



/*	
$curl = curl_init();
$url="https://web.njit.edu/~smg56/CS490/beta/ExamList.php";
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_POST => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POSTFIELDS => $field
  )); 
$resp = curl_exec($curl); 
echo $resp;
*/
?> 
