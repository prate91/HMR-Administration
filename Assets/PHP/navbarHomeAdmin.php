<?php
// /////////////////////////////////////////////////////////////////////////////
//
// Project:   HMR
// Package:   Login Administration
// Title:     Welcome - HMR
// File:      navbarHomeAdmin.php
// Path:      /Administration/
// Type:      php
// Started:   2017.03.08
// Author(s): Nicolò Pratelli, Emanuele Lenzi
// State:     working
//
// Version history.
// - 2018.11.16  Nicolò
//   First version
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
?>

<div id="navbarHomeAdmin">
    <div class="text-right iconaUser">
       <!-- <ul id="permissionsList" class="list-group list-inline">
            
            <?php //if($administratorPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Admin </li>';} ?> 
    <?php //if($webEditorPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Web Editor</li>';} ?>
    <?php //if($editorPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> OggiSTI Editor</li>';} ?>
    <?php //if($reviserPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> OggiSTI Reviser</li>';} ?>           
    </ul> -->
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user"></span> <?php echo $completeName; ?> <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Homepage admin</a></li>
                <!-- Next implementation -->
                <!-- <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Impostazioni</a></li> -->
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
            </ul>
        </div>
    </div>
   </div>
   </div>
