<?php session_start(); 
 include ("includes/header.php");
// check for by-cutters
$username = $_SESSION['username'];
		if(!$username){
			echo "<script> alert ('..OGA, GO BACK AND LOGIN!  ... YOU THINK SAY YOU SMART');
   		window.location = 'admin_login.php';           
		</script>";
		exit;
		}
?>

  <table id="structure">
    <tr>
      <td id="navigation">&nbsp;
      
      </td>
      <td id="page">
      <h2> Admin Panel </h2>
        <p> Welcome to the Admin Panel. </p>
        <br />
        <ul>
          <li> <a href="add_user.php"> <strong> Create Users </strong> </a>  </li> <br />
          <li> <a href="add_class.php"> <strong> Create Classes </strong> </a> </li> <br />
          <li> <a href="view_classes.php"> <strong> View Classes </strong> </a> </li> <br />
          <li> <a href="update_class.php"> <strong> Update Classes </strong> </a> </li> <br />
          <li> <a href="delete_class.php"> <strong> Delete Classes </strong> </a> </li> <br />
          <li> <a href="manage_user.php"> <strong> Delete/Update Users </strong> </a> </li> <br />
          <li> <a href="admin_logout.php"> <strong> Logout </strong> </a> </li>
        </ul>
        </td>
    </tr>
  </table>
<?php include ("includes/footer.php"); ?>