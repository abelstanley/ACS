<?php session_start();
 require_once("includes/connection.php"); ?>
<?php	
 if(isset($_POST['login'])){
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 $querry = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
	 $select = mysql_query($querry, $connect);
	 if(mysql_num_rows($select) == 1){
		 //sucess
		while ($fetch = mysql_fetch_array($select)){
			
		$_SESSION['username'] = $fetch['username'];	
		header ("Location: admin_home.php");
		}
	 }else{
		 //falied 
		 echo "<script> alert ('...INCORRECT USERNAME OR PASSWORD..');
		 window.location = 'admin_login.php' </script>";
	 }
	 
	 }
		
	
?>
<?php include ("includes/header.php"); ?>
  <table id="structure">
    <tr>
      <td id="navigation">
        </td>
      <td id="page"><h2>
          
        <h2>ADMIN LOGIN </h2>
        <form action="" method="post">
        
        <p> User Name: &nbsp; <input type="text" name="username" value="" placeholder="Username" /> <br /> <br />
         Password: &nbsp; &nbsp; <input type="password" name="password" value="" placeholder="password" /> </p>
          <p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          <input type="submit" name="login" value="LOGIN" />
        
        </form>
        </td>
    </tr>
  </table>
  <?php require ("includes/footer.php"); ?>
