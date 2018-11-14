<?php

include('../PHP/sessionSet.php');
require("functions.php");
	
$tableFields = array(
	'AuthId',
	'Username',
	'Permissions',
	'IdPp_Id'
);

$query = "SELECT AuthId, Username, Permissions, IdPp_Id FROM admin ORDER BY Username";
echo loadDataUsers($query, $tableFields);
   
	
	
?>
