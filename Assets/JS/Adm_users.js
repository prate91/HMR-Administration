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
 * Check Permissions
 */
/**
 * Bitmasks as decimal values
 * HMR permissions
 * 1 =      00000000 00000001 HMR Admin
 * 2 =      00000000 00000010 HMR Web editor
 * 4 =      00000000 00000100
 * 8 =      00000000 00001000
 * 16 =     00000000 00010000
 * 32 =     00000000 00100000
 * 64 =     00000000 01000000
 * 128 =    00000000 10000000
 * OggiSTI permissions
 * 256 =    00000001 00000000 OggiSTI editor
 * 512 =    00000010 00000000 OggiSTI reviser
 * 1024 =   00000100 00000000
 * 2048 =   00001000 00000000
 * 4096 =   00010000 00000000
 * 8192 =   00100000 00000000
 * 16384 =  01000000 00000000
 * 32768 =  10000000 00000000
 */
const ADMIN = 1;
const WEBEDITOR = 2;
const OGGISTIEDITOR = 256;
const OGGISTIREVISER = 512;

/**
 * Check if is admin
 * 
 * @param {int} permission 
 */
function checkAdmin(permission) {
    if ((permission & ADMIN) == ADMIN) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check if is WebEditor
 * 
 * @param {int} permission 
 */
function checkWebEditor(permission) {
    if ((permission & WEBEDITOR) == WEBEDITOR) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check if is OggiSTI editor
 * 
 * @param {int} permission 
 */
function checkOggiSTIEditor(permission) {
    if ((permission & OGGISTIEDITOR) == OGGISTIEDITOR) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check if is OggiSTI Reviser
 * 
 * @param {int} permission 
 */
function checkOggiSTIReviser(permission) {
    if ((permission & OGGISTIREVISER) == OGGISTIREVISER) {
        return true;
    } else {
        return false;
    }
}


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
    var urlUsers = "../Api/extractUsersList.php";
    var usersTableHeader = "";
    var peopleList;
    var urlPeople = "../Api/extractPeople.php";
    var urlPermission = "../Api/getPermissions.php";

    /**
    * AJAX call for extraction and costruction of users table
    * and username list
    */
    $.getJSON(urlUsers, function (result) {
        $.each(result, function (index, item) {
            var perms = item.Permissions;
            //$("#perms").val(perms);
            var textPerms = "";
            if (checkAdmin(perms)) {
                textPerms += "<strong>A</strong>/";
            }
            if (checkWebEditor(perms)) {
                textPerms += "<strong>WE</strong>/";
            }
            if (checkOggiSTIEditor(perms)) {
                textPerms += "<strong>OE</strong>/";
            }
            if (checkOggiSTIReviser(perms)) {
                textPerms += "<strong>OR</strong>/";
            }

            // Row construction for table
            var row = "<tr><td>" + item.Username + "</td>" +
                "<td>" + textPerms + "</td>" +
                "<td>" + item.IdPp_Id + "</td>";
            usersTableHeader += row;
            $("#corpoListaUtenti").html(usersTableHeader);
            // Users list construction for users updating
            usersList += "<option value='" + item.Username + "'>" + item.Username + "</option>";
        });
        $('#usersList').DataTable();
        $("#usersOption").html(usersList);
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
    * On change event that set permits
    */
    $('#usersOption').on('change', function () {
        var username = this.value;
        $.getJSON(urlPermission, { "username": username }, function (result) {
            $.each(result, function (index, item) {
                // Row construction for table
                var perms = item.Permissions;
                //$("#perms").val(perms);
                $("input[value='administratorPermission']").prop({
                    checked: checkAdmin(perms)
                });
                $("input[value='webEditorPermission']").prop({
                    checked: checkWebEditor(perms)
                });
                $("input[value='editorPermission']").prop({
                    checked: checkOggiSTIEditor(perms)
                });
                $("input[value='reviserPermission']").prop({
                    checked: checkOggiSTIReviser(perms)
                });

            });

        });
        //$("#perms").html("ciao");
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
     * On click event that show User creation form
     */
    $("#btnUserCreation").click(function () {
        $("#formUser").show();
        $("#selectFormUser").hide();
        $("#formPassword").show();
        $("#divOptionPeople").show();
        $("#permissions").show();
        $("#createUser").show();
        $("#updateUser").hide();
        $("#sendButtonsGroup").show();


    });


    /**
     * On click event that show User update form
     */
    $("#btnUserUpdate").click(function () {
        $("#formUser").hide();
        $("#selectFormUser").show();
        $("#formPassword").show();
        $("#divOptionPeople").hide();
        $("#permissions").show();
        $("#createUser").hide();
        $("#updateUser").show();
        $("#sendButtonsGroup").show();

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
