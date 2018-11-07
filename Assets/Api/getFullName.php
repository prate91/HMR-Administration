<?php
// ////////////////////////////////////////////////////////////////////////
//
// Project: name of HMR subproject and brief description
// Package:  package name and brief description
// Title: title of the file, descriptive of file contents
// File: file name
// Path: path in the source code repository of the package
// Type: type of file
// Started: date of creation
// Author(s): first or main author(s)
// State: current state of use
//
// Version history.
// - YYYY.MM.DD Author or the revision
// Brief description of the changes
// - ...
// - YYYY.MM.DD Author or the revision
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

/**
 * Created by PhpStorm.
 * User: nico
 * Date: 11/12/17
 * Time: 14.54
 */

include('../PHP/session.php');
require("funzioniUtenti.php");
$autore = $_SESSION['login_user'];

//header('Content-Type : application/json');

$campi_tabella = array(
    'nome',
    'cognome',
);

if(isset($_GET['username']))
{
    $username = $_GET['username'];
    $query = "SELECT nome, cognome FROM admin WHERE username='$username'";
    echo carica_dati($query, $campi_tabella);
}
else
{
    echo json_encode(array("status" => "error", "details" => "parametro mancante"));
}



