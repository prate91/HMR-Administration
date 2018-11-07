<?php
// /////////////////////////////////////////////////////////////////////////////
//
// Project:   HMR
// Package:   Login Administration
// Title:     Welcome - HMR
// File:      welcome.php
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

   include('session.php');
   $editor = $_SESSION['userLogin'];
   $name = $_SESSION['name'];
   $surname = $_SESSION['surname'];
   $briefName = $_SESSION['briefName'];
   $completeName = $_SESSION['completeName'];
   $administratorPermission = $_SESSION['administratorPermission'];
   $webEditorPermission = $_SESSION['webEditorPermission'];
   $editorPermission = $_SESSION['editorPermission'];
   $reviserPermission = $_SESSION['reviserPermission'];
?>

<!DOCTYPE html><html lang="it"><head><meta charset="UTF-8">

<title>Amministrazione HMR - <?php echo $autore; ?></title>


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
<div class="HMR_Content">    
<div class="jumbotron">
<ul id="permissionsList" class="list-group list-inline">
  <?php if($administratorPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Amministratore </li>';} ?> 
    <?php if($webEditorPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Web Editor</li>';} ?>
    <?php if($editorPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Redattore</li>';} ?>
    <?php if($reviserPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Revisore</li>';} ?>           
</ul>
<span class="text-right iconaUser">
    <span class="glyphicon glyphicon-user"></span> <?php echo $completeName; ?>
   </span>
    <br class="stop"/>
     
    <h1 id="titoloPannelloControllo">Pannello di controllo</h1>
	<br/>
        
        
        
        
        
        <ul class="list-group">
        <?php if(( $webEditorPermission==1)||($administratorPermission==1)){
        echo '<a class="bottoneCP" href="ammEPICAC.php"><li class="list-group-item quadrettone"><img id="logoAvatar" class="img-responsive" src="../../../OggiSTI/Assets/Img/HMRlogo.svg" alt="Logo HMR">
        Pannello di controllo sito web</li></a>';
        } ?>
    
        
        <?php if(( $reviserPermission==1)||($administratorPermission==1)||($editorPermission==1)){
            echo "<a class='bottoneCP' href='../../../OggiSTI/Assets/PHP/OggiSTI_index_administration.php'><li class='list-group-item quadrettone'><img id='logoAvatar' class='img-responsive' src='../../../OggiSTI/Assets/Img/logo.png' alt='Logo oggiSTI'>
            Pannello di controllo oggi nella storia dell'informatica</li></a>";
             
        } ?>
        
        
        <?php if($administratorPermission==1){
        echo "<a class='bottoneCP' href='../../../OggiSTI/Assets/HTML/ammBot.php'><li class='list-group-item quadrettone'><img id='logoAvatar' class='img-responsive' src='../../../OggiSTI/Assets/Img/logoAlan.png' alt='Logo User'>Pannello di controllo Bot</li></a>";
        }?>
            
              <?php if($administratorPermission==1){
        echo "<a class='bottoneCP' href='users.php'><li class='list-group-item quadrettone'><img id='logoAvatar' class='img-responsive' src='../../../OggiSTI/Assets/Img/userLogo.png' alt='Logo User'>Gestione Utenti</li></a>";
        }?>  
            </ul>
        <br class='stop'/>
      
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
