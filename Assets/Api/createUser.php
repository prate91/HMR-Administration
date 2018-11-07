<?php

// ////////////////////////////////////////////////////////////////////////
//
// Project: HMRWeb - HMR project new website
// Package:  HMRAdministration manage users
// Title: Query to insert new account
// File: createUser.php
// Path: /Assets/Api
// Type: php
// Started: 2018.11.03
// Author(s): Nicolò Pratelli
// State: in use
//
// Version history.
// - 2018.11.03 Nicolò
// First version
//
// ////////////////////////////////////////////////////////////////////////
//
// This file is part of software developed by the HMR Project
// Further information at: http://progettohmr.it
// Copyright (C) 2017 HMR Project, Nicolò Pratelli
//
// This is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published
// by the Free Software Foundation; either version 3.0 of the License,
// or (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty
// of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program; if not, see <http://www.gnu.org/licenses/>.
//
// ////////////////////////////////////////////////////////////////////////

// require("configUtenti.php");
require("../../../../Config/UsersConfig.php");

if(isset($_POST['invia'])) {

// define variables and set to empty values
$user = $password = $errore = $IdPp = "";
$permissions = array();
$ok = 1;
$administratorPermission = $webEditorPermission = $editorPermission =  $reviserPermission  = 0;
$result = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = isset($_POST["username"]) ? $_POST['username'] : '';
  $user = mysqli_real_escape_string($connUtenti, $user);
  $password = isset($_POST["password"]) ? $_POST['password'] : '';
  $password = mysqli_real_escape_string($connUtenti, $password);
  $IdPp = isset($_POST["selectPerson"]) ? $_POST['selectPerson'] : ''; 
  

  $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : array();
  if (!count($permissions)) {
      $errore = 'Errore! Devi selezionare almeno un permesso!';
      $ok = 0;
  }    
      
  foreach($permissions as $permission) {
    if($permission == "administratorPermission"){
        $administratorPermission = 1;
    }
      if($permission == "webEditorPermission"){
        $webEditorPermission = 1;
    }
    if($permission == "editorPermission"){
        $editorPermission = 1;
    }
    if($permission == "reviserPermission"){
        $reviserPermission = 1;
    }
  }
  
  
}
}

//inserting data order
$toinsert = "INSERT INTO admin (Username, Passcode, AdministratorPermission, WebEditorPermission, EditorPermission, ReviserPermission, IdPp_Id) 
VALUES ('$user',MD5('$password'),'$administratorPermission','$webEditorPermission','$editorPermission','$reviserPermission', '$IdPp')";

//declare in the order variable
if($ok ==1 ){
    $result = mysqli_query($connUtenti, $toinsert);	//order executes
}
if($result){

   $inserito="Inserimento avvenuto correttamente";
    header( "Location:../html/utenti.php?messaggio=inserito" );

}else{

	$inserito="Inserimento non eseguito";
  header( "Location:../html/utenti.php?messaggio=errore" );


}


?>
