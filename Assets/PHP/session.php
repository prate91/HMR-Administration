<?php

   // ////////////////////////////////////////////////////////////////////////
//
// Project: HMR
// Package: Amministrazione
// Title: session
// File: session.php
// Path: amministrazione/asset/html
// Type: php
// Started: 2017-03-08
// Author(s): Nicolò Pratelli
// State: in use
//
// Version history.
// - 2018.03.03 Nicolò
// Added session time
// - 2017.03.08 Nicolò
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

session_start();

$user_check = $_SESSION['userLogin'];

$ses_sql = mysqli_query($users_conn_adm,"SELECT Username FROM admin WHERE Username = '$user_check' ");

$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session = $row['Username'];

if(!isset($_SESSION['userLogin'])){
header("location:autentication.php");
}
?>
