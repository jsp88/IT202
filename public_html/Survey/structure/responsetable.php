<?php
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE Responses(
    id: int not null,
    survey_id: int,
    question_id: int,
    answer_id: int,
    surveytime: datetime,
    user_id: int,
    FOREIGN KEY(survey_id) REFERENCES Survey(`id`),
    FOREIGN KEY(user_id) REFERENCES Users(`id`)
    )CHARACTER SET utf8 COLLATE utf8_general_ci");
	$r = $stmt->execute();
	echo var_export($stmt->errorInfo(), true);
	echo var_export($r, true);
}
catch (Exception $e){
	echo $e->getMessage();
}
?>