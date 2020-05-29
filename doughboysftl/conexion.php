<?php
header("Content-Type: text/html;charset=utf-8");
/*------------------------------------------------------------------------*/
//  $db = mysql_connect("db176.perfora.net", "dbo120861878", "Z2VJr7zt");
//  mysql_select_db( "db120861878", $db );

//"myhost", "myuser", "mypassw", "mybd"
if (strtolower($_SERVER['SERVER_NAME']) == "localusa") {
	$link = mysqli_connect("localhost", "root", "", "dough") or die("Error " . mysqli_error($link));
} else {
	//$link = mysqli_connect("db693758058.db.1and1.com", "dbo693758058", "Dough.Boys.88", "db693758058") or die("Error " . mysqli_error($link));
	$link = mysqli_connect("17stcausewaycom.fatcowmysql.com", "u_doughboys_2019", "d_ough_b_oys88", "dough_boys_2019") or die("Error " . mysqli_error($link));
}

mysqli_set_charset($link, "utf8");

?>
