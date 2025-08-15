<?php session_start();
require_once("includes/connection.php"); ?>  
<?php require_once("includes/functions.php"); ?>
<?php
	// check for by-cutters
$username = $_SESSION['username'];
		if(!$username){
			echo "<script> alert ('..OGA, GO BACK AND LOGIN!  ... YOU THINK SAY YOU SMART');
   		window.location = 'admin_login.php';           
		</script>";
		exit;
		}
	
?>
<?php
if(isset($_POST['update'])){
	
    // form validation
	$errors = array();
	$fields = array('class_name', 'date', 'venue', 'period', 'max');
	foreach($fields as $fieldname) {
		if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
			$errors[] = $fieldname;
		}
	}
	
	if (!empty($errors)) {
	echo "<script> alert ('NON OF THE FORM FIELDS CAN BE EMPTY');
	window.location = 'update_class.php';
	</script>"; 
	exit;
}
// clean the inputs for easy pass to db
$class_name = mysql_spercial_characters_clean($_POST['class_name']);
$date = mysql_spercial_characters_clean($_POST['date']);
$venue = mysql_spercial_characters_clean($_POST['venue']);
$period = mysql_spercial_characters_clean($_POST['period']);
$max = mysql_spercial_characters_clean($_POST['max']);

//check if what we wand to edit actually exist in the db
$check_existence1 = get_class_by_class_name($_GET['class']);
$check_existence2 = get_class_details_by_class_name($_GET['class']);

if (!$check_existence1 || !$check_existence2){
	
	 echo "<script> alert ('THE CLASS YOU WANT TO UPDATE DOES NOT EXIST.');
   		window.location = 'admin_home.php';           
		</script>";
		exit;
	}
// THE UPDATE GAN GAN

$querry1 = "UPDATE classes SET
			class_name = '{$class_name}'
			WHERE class_name = '{$_GET['class']}'";
			
$querry2 = "UPDATE class_details SET
			class_name = '{$class_name}',
			date = '{$date}',
			period = '{$period}',
			venue = '{$venue}',
			max_num_of_attend = {$max}
			WHERE class_name = '{$_GET['class']}'";
			
$update1 = mysql_query($querry1, $connect);	
$updated1 = mysql_affected_rows();		
			
$update2 = mysql_query($querry2, $connect);
$updated2 = mysql_affected_rows();


if($updated1 == 1 || $updated2 == 1 ){
	
	//Success
	//$message = "The CLASS was successfuly updated";
	$url_encoded_class_name = urlencode($class_name);
	echo "<script> alert ('THE CLASS HAS BEEN UPDATED SUCCESSFULLY.');
   		window.location = 'update_class.php?class=$url_encoded_class_name';           
		</script>";
		exit;
	
	}else{
		
		//Failed
		echo "<script> alert ('UNABLE TO UPDATE CLASS. Probably because you did not make any change (MySql error) ');
   		window.location = 'update_class.php';           
		</script>";
		exit;
	}



} //end of isset

 ?>

<?php
  	find_selected_clsss_or_clsss_details ();
?>
<?php include ("includes/header.php"); ?>
  <table id="structure">
    <tr>
      <td id="navigation"><?php
  echo  navigation_for_update ($class_collection2, $class_details_collection2);
	 
	 ?>
        <br/>
        <br/>
     <hr />
     <hr />
        
         <br/>
         <strong> <a href="add_class.php"> + Add a new class </a> </strong>
         <br/>
        <br/>
       <strong> <a href="view_classes.php"> +  View Classes </a> </strong>
       <br/>
        <br/>
       <strong> <a href="delete_class.php"> +  Delete Classes </a> </strong>
       <br/>
        <br/>
       <strong> <a href="admin_home.php"> +  Home </a> </strong>
       
        </td>
      <td id="page">
      <h2>
          <?php 
	  if (isset($_GET['class'])){
	  echo "Update:  " . $class_collection2['class_name'] . "</br>";  
	   ?>
 
        </h2>
        <h4> <?php echo $message ?> </h4>
        <div class="page-content">
        
          <form action="update_class.php?class=<?php echo urlencode($class_collection2['class_name']); ?>" method="post">
          
      <p> Class Name: &nbsp &nbsp &nbsp &nbsp;
      	<input type="text" name="class_name" value="<?php echo $class_details_collection2['class_name']; ?>" id="class_name" />
       </p>
       
       <p> Date: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
      	<input  type="text" name="date" value="<?php echo $class_details_collection2['date']; ?>" id="date" />
       </p>
        
       <p> Period: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
      	<input type="text" name="period" value="<?php echo $class_details_collection2['period']; ?>" id="period" />
       </p>
       
       <p> Max. Atendant: &nbsp &nbsp;
      	<input type="number" name="max" value="<?php echo $class_details_collection2['max_num_of_attend']; ?>" id="number" />
       </p>
       
        <p> Venue: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
      	<textarea type="text" name="venue" id="venue" > <?php echo $class_details_collection2['venue']; ?> 
         </textarea>
       </p>
       
      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <input type="submit" name="update" value="Update Class" />
      </form>
      <br/>
      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <a href="admin_home.php">XX Cancel </a>
        </div>
        <?php
      }else{
		  ?>
        <h2> Select a Class to Update </h2>
        <?php
	  }
	   ?></td>
    </tr>
  </table>
  <?php require ("includes/footer.php"); ?>
