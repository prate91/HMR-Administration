<?php
    include('../PHP/sessionSet.php');
	require("functions.php");
	
	$campi_tabella = array(
        'AuthId',
		'Username',
		'nome',
		'cognome',
		'mail',
		'AdministratorPermission',
		'WebEditorPermission',  
		'EditorPermission', 
		'ReviserPermission' , 
		'IdPp_Id'
	);
	
		$query = "SELECT AuthId, Username, nome, cognome, mail, AdministratorPermission, WebEditorPermission,  EditorPermission, ReviserPermission , IdPp_Id FROM admin";
		echo carica_dati($query, $campi_tabella);
   
	
	
?>
