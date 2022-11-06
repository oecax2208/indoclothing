<?php 
function anti_sql_injection($string){
	$res = strip_tags($string);
	$res = stripslashes($res);
	$res = mysql_real_escape_string($res);
	return($res);	

}
?>