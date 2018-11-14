<?php

include('../PHP/sessionSet.php');
require("functions.php");
	
$tableFields = array(
	'Permissions'
);
if(isset($_GET['username']))
{
    $username = $_GET['username'];
    $query = "SELECT Permissions FROM admin WHERE Username='$username'";
    echo loadDataUsers($query, $tableFields);
} 
else
{
    echo json_encode(array("status" => "error", "details" => "parametro mancante"));
}

?>
