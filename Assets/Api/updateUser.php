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

require("../../../../Config/Users_config_adm.php");
require_once('../PHP/managePermission.php');



/**
 * Define variables and set to empty values
 */ 
$user = $password = $warning = $IdPp = "";
$permissions = array();

/**
 * Set $ok that control if is setted at least one permission
 */
$ok = 1;

/**
 * Unset permissions variables
 */
$perm = 0;



/**
 * Initialized result to false
 */
$result = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /**
     * Taken the values of username, password, IdPp and permissions
     * Escaped text string (user and password)
     */
    $password = isset($_POST["password"]) ? $_POST['password'] : '';
    $password = mysqli_real_escape_string($users_conn_adm, $password);
    $IdPp = isset($_POST["selectPerson"]) ? $_POST['selectPerson'] : ''; 
    //$perms = isset($_POST["perms"]) ? $_POST['perms'] : ''; 
    $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : array();
    /**
    * Create class permission
    */
    $permissionClass = new Permission(intval(0));

    if (!count($permissions)) {
        $warning = 'Errore! Devi selezionare almeno un permesso!';
        $ok = 0;
    }    
    foreach($permissions as $permission) {
        if($permission == "administratorPermission"){
            $permissionClass->grantAdmin();
        }
        if($permission == "webEditorPermission"){
            $permissionClass->grantWebEditor();
        }
        if($permission == "editorPermission"){
            $permissionClass->grantOggiSTIEditor();
        }
        if($permission == "reviserPermission"){
            $permissionClass->grantOggiSTIReviser();
        }
    }
  
  
}


/**
 * The btnCreateUser button is pressed
 */
if(isset($_POST['btnCreateUser'])) {

    $user = isset($_POST["username"]) ? $_POST['username'] : '';
    $user = mysqli_real_escape_string($users_conn_adm, $user);
    $perm = $permissionClass->getPermissions();
    /**
     * Query of insertion of user data into table admin
     */
    $toinsert = "INSERT INTO admin (Username, Passcode, Permissions, IdPp_Id) 
    VALUES ('$user',MD5('$password'),'$perm', '$IdPp')";

    /**
     * Control value of $ok, i.e. control if at least one permission is setted
     * Execute the query
     */
    if($ok ==1 ){
        $result = mysqli_query($users_conn_adm, $toinsert);	//order executes
    }

    /**
     * Redirection
     */
    if($result){
        $inserito="Inserimento avvenuto correttamente";
        header( "Location:../PHP/users.php?messaggio=inserito" );
    }else{
        $inserito="Inserimento non eseguito";
        header( "Location:../PHP/users.php?messaggio=warning" );
    }
}

/**
 * The btnUpdateUser buttonis pressed
 */
if(isset($_POST['btnUpdateUser'])) {
    
    $user = isset($_POST["selectUtente"]) ? $_POST['selectUtente'] : '';
    $perm = $permissionClass->getPermissions();

    if($password!=""){
        $toinsertPw = "UPDATE admin SET Passcode = MD5('$password') WHERE Username = '$user'";
        $resultPw = mysqli_query($users_conn_adm, $toinsertPw);
    }
    /**
     * Query of update of user data into table admin
     */
    $toinsert = "UPDATE admin SET Permissions =  '$perm' WHERE Username = '$user'";

    /**
     * Control value of $ok, i.e. control if at least one permission is setted
     * Execute the query
     */
    if($ok == 1 ){
        $result = mysqli_query($users_conn_adm, $toinsert);	//order executes
    }
    /** 
     * Redirection
     */
    if($result){
        $inserito="Inserimento avvenuto correttamente";
        header( "Location:../PHP/users.php?messaggio=password" );
    }else{
        $inserito="Inserimento non eseguito";
        header( "Location:../PHP/users.php?messaggio=errore" );
    }
}

?>
