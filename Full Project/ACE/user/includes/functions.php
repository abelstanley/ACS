<?php

// this file will holds all my basic functions

 function mysql_spercial_characters_clean ($value){
	 $magic_quotes_active = get_magic_quotes_gpc();
	 // check if the version of php has the function
	 $new_enough_php = function_exists ("mysql_real_escape_string");
	 if ($new_enough_php) {
		 // undo any magic quotes effects so mysql_real_escape_string
		 // can do the work
		 if ($magic_quotes_active) {
			 $value = stripslashes($value);
		 }
		 $value = mysql_real_escape_string($value);
	 } else { 
	 // if magic quotes are not on then add slashes manually
	 if (!$magic_quotes_active) {
		 $value = addslashes($value);
	 }
	 // if magic quotes are active then the slashes already exist
	 }
	 return $value;
			 
	 }
	 
 function confirm_querry ($result_set) {
	if (!$result_set){
		die("Database Querry Failed: ". mysql_error() );
	}
	}

function get_all_users(){
	global $connect;
	$querry = "select * 
	           from users" ; 
 $user_collection = mysql_query($querry, $connect);
 confirm_querry ($user_collection);
 
 return $user_collection;
	}	

 function get_all_classes(){
	global $connect;
	$querry = "select * 
	           from classes" ; 
 $classes_collection = mysql_query($querry, $connect);
 confirm_querry ($classes_collection);
 
 return $classes_collection;
	}	
		
 function get_class_details_for_classes ($class_name) {
		global $connect;
		$querry = "select *
	           from class_details 
			   where class_name = {$class_name}";
	$class_details_collection = mysql_query($querry, $connect);
 confirm_querry($class_details_collection);
 return $class_details_collection;
	}
	
 function get_class_by_id ($class_id){
	  global $connect;
	  $querry = "select * ";
	  $querry .= "from classes ";
	  $querry .= "where id = " . $class_id;
	  $querry .= " limit 1";
	  $class_collection = mysql_query ($querry, $connect);
	  confirm_querry ($class_collection);
	  if ($class = mysql_fetch_array($class_collection)){
		  return $class;
	  }else 
	  {
	  return NULL;
	  }	
  }
  
 function get_class_by_class_name ($class_name){
	  global $connect;
	  $querry = "select * 
	    		from classes 
	  			where 
				class_name = '{$class_name}' 
	  			 limit 1";
	  $class_collection = mysql_query ($querry, $connect);
	  confirm_querry ($class_collection);
	  if ($class = mysql_fetch_array($class_collection)){
		  return $class;
	  }else 
	  {
	  return NULL;
	  }	
  }
    	
 function get_class_details_by_id ($class_details_id){
	  global $connect;
	  $querry = "select * ";
	  $querry .= "from class_details ";
	  $querry .= "where id = " . $class_details_id;
	  $querry .= " limit 1";
	  $class_details_collection = mysql_query ($querry, $connect);
	  confirm_querry ($class_details_collection);
	  if ($class_details = mysql_fetch_array($class_details_collection)){
		  return $class_details;
	  }else 
	  {
	  return NULL;
	  }	
  }
 
 function get_class_details_by_class_name ($class_name){
	  global $connect;
	  $querry = "select * 
	  			from class_details 
	  			where class_name =  '{$class_name}'
	  			 limit 1";
	  $class_details_collection = mysql_query ($querry, $connect);
	  confirm_querry ($class_details_collection);
	  if ($class_details = mysql_fetch_array($class_details_collection)){
		  return $class_details;
	  }else 
	  {
	  return NULL;
	  }	
  }
   
 function find_selected_clsss_or_clsss_details () {
	  global $selected_class_details_id;
	  global $selected_class_id;
	  global $class_collection2;
	  global $class_details_collection2;
  	if (isset($_GET['class'])) {
		$selected_class_id = $_GET['class'];
		$class_collection2 = get_class_by_class_name ($selected_class_id);
		
			$selected_class_details_id = $_GET['class'];
			$class_details_collection2 = get_class_details_by_class_name ($selected_class_details_id);
			
		} else{ 
			$selected_class_details_id = NULL;
			$class_details_collection2 = NULL;
			$class_collection2 = NULL;
			$selected_class_id = NULL;
			
			}
	
  }
 
 
 function navigation ($class_collection2, $class_details_collection2){
	 global $selected_class_id;
	 global $selected_class_details_id; 
	 
	 $class_collection = get_all_classes();
	
     $output = "<ul class=\"subjects\">";

while ($class = mysql_fetch_array ($class_collection)){
	$output .= " <li";
	if ($class["id"] == $selected_class_id) {
	$output .= " class=\"selected\"";
	} 
	$output .= "> <a href = \"view_classes.php?class="
	.urlencode($class["class_name"])."\">
	 	 {$class["class_name"]} 
		 </a> <br/> <br/>
		 </li>";
	 
	
	/* after each subjects, fetch the pages under
	$output .= "<ul class=\"pages\">";
 $class_details_collection = get_class_details_for_classes ($class["class_name"]);
while ($class_details = mysql_fetch_array ($class_details_collection)){
	$output .= " <li";
	if ($class_details["id"] == $selected_class_details_id){
	$output .= " class=\"selected\"";
	}
	$output .= "> <a href = \"view_classes.php?page=".urlencode($class_details["id"])."\">
				  {$class_details["class_name"]}
				  </a> 
			     </li>";
}
	$output .= "</ul>";

*/	

}
       $output .=  "</ul>";
	   return $output;
  
 }
 
 function navigation_for_update ($class_collection2, $class_details_collection2){
	 global $selected_class_id;
	 global $selected_class_details_id; 
	 
	 $class_collection = get_all_classes();
	
     $output = "<ul class=\"subjects\">";

while ($class = mysql_fetch_array ($class_collection)){
	$output .= " <li";
	if ($class["id"] == $selected_class_id) {
	$output .= " class=\"selected\"";
	} 
	$output .= "> <a href = \"update_class.php?class="
	.urlencode($class["class_name"])."\">
	 	 {$class["class_name"]} 
		 </a> <br/> <br/>
		 </li>";
	 
	
	/* after each subjects, fetch the pages under
	$output .= "<ul class=\"pages\">";
 $class_details_collection = get_class_details_for_classes ($class["class_name"]);
while ($class_details = mysql_fetch_array ($class_details_collection)){
	$output .= " <li";
	if ($class_details["id"] == $selected_class_details_id){
	$output .= " class=\"selected\"";
	}
	$output .= "> <a href = \"view_classes.php?page=".urlencode($class_details["id"])."\">
				  {$class_details["class_name"]}
				  </a> 
			     </li>";
}
	$output .= "</ul>";

*/	

}
       $output .=  "</ul>";
	   return $output;
  
 }
 
 
 function navigation_for_delete ($class_collection2, $class_details_collection2){
	 global $selected_class_id;
	 global $selected_class_details_id; 
	 
	 $class_collection = get_all_classes();
	
     $output = "<ul class=\"subjects\">";

while ($class = mysql_fetch_array ($class_collection)){
	$output .= " <li";
	if ($class["id"] == $selected_class_id) {
	$output .= " class=\"selected\"";
	} 
	$output .= "> <a href = \"delete_class.php?class="
	.urlencode($class["class_name"])."\">
	 	 {$class["class_name"]} 
		 </a> <br/> <br/>
		 </li>";
	 
	
	/* after each subjects, fetch the pages under
	$output .= "<ul class=\"pages\">";
 $class_details_collection = get_class_details_for_classes ($class["class_name"]);
while ($class_details = mysql_fetch_array ($class_details_collection)){
	$output .= " <li";
	if ($class_details["id"] == $selected_class_details_id){
	$output .= " class=\"selected\"";
	}
	$output .= "> <a href = \"view_classes.php?page=".urlencode($class_details["id"])."\">
				  {$class_details["class_name"]}
				  </a> 
			     </li>";
}
	$output .= "</ul>";

*/	

}
       $output .=  "</ul>";
	   return $output;
  
 }
 
 function navigation_for_register($class_collection2, $class_details_collection2){
	 global $selected_class_id;
	 global $selected_class_details_id; 
	 
	 $class_collection = get_all_classes();
	
     $output = "<ul class=\"subjects\">";

while ($class = mysql_fetch_array ($class_collection)){
	$output .= " <li";
	if ($class["id"] == $selected_class_id) {
	$output .= " class=\"selected\"";
	} 
	$output .= "> <a href = \"register.php?class="
	.urlencode($class["class_name"])."\">
	 	 {$class["class_name"]} 
		 </a> <br/> <br/>
		 </li>";
	 
	
	/* after each subjects, fetch the pages under
	$output .= "<ul class=\"pages\">";
 $class_details_collection = get_class_details_for_classes ($class["class_name"]);
while ($class_details = mysql_fetch_array ($class_details_collection)){
	$output .= " <li";
	if ($class_details["id"] == $selected_class_details_id){
	$output .= " class=\"selected\"";
	}
	$output .= "> <a href = \"view_classes.php?page=".urlencode($class_details["id"])."\">
				  {$class_details["class_name"]}
				  </a> 
			     </li>";
}
	$output .= "</ul>";

*/	

}
       $output .=  "</ul>";
	   return $output;
  
 }
 
 function get_the_number_of_registered_student($classname){
	 global $connect;
	 
	 $querry = "SELECT * FROM registered_staff
	 			WHERE class_name = 
				'{$classname}'";
			$select = mysql_query($querry, $connect);
			if ($select){
				$number = mysql_num_rows($select);
			}
			return $number;
	 }
 
 
 function get_user_by_username_or_password ($input1, $input2){
	  global $connect;
	  $querry = "select * 
	    		from users 
	  			where 
				$input1 = '{$input2}' 
	  			 limit 1";
	  $user_collection = mysql_query ($querry, $connect);
	  
	  if ($user = mysql_fetch_array($user_collection)){
		  return $user;
	  }else 
	  {
	  return NULL;
	  }	
  }
  
 function navigation_for_user_update (){
	 $selected_user_id;
	 $user_collection = get_all_users();
	
     $output = "<ul class=\"subjects\">";

while ($users = mysql_fetch_array ($user_collection)){
	$output .= " <li";
	if ($class["id"] == $selected_class_id) {
	$output .= " class=\"selected\"";
	} 
	$output .= "> <a href = \"manage_user.php?user="
	.urlencode($users["username"])."\">
	 	 {$users["username"]} 
		 </a> <br/> <br/>
		 </li>";
	 
	
	/* after each subjects, fetch the pages under
	$output .= "<ul class=\"pages\">";
 $class_details_collection = get_class_details_for_classes ($class["class_name"]);
while ($class_details = mysql_fetch_array ($class_details_collection)){
	$output .= " <li";
	if ($class_details["id"] == $selected_class_details_id){
	$output .= " class=\"selected\"";
	}
	$output .= "> <a href = \"view_classes.php?page=".urlencode($class_details["id"])."\">
				  {$class_details["class_name"]}
				  </a> 
			     </li>";
}
	$output .= "</ul>";

*/	

}
       $output .=  "</ul>";
	   return $output;
  
 }
 
?>