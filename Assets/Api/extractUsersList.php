<?php

include('../PHP/sessionSet.php');
require("functions.php");
	
$tableFields = array(
	'AuthId',
	'Username',
	'AdministratorPermission',
	'WebEditorPermission',  
	'EditorPermission', 
	'ReviserPermission' , 
	'IdPp_Id'
);

$query = "SELECT AuthId, Username, AdministratorPermission, WebEditorPermission,  EditorPermission, ReviserPermission, IdPp_Id FROM admin";
echo loadDataUsers($query, $tableFields);
   
	
	
?>
