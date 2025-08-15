<?php session_start(); 
require_once("includes/connection.php"); ?>  
<?php require_once("includes/functions.php"); ?>

<?php
// check for by-cutters
$username = $_SESSION['username'];
		if(!$username){
			echo "<script> alert ('..OGA, GO BACK AND LOGIN!  ... YOU THINK SAY YOU SMART');
   		window.location = 'user_login.php';           
		</script>";
		exit;
			}
?>

<?php include ("includes/header.php"); ?>
  <table height="394" id="structure">
    <tr>
      <td id="">
        </td>
      <td id="page"><h2>
 
        </h2>
        <div class="page-content">
        
        <h2 align="center"> REGISTERED CLASES </h2>
        
          <table width="950" height="149" border="1" cellpadding="3" align="center">
            <tr>
              <td width="230"><strong> Class Name </strong></td>
              <td width="203"><strong> Date </strong></td>
              <td width="223"> <strong> Period </strong></td>
              <td width="250"><strong> Venue </strong></td>
            </tr>
            <tr>
            <?php
			
			$querry = "SELECT * FROM registered_staff
			WHERE username = '$username'";
			
			$select = mysql_query($querry, $connect);
		
			while($rows = mysql_fetch_array ($select)){
			$quer = "SELECT * FROM class_details
					 WHERE 
					 class_name = '{$rows['class_name']}'";	
					 
			$selle = mysql_query($quer, $connect);
				
			while ($ro = mysql_fetch_array($selle)){	
			
			
			
			?>
              <td> <?php echo $ro['class_name']; ?> </td>
              <td>  <?php echo $ro['date']; ?> </td>
              <td>  <?php echo $ro['period']; ?> </td>
              <td>  <?php echo $ro['venue']; ?> </td>
            </tr>
            <?php
					}
				}
			?>	
          </table>
          <br />
          <p align="center">
           <script> function printFunction() {
			window.print();
			}
			</script>
          <input type="button" name="print" value="PRINT" onclick="printFunction()" />  &nbsp; &nbsp;
          <a href="register.php"> XX CANCEL </a>
          </p>
          
        </div>
       </td>
    </tr>	
  </table>
  <?php require ("includes/footer.php"); ?>
