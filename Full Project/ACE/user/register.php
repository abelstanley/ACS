<?php session_start(); 
require_once("includes/connection.php"); ?>  
<?php require_once("includes/functions.php"); ?>
<?php
	find_selected_clsss_or_clsss_details ();
			
?>

<?php
// check for by-cutters
$username = $_SESSION['username'];
		if(!$username){
			echo "<script> alert ('..OGA, GO BACK AND LOGIN!  ... YOU THINK SAY YOU SMART');
   		window.location = 'user_login.php';           
		</script>";
		exit;
			}
if (isset($_POST['register'])){
	$classname = $_GET['class'];
	$querry = "SELECT * FROM registered_staff WHERE username = '$username' and class_name = '$classname'";
	 $select = mysql_query($querry, $connect);
	 if(mysql_num_rows($select) != 0){
		 // Already registered
		 echo "<script> alert ('..YOU HAVE ALREADY REGISTERED FOR THIS CLASS');
   		window.location = 'register.php';           
		</script>";
		exit;
	 }
	 $max_number = $class_details_collection2['max_num_of_attend'];
	 $num_available = get_the_number_of_registered_student($_GET['class_name']);
	 if ($num_available >= $max_number){
		 // maximum number reached
		 echo "<script> alert ('..THE MAXIMUM NUMBER OF EXPECTED STUDENTS HAVE BEEN REACHED');
   		window.location = 'register.php';           
		</script>";
		exit;
		 
		 }
	 
	 
	 
	 $querry = "insert into registered_staff (
			class_name, username)
			values (
			'{$classname}', '{$username}')" ;			
	
	$insert = mysql_query($querry, $connect);
	if ($insert){
		//SUCESS
		echo "<script> alert ('..CLASS REGISTERED SUCCESSFULLY!');
   		window.location = 'register.php';           
		</script>";
		exit;
	}else{
		//failed
		echo "<script> alert ('..FAILED TO REGISTER! (mysql error)');
   		window.location = 'register.php';           
		</script>";
		exit;
	}
	


} //end of isset
?>

<?php include ("includes/header.php"); ?>
  <table id="structure">
    <tr>
      <td id="navigation"><?php
  echo  navigation_for_register ($class_collection2, $class_details_collection2);
	 
	 ?>
     <br/>
        <br/>
     <hr />
     <hr />  
        <br/>
        
       <strong> <a href="view_registered_classes.php"> View/Print Registered Classes </a> </strong>
       <br/>
       <br/>
       <strong> <a href="user_logout.php"> X  Logout </a> </strong>
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
	   
	   ?>
       <form action="register.php?class=<?php echo urlencode($class_collection2['class_name']); ?>" method="post" >
       <input type="submit" name="register" value="REGISTER FOR THIS CLASS" />
       </form>
       
        </div>
        <?php
      }else{
		  ?>
        <h2> Select a Class to Register </h2>
        <?php
	  }
	   ?></td>
    </tr>
  </table>
  <?php require ("includes/footer.php"); ?>
