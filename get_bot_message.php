<?php
date_default_timezone_set('Asia/Kolkata');
require_once 'dbconfig/config.php';

$stmt = $db->quote($_POST['txt']);
$sql="SELECT reply from tbl_chatbot_hints WHERE question LIKE $stmt";
$result = $db->prepare($sql);
$result->execute();
if($result->rowCount() > 0){
	$row = $result->fetch(PDO::FETCH_ASSOC);
	$content = $row['reply'];
}else{
	$content = "Sorry not be able to understand you";
}
$result->closeCursor();

$added_on=date('Y-m-d h:i:s');
$db->prepare("INSERT INTO tbl_message (message,added_on,type) VALUES('$stmt','$added_on','user')");


$added_on=date('Y-m-d h:i:s');
$db->prepare("INSERT INTO tbl_message(message,added_on,type) VALUES('$content','$added_on','bot')");


echo $content;
echo " ";
?>


