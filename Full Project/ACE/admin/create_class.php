<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php


// form validation
$errors = array();
$fields = array('class_name', 'date', 'venue', 'period', 'max');
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
	window.location = 'add_class.php';
	</script>"; 
	exit;
}


?>

<?php
$class_name = mysql_spercial_characters_clean($_POST['class_name']);
$date = mysql_spercial_characters_clean($_POST['date']);
$venue = mysql_spercial_characters_clean($_POST['venue']);
$period = mysql_spercial_characters_clean($_POST['period']);
$max = mysql_spercial_characters_clean($_POST['max']);

$check_existence1 = get_class_by_class_name($_POST['class_name']);
$check_existence2 = get_class_details_by_class_name($_POST['class_name']);

if ($check_existence1 || $check_existence2){
	
	 echo "<script> alert ('THE CLASS YOU WANT TO CREATE ALREADY EXIST.');
   		window.location = 'add_class.php';           
		</script>";
		exit;
	}


$querry1 = "insert into classes (
			class_name)
			values (
			'{$class_name}')" ;
			
$querry2 = "insert into class_details (
			class_name, date, venue, period, max_num_of_attend)
			values (
			'{$class_name}', '{$date}', '{$venue}', '{$period}', {$max} )" ;			
	
	$insert1 = mysql_query($querry1, $connect);
	$insert2 = mysql_query($querry2, $connect);
	if ($insert1 && $insert2){
		// Insertion was successful
   echo "<script> alert ('THE CLASS HAS BEEN ADDED SUCCESSFULLY');
   		window.location = 'view_classes.php';           
		</script>";
		exit;
		}else{
			
			//insertion Failed
			
			echo "<script> alert ('CLASS ADDITION FAILED {mysql_error()}');
					window.location = 'add_class.php';
					 </script>";
		 exit;		
			}
?>

<?php mysql_close($connect); ?>