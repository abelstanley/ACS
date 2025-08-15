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

if(isset($_POST['delete'])){

	// PERFORM THE DELETION
	$user_form_url = $_GET['user'];
	$querry = "DELETE FROM users WHERE username = '{$user_form_url}'";
	$deleted = mysql_query($querry, $connect);
	$check = mysql_affected_rows();
	
	//confirm deletion
	if ($check == 1) {
		// sucess
		echo "<script> alert ('THE CLASS HAS BEEN DELETED SUCCESSFULLY.');
   		window.location = 'manage_user.php';           
		</script>";
		exit;
	}else{
		//failed
		
		echo "<script> alert ('THE CLASS DELETION FAILED (mysql error).');
   		window.location = 'manage_user.php';           
		</script>";
		exit;
		
	}
	
	} //end of isset


?>


<?php
if(isset($_POST['update'])){
	
    // form validation
	$errors = array();
	$fields = array('name', 'org', 'username', 'password');
	foreach($fields as $fieldname) {
		if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
			$errors[] = $fieldname;
		}
	}
	
	if (!empty($errors)) {
	echo "<script> alert ('UPDATE FAILED... NON OF THE FORM FIELDS CAN BE EMPTY');
	window.location = 'manage_user.php';
	</script>"; 
	exit;
}
// clean the inputs for easy pass to db
$name = mysql_spercial_characters_clean($_POST['name']);
$org = mysql_spercial_characters_clean($_POST['org']);
$username = mysql_spercial_characters_clean($_POST['username']);
$password = mysql_spercial_characters_clean($_POST['password']);

// THE UPDATE GAN GAN
			
$querry =  "UPDATE users SET
			name = '{$name}',
			organization = '{$org}',
			username = '{$username}',
			password = '{$password}'
			WHERE username = '{$_GET['user']}'";
			
$update = mysql_query($querry, $connect);	
$updated = mysql_affected_rows();		
			
if($updated == 1){
	
	//Success
	//$message = "The CLASS was successfuly updated";
	$url_encoded_username = urlencode($username);
	echo "<script> alert ('THE USER HAS BEEN UPDATED SUCCESSFULLY.');
   		window.location = 'manage_user.php?user=$url_encoded_username';           
		</script>";
		exit;
	
	}else{
		
		//Failed
		echo "<script> alert ('UNABLE TO UPDATE USER. Probably because you did not make any change (MySql error) ');
   		window.location = 'manage_user.php';           
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
  echo  navigation_for_user_update ();
	 
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
	  if (isset($_GET['user'])){
		  
		  $users = get_user_by_username_or_password('username', $_GET['user']);
		  
	  echo "Update or Delete:  " . $users['username'] . "</br>";  
	   ?>
 
        </h2>
        <h4> <?php echo $message ?> </h4>
        <div class="page-content">
        
          <form action="manage_user.php?user=<?php echo urlencode($users['username']); ?>" method="post">
        
      <p> Full Name: &nbsp &nbsp &nbsp &nbsp;
      	<input type="text" name="name" value="<?php echo $users['name']; ?>" id="name" />
       </p>
       
       <p> Organization:  &nbsp; &nbsp;
      	<input  type="text" name="org" value="<?php echo $users['organization']; ?>" id="org" />
       </p>
      
       <p> Username: &nbsp; &nbsp &nbsp &nbsp;
      	<input type="text" name="username" value="<?php echo $users['username']; ?>" id="username" />
       </p>
       
       <p> Password: &nbsp; &nbsp; &nbsp; &nbsp &nbsp;
      	<input type="text" name="password" value="<?php echo $users['password']; ?>" id="password" />
       </p>
      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <input type="submit" name="update" value="UPDATE USER" />
     
      <br  /> <br  />
      
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
      <input type="submit" name="delete" value="DELETE USER" />
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
