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
      <h2> + Create User </h2>
      <br/>
      
      <form action="create_user.php" method="post">
      <p> Full Name: &nbsp &nbsp &nbsp &nbsp;
      	<input type="text" name="name" value="" id="name" />
       </p>
       
       <p> Organization:  &nbsp; &nbsp;
      	<input  type="text" name="org" value="" id="org" />
       </p>
      
       <p> Username: &nbsp; &nbsp &nbsp &nbsp;
      	<input type="text" name="username" value="" id="username" />
       </p>
       
       <p> Password: &nbsp; &nbsp; &nbsp; &nbsp &nbsp;
      	<input type="password" name="password" value="" id="password" />
       </p>
       
      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <input type="submit" value="+ Creat User" />
      </form>
      <br/>
      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <a href="admin_home.php">XX Cancel </a>
      
      </td>
    </tr>
  </table>
  <?php require ("includes/footer.php"); ?>
 