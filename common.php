<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php 
	$con = mysql_connect("localhost:3306","root","123456");
	mysql_select_db ( "ticket", $con );
	mysql_set_charset('utf8',$con);