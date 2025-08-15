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

if(isset($_POST[delete])){
	
	//check if what we wand to deleete actually exist in the db
$check_existence1 = get_class_by_class_name($_GET['class']);
$check_existence2 = get_class_details_by_class_name($_GET['class']);

if (!$check_existence1 || !$check_existence2){
	
	 echo "<script> alert ('THE CLASS YOU WANT TO DELETE DOES NOT EXIST.');
   		window.location = 'delete_class.php';           
		</script>";
		exit;
	}
	
	// PERFORM THE DELETION
	$class_form_url = $_GET['class'];
	$querry1 = "DELETE FROM classes WHERE class_name = '{$class_form_url}'";
	$querry2 = "DELETE FROM class_details WHERE class_name = '{$class_form_url}'";
	$deleted1 = mysql_query($querry1, $connect);
	$check1 = mysql_affected_rows();
	$deleted2 = mysql_query($querry2, $connect);
	$check2 = mysql_affected_rows();
	
	//confirm deletion
	if ($check1 == 1 && $check2 == 1) {
		// sucess
		echo "<script> alert ('THE CLASS HAS BEEN DELETED SUCCESSFULLY.');
   		window.location = 'delete_class.php';           
		</script>";
		exit;
	}else{
		//failed
		
		echo "<script> alert ('THE CLASS DELETION FAILED (mysql error).');
   		window.location = 'delete_class.php';           
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
  echo  navigation_for_delete($class_collection2, $class_details_collection2);
	 
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
       <strong> <a href="update_class.php"> +  Update Classes </a> </strong>
       <br/>
        <br/>
       <strong> <a href="admin_home.php"> +  Home </a> </strong>
        </td>
      <td id="page"><h2>
          <?php 
	  if (isset($_GET['class'])){
	  echo $class_collection2['class_name'] . "</br>";  
	   ?>
 
        </h2>
        <div class="page-content">
        
          <?php
	   echo "<strong> </br> </br> Date: </strong> &nbsp &nbsp &nbsp &nbsp &nbsp" . 
	   $class_details_collection2['date'] . "</br> </br>";
	   
	   echo "<strong> Venue: </strong> &nbsp &nbsp &nbsp" . 
	   $class_details_collection2['venue'] . "</br> </br>";
	   
	   echo "<strong> Period: </strong> &nbsp &nbsp &nbsp" . 
	   $class_details_collection2['period'] . "</br> </br> </br>";
	   
	   echo "The Number of Students that have registered for this class is:  &nbsp <strong>" . 
	   get_the_number_of_registered_student($class_collection2['class_name']) . " </strong> </br> </br>";
	   
	   ?>
       
       <form action="delete_class.php?class=<?php echo urlencode($class_collection2['class_name']) ?>" method="post">
       <input type="submit" name="delete" value="DELETE THIS CLASS"  onclick="return confirm('ARE YOU SURE?')"/>
       </form>
       
        </div>
        
        <?php
      }else{
		  ?>
        <h2> Select a Class to Delete </h2>
        
        <?php
	  }
	   ?></td>
    </tr>
  </table>
  <?php require ("includes/footer.php"); ?>
