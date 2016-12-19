<?php

$host="kmbcodingcom.fatcowmysql.com"; // Host name 
$username="participant"; // Mysql username 
$password="experiment"; // Mysql password 
$db_name="psychology"; // Database name 
$tbl_name="participants"; // Table name
$row_name = "recall_1";

if (isset($_POST['recall_Info'])) {
	$recall_Info = $_POST['recall_Info'];
}
else {
	echo "nothing was recalled.";
}

// To protect MySQL injection (more detail about MySQL injection)
$recall_Info = stripslashes($recall_Info);
$recall_Info = mysqli_real_escape_string($recall_Info);

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$bool = $_COOKIE["isControl"];
$current = $_COOKIE["participant_ID"];

$update_sql = "UPDATE  `participants` SET  `recall_1` =  '$recall_Info'  '' WHERE  `school_id` ='$current' LIMIT 1;";

$res = mysql_query($update_sql);

if ($res){
	if ($bool == 0){
		header('Location: Experiment2.html');
	} else{
		header('Location: Control.html');
	}
} else{
   echo "failed";
}







?>



