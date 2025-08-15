<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php


// form validation
$errors = array();
$fields = array('name', 'org', 'username', 'password');
foreach($fields as $fieldname) {
	if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
		$errors[] = $fieldname;
	}
}



/* NOW FOR LENGHT

$fields_with_lenght = array('class_name' => 30);
foreach($fields_with_lenght as $fieldname => $max_lenght) {
	if(strlen(trim(mysql_spercial_characters_clean($_POST[$fieldname]))) > $max_lenght) {
		$errors[] = $fieldname; 
		}
}

*/

if (!empty($errors)) {
	echo "<script> alert ('NON OF THE FORM FIELDS CAN BE EMPTY');
	window.location = 'add_user.php';
	</script>"; 
	exit;
}


?>

<?php
$name = mysql_spercial_characters_clean($_POST['name']);
$org = mysql_spercial_characters_clean($_POST['org']);
$username = mysql_spercial_characters_clean($_POST['username']);
$password = mysql_spercial_characters_clean($_POST['password']);

$check_existence1 = get_user_by_username_or_password('username', $_POST['username']);
$check_existence2 = get_class_details_by_class_name('password', $_POST['password']);

if ($check_existence1 || $check_existence2){
	
	 echo "<script> alert ('THE USERNAME OR PASSWORD ALREADY EXIST.');
   		window.location = 'add_user.php';           
		</script>";
		exit;
	}
			
$querry = "insert into users (
			name, organization, username, password)
			values (
			'{$name}', '{$org}', '{$username}', '{$password}' )" ;			
	
	$insert = mysql_query($querry, $connect);
	if ($insert ){
		// Insertion was successful
   echo "<script> alert ('THE USER HAS BEEN CREATED SUCCESSFULLY');
   		window.location = 'manage_user.php';           
		</script>";
		exit;
		}else{
			
			//insertion Failed
			
			echo "<script> alert ('USER CREATION FAILED {mysql_error()}');
					window.location = 'add_user.php';
					 </script>";
		 exit;		
			}
?>

<?php mysql_close($connect); ?>