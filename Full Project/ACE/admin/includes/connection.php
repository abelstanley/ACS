<?php require("constants.php");
?>
<?php
$connect = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
if (!$connect) {
	die ("Connection Failed" . mysql_error());	
}
$selectdb = mysql_select_db (DB_NAME, $connect);

if (!$selectdb){
	die ("Database does not exist" . mysql_error());	
}
 ?>