// ////////////////////////////////////////////////////////////////////////
//
// Project: HMR - Adminisstration
// Package:  Administration javascript
// Title: script for control users administration
// File: Adm_users.js
// Path: Administration/Assets/JS/
// Type: javascript
// Started: 2017-03-08
// Author(s): Nicolò Pratelli
// State: in use
//
// Version history.
// - 2017.03.08 Nicolò Pratelli
// First version
// - 2017.12.05 Nicolò Pratelli
// Added the file and copyright information
// - 2018.02.26 Nicolò Pratelli
// Added random passwords generator
// - 2018.06.06 Nicolò Pratelli
// Removed users deletion
// - 2018.10.25 Nicolò
// Added IdPp for the control of people on EPICAC
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
 * Random passwords generator
 */
function casualPassword() {
    var characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    var minCharacters = 6;
    var maxCharacters = 10;
    var diffCharacters = maxCharacters - minCharacters;

    var length = Math.round((Math.random() * diffCharacters) + minCharacters);

    var increase = 0;
    var password = "";

    while (increase < length) {
        password += characterList.charAt(Math.round(Math.random() * characterList.length));
        increase++;
    }
    return password;
}




$(document).ready(function () {
    /** 
     * Declaration and initialization of variables
     */
    var usersList;
    var url = "../Api/extractUsersList.php";
    var usersTableHeader = "";
    var peopleList;
    var urlPeople = "../Api/extractPeople.php";

    /**
    * AJAX call for extraction and costruction of users table
    * and username list
    */
    $.getJSON(url, function (result) {
        $.each(result, function (index, item) {
            // Row construction for table
            var row = "<tr><td>" + item.Username + "</td>" +
                "<td>" + item.AdministratorPermission + "</td>" +
                "<td>" + item.WebEditorPermission + "</td>" +
                "<td>" + item.EditorPermission + "</td>" +
                "<td>" + item.ReviserPermission + "</td>" +
                "<td>" + item.IdPp_Id + "</td>";
            usersTableHeader += row;
            $("#corpoListaUtenti").html(usersTableHeader);
            // Users list construction for users updating
            usersList += "<option value='" + item.Username + "'>" + item.Username + "</option>";
        });
        $('#usersList').DataTable();
        $("#usersOprion").html(usersList);
    });

    /**
    * AJAX call for extraction and costruction of people list
    */
    $.getJSON(urlPeople, function (result) {
        $.each(result, function (index, item) {
            peopleList += "<option value='" + item.IdPp + "'>" + item.Name + " " + item.Surname + "</option>";
        });
        $("#optionPeople").html(peopleList);
    });

    /**
     * On click event that generate random password
     */
    $("#generatePassword").click(function () {
        var password = casualPassword();
        $("#password").val(password);
    });

    /**
     * On click event that write password for modal update
     * This allow the user to appoint it
     */
    $("#updateUser").click(function () {
        var pw = $('[name="password"]').val();
        $("#passwordOutput").html(pw);
    });

    /**
     * On click event that show User cration form
     */
    $("#btnUserCreation").click(function () {
        $("#userCreation").show();
    });

    /**
     * On click event that hide User cration form
     */
    $("#closeUserCreation").click(function () {
        $("#userCreation").hide();
    });

    /**
     * On click event that show User update form
     */
    $("#btnUserUpdate").click(function () {
        $("#userUpdate").show();
    });

    /**
     * On click event that hide User update form
     */
    $("#closeUserUpdate").click(function () {
        $("#userUpdate").hide();
    });


    /**
     * Manage auto hiding of alerts that advise the users if
     * creation or update were successful
     */
    $("#userAlert").alert();
    $("#userAlert").fadeTo(2000, 500).slideUp(500, function () {
        $("#userAlert").slideUp(500);
    });

});
