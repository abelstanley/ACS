<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>  
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
  	find_selected_clsss_or_clsss_details ();
			
	
?>
<?php include ("includes/header.php"); ?>
  <table id="structure">
    <tr>
      <td id="navigation"><?php
  echo  navigation ($class_collection2, $class_details_collection2);
	 
	 ?>
     <br/>
        <br/>
     <hr />
     <hr />
        
         <br/>
         <strong> <a href="add_class.php"> + Add a new class </a> </strong>
         <br/>
        <br/>
       <strong> <a href="update_class.php"> +  Update Classes </a> </strong>
       <br/>
        <br/>
       <strong> <a href="delete_class.php"> +  Delete Classes </a> </strong>
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
	   $class_details_collection2['period'] . "</br> </br> </br> </br>";
	   
	   echo "The Number of Students that have registered for this class is:  &nbsp <strong>" . 
	   get_the_number_of_registered_student($class_collection2['class_name']) . " </strong> </br>";
	   
	   ?>
        </div>
        <?php
      }else{
		  ?>
        <h2> Select a Class to view the details </h2>
        <?php
	  }
	   ?></td>
    </tr>
  </table>
  <?php require ("includes/footer.php"); ?>
