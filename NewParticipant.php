<?php

$host="kmbcodingcom.fatcowmysql.com"; // Host name 
$username="participant"; // Mysql username 
$password="experiment"; // Mysql password 
$db_name="psychology"; // Database name 
$tbl_name="participants"; // Table name 

if (isset($_POST['sex'])) {
  $sex = $_POST['sex'];
  }
else
  echo "nothing was selected.";

// username and password sent from form 
$school_ID=$_POST['school_id'];
$age=$_POST['age'];

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// To protect MySQL injection (more detail about MySQL injection)
$school_ID = stripslashes($school_ID);
$age = stripslashes($age);
$school_ID = mysql_real_escape_string($school_ID);
$age = mysql_real_escape_string($age);

//random boolean
function getRandomBoolean() {
    return .01 * rand(0, 100) >= .5;
}
$bool = getRandomBoolean();

//set 2 cookies
setcookie("participant_ID", $school_ID, time()+3600);
setcookie("isControl", $bool, time()+3600);

$insert_sql = "INSERT INTO  $tbl_name (  `id` ,  `school_id` ,  `sex` ,  `age` ,  `isControlGroup` ,  `recall_1` ,  `recall_2` ) 
VALUES (
NULL ,  '$school_ID',  '$sex',  '$age',  '$bool',  '',  '');";

$res = mysql_query($insert_sql);

if ($res){
    header('Location: Experiment.html');

} else{
   alert("Please fill out all ");
}
?>