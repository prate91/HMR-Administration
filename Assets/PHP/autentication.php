<?php
// /////////////////////////////////////////////////////////////////////////////
//
// Project:   HMR
// Package:   Login Administration
// Title:     Autenticazione - HMR
// File:      autentication.php
// Path:      /Administration/
// Type:      php
// Started:   2017.03.08
// Author(s): Nicolò Pratelli, Emanuele Lenzi
// State:     working
//
// Version history.
// - 2017.03.08  Nicolò
//   First version
// - 2018.03.14  Nicolò
//   Changed page name
// - 2018.03.16  Nicolò
//   Changed page structure
//
// ////////////////////////////////////////////////////////////////////////////
//
// This file is part of software developed by the HMR Project
// Further information at: http://progettohmr.it
// Copyright (C) 2017-2018 HMR Project G.A. Cignoni
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
// ///////////////////////////////////////////////////////////////////////////


//include("../Api/configUtenti.php");
require("../../../../Config/UsersConfig.php");
session_start();
if(isset($_SESSION['userLogin'])) {
    header('Location: welcome.php');
}
   
if($_SERVER["REQUEST_METHOD"] == "POST") {
// username and password sent from form 
  $myusername = mysqli_real_escape_string($connUtenti,$_POST['username']);
  $mypassword = mysqli_real_escape_string($connUtenti,$_POST['password']); 
  $mypassword = MD5($mypassword); 
  $sql = "SELECT AuthId, AdministratorPermission, WebEditorPermission, EditorPermission, ReviserPermission, IdPp_Id FROM admin WHERE Username = '$myusername' and Passcode = '$mypassword'";
  $result = mysqli_query($connUtenti,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $active = $row['active'];
  $count = mysqli_num_rows($result);
  // If result matched $myusername and $mypassword, table row must be 1 row
  if($count == 1) {
    //session_register("myusername");
    $_SESSION['userLogin'] = $myusername;
    $_SESSION['authId'] = $row["AuthId"];
    $_SESSION['administratorPermission'] = $row["AdministratorPermission"];
    $_SESSION['webEditorPermission'] = $row["WebEditorPermission"];
    $_SESSION['editorPermission'] = $row["EditorPermission"];
    $_SESSION['reviserPermission'] = $row["ReviserPermission"];
    $_SESSION['idPp_Id'] = $row["IdPp_Id"];
    $_SESSION['nome_completo'] = $row["nome"]." ".$row["cognome"];
    $_SESSION['eventDate'] = "";
    $_SESSION['itaTitle'] = "";
    $_SESSION['engTitle']  = "";  
    $_SESSION['itaAbstract'] = "";
    $_SESSION['engAbstract'] = "";
    $_SESSION['itaDescription'] = "";
    $_SESSION['engDescription'] = "";
    $_SESSION['keywords'] = "";
    include '../Api/extractPersonInformation.php';
    header("location: welcome.php");
  }else {
    header("location: no_login.php?error=inv_user_password");
  }
}
?>

<!DOCTYPE html><html lang="it"><head><meta charset="UTF-8">

<title>Autenticazione - HMR</title>



<link rel='stylesheet' href='../../../Assets/Libs/Bootstrap/CSS/bootstrap.css'>
<script src='../../../Assets/Libs/Bootstrap/JS/bootstrap.js'></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>


<!-- Load HMR CSS styles & fonts -->
<link rel="stylesheet" type="text/css" href="../../../HMR_Style.css">

<!-- Load Administration styles & fonts -->
<link rel="stylesheet" type="text/css" href="../CSS/Administration_Style.css">

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

<!-- Load favorite icon -->
<link rel="icon" type="image/png" href="../../../Assets/Images/HMR_2017g_GC-WebFavIcon16x16.png" />

<!-- Load HMR standard libraries -->
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 
<script type='text/javascript' src='../../../EPICAC/JSwebsite/searchAndSharing.js'></script>
<script type='text/javascript' src='../../../Assets/JS/HMR_CreaHTML.js'></script>


</head>
<body>

<!-- Standard HMRWeb header ///////////////////////////////////////////////////
// For banner:
// - set level, 1 = "../", 2 = "../../" and so on;
// - set image, file name and extension, no path, has to be in /Assets/Images.
// For menu:
// - set level, same as banner;
// - set active menu entry, 1=Cronologia, 2=Eventi and so on.  -->
<div class="HMR_Banner">
  <script> creaHeader(3, 'HMR_2017g_GC-WebHeaderRite-270x105-3.png') </script>
</div>

<div id="HMR_Menu" class="HMR_Menu" >
    <script> creaMenu(3, 0) </script>
</div>
  
<span class="stop"></span>
  
<!-- Content -->
<div class="HMR_Content">

  <div id="headerLogin">
<h1><span class="glyphicon glyphicon-lock"></span> Login</h1>
</div>
<div class="jumbotron">
  <form class="form-horizontal" action = "" method = "post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="user">Username:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name = "username" id="user" placeholder="Enter username">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-6">          
        <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </form>
</div>
    
    </div>

<!-- Standard HMRWeb footer////////////////////////////////////////////////////
// Set:
// - level, 1 = "../", 2 = "../../" and so on;
// - set copyright start year, YYYY
// - set copyright end year, YYYY;
// - set copyright owner, default "Progetto HMR";
// - set date of page creation, YYYY/MM/DD.  -->

<div class="HMR_Footer">    
    <script> creaFooter(3, '2017', '2018', 'Nicolò Pratelli - G.A.Cignoni', '07/13/2017') </script>
</div>
    
</body>
</html>
