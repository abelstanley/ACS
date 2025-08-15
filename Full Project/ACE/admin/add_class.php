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
<?php include ("includes/header.php"); ?>
  <table id="structure">
    <tr>
      <td id="navigation"> 
      <br/>
        <br/>
     <hr />
     <hr />
        
         
        <br/>
       <strong> <a href="view_classes.php"> +  View Classes </a> </strong>
       <br/>
       <br/>
         <strong> <a href="update_class.php"> + Update Classes </a> </strong>
         <br/>
        <br/>
       <strong> <a href="delete_class.php"> +  Delete Classes </a> </strong>
      
              </td>
        
      <td id="page">
      <h2> + Create Class </h2>
      <br/>
      
      <form action="create_class.php" method="post">
      <p> Class Name: &nbsp &nbsp &nbsp &nbsp;
      	<input type="text" name="class_name" value="" id="class_name" />
       </p>
       
       <p> Date: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
      	<input  type="text" name="date" value="" id="date" />
       </p>
        
       <p> Period: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
      	<input type="text" name="period" value="" id="period" />
       </p>
       
       <p> Max. Atendant: &nbsp &nbsp;
      	<input type="number" name="max" value="" id="max" />
       </p>
       
        <p> Venue: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
      	<textarea type="text" name="venue" value="" id="venue" > </textarea>
       </p>
       
      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <input type="submit" value="+ Creat Class" />
      </form>
      <br/>
      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <a href="admin_home.php">XX Cancel </a>
      
      </td>
    </tr>
  </table>
  <?php require ("includes/footer.php"); ?>
 