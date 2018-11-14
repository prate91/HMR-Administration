<?php
// ////////////////////////////////////////////////////////////////////////
//
// Project: HMRWeb - HMR project new website
// Package:  HMRAdministration manage users
// Title: Functions for execute and return query executions
// File: functions.php
// Path: Administration/Assets/Api
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


 /**
  * Function that execute the query and return json encoded result
  *
  * @author Nicolò Pratelli
  *
  * @since 1.0
  *
  * @param string $query  the query to be executed
  * @param array $tableFields ontains the fields of the query

  */
function loadDataUsers($query, $tableFiels)
{
	require("../../../../Config/Users_config_adm.php");
		
	$result = array();
	$i = 0;
	$queryResult = mysqli_query($users_conn_adm, $query);
	if($queryResult != false && mysqli_num_rows($queryResult) > 0)
	{
		while($row = mysqli_fetch_assoc($queryResult))
		{
			$result[$i] = array();
			foreach($tableFiels as $field)
				$result [$i][$field] = $row[$field];
			$i++;				
		}
		
		return json_encode($result);
	}
	else
	{			
		return json_encode(array("status" => "error", "details" => "nessun risultato"));
	}
}

 /**
  * Function that execute the query and return json encoded result
  *
  * @author Nicolò Pratelli
  *
  * @since 1.0
  *
  * @param string $query  the query to be executed
  * @param array $tableFields ontains the fields of the query

  */
function loadDataEpicac($query, $tableFiels)
{
	require("../../../../Config/EPICAC_config_rd.php");
		
	$result = array();
	$i = 0;
	$queryResult = mysqli_query($EPICAC_conn_rd, $query);
	if($queryResult != false && mysqli_num_rows($queryResult) > 0)
	{
		while($row = mysqli_fetch_assoc($queryResult))
		{
			$result[$i] = array();
			foreach($tableFiels as $field)
				$result [$i][$field] = $row[$field];
			$i++;				
		}
		
		return json_encode($result);
	}
	else
	{			
		return json_encode(array("status" => "error", "details" => "nessun risultato"));
	}
}
		
?>