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

    require("../../../../Config/Users_config_adm.php");
    include('sessionSet.php');
    include('controlLogged.php');
    if($administratorPermission==0) {
        header('Location: no_permissions.php');
    }
    $message = $mess = $warning = $notizia = "";
     if(isset($_GET["message"])){
            $mess=$_GET["message"];
            
            if($mess=="warning"){
                $notizia='<div class="alert alert-danger" id="userAlert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <p>Errore</p></div>';
            }
            if($mess=="inserito"){
                $notizia='<div class="alert alert-success" id="userAlert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <p>Utente inserito</p></div>';
            }
            if($mess=="password"){
                $notizia='<div class="alert alert-success" id="userAlert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <p>Password aggiornata</p></div>';
            }
           
        }


?>

<!DOCTYPE html><html lang="it"><head><meta charset="UTF-8">

<title>Amministrazione HMR - Utenti</title>

<script src='../JS/jquery-3.2.0.min.js'></script> 
<script src='../../../Assets/Libs/Bootstrap/JS/bootstrap.js'></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="../../../Assets/Libs/DataTables/datatables.min.js"></script>
<script src='../JS/Adm_users.js'></script>

<link rel='stylesheet' href='../../../Assets/Libs/Bootstrap/CSS/bootstrap.css'>
<link rel='stylesheet' href='../../../Assets/Libs/DataTables/datatables.min.css'>



<!-- Load HMR CSS styles & fonts -->
<link rel="stylesheet" type="text/css" href="../../../HMR_Style.css">

<!-- Load Administration styles & fonts -->
<link rel="stylesheet" type="text/css" href="../CSS/Administration_Style.css">

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

<!-- Load favorite icon -->
<link rel="icon" type="image/png" href="../../../Assets/Images/HMR_2017g_GC-WebFavIcon16x16.png" />

<!-- Load HMR standard libraries -->
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
<div class="Administration_content">
    <div class="text-center">
    <button type="button" id="indietroPreview" class="btn btn-info hidden">Indietro</button>
    </div>
        <div class='jumbotron'>
        <?php echo $notizia; ?>
        <h1 id="titoloPannelloControllo">Gestione Utenti</h1>
         <table id='usersList' class='table table-striped display'  width='100%' cellspacing='0'>
        <thead>
            <tr>
                <th>Username</th>
                <th>Permessi</th>
                <th>IdPp</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Username</th>
                <th>Permessi</th>
                <th>IdPp</th>
            </tr>
        </tfoot>
        <tbody id='corpoListaUtenti'></tbody>
        </table>
    
    <h2>Legenda permessi</h2>
    <ul>
    <li><strong>A</strong>: Admin</li>
    <li><strong>WE</strong>: Web Editor</li>
    <li><strong>OE</strong>: OggiSTI Editor</li>
    <li><strong>OR</strong>: OggiSTI Reviser</li>
    </ul>

    <!-- Create a new User ------------------------------>

    <!-- Button that open the form for user creation -->
    <div class="btn-group">
        <button type='button' id='btnUserCreation' class='btn btn-primary'>Crea un nuovo utente</button>
         <button type='button' id='btnUserUpdate' class='btn btn-primary'>Modifica un utente</button>
    </div> 
    
    <!-- BEGIN User creation -->
    <div id="userManage">
      
        <!-- BEGIN Form for user creation -->
		<form id='addUser' method='post' action='../Api/updateUser.php'>
       
        <!-- Select username for change -->
        <div id='selectFormUser' class="form-group" hidden>
        <label for="usersOption">Selezionare l'utente che si vuole modificare</label>
        <select class="form-control" id="usersOption" name="selectUtente"></select>
        </div> 
        
        <!-- Username field-->
		<div id='formUser' class='form-group' hidden>
        <p>Crea un nuovo utente</p>
		<label for='username'>Username</label>
		<input type='text' name='username' class='form-control' id='username'/>
		<span id='glyphiconUsername'></span>
		<span id='helpUser' class='help-block'>Inserisci un nuovo username</span>
		</div>

		<!-- Password fiels-->
		<div id='formPassword' class='form-group' hidden>
		<label for='password'>Password</label>
		<input type='text' name='password' class='form-control' id='password'/>
		<span id='glyphiconPassword'></span>
		<span id='helpPassword' class='help-block'>Inserisci una nuova password oppure generala automaticamente</span>
		<button type='button' id='generatePassword' class='btn btn-info'>Genera</button>
        </div>
        
        <!-- Select person form people -->
        <div id="divOptionPeople" hidden>
        <label for="optionPeople">Selezionare la persona alla quale si vuole associare un account</label>
        <select class="form-control" id="optionPeople" name="selectPerson"></select>
        <p>Se la persona a cui associare l'account non è presente nel database <a href="../../../EPICAC/PHP/newAuthorForm.php">inseriscila</a></p>
        </div>

        <!-- Permission fields -->
        <!-- <input type="text" name="perms" class="form-control" id="perms" readonly value=""> -->
        <div id="permissions" hidden>
        <p>Seleziona i permessi da applicare al nuovo utente</p>
         <div class='checkbox'>
            <label><input type='checkbox' name='permissions[]' value='administratorPermission'>Amministratore</label>
        </div>
        <div class='checkbox'>
            <label><input type='checkbox' name='permissions[]' value='webEditorPermission'>Web Editor</label>
        </div>
        <div class='checkbox'>
            <label><input type='checkbox' name='permissions[]' value='editorPermission'>Redattore</label>
        </div>
        <div class='checkbox'>
            <label><input type='checkbox' name='permissions[]' value='reviserPermission'>Revisore</label>
        </div>
        </div>

        <!-- Buttons group -->
		<div id="sendButtonsGroup" class='pull-right' hidden>
        <!-- Button for create new user -->
        <button type="button" id="createUser" class="btn btn-info" data-toggle="modal" data-target="#modalInserisciUtente">Inserisci utente</button>
        <!-- Button for create new user -->
        <button type="button" id="updateUser" class="btn btn-info" data-toggle="modal" data-target="#modalUpdateUser">Modifica utente</button>
		</div>

        <!-- Modal for confirm the creation and recap password -->
        <div id="modalInserisciUtente" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Inserisci il nuovo utente</h4>
                    </div>
                    <div class="modal-body">
                        <p class="alert alert-info">Stai inserendo un nuovo utente. Se vuoi fare altre modifiche clicca su annulla.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                         <input type='submit' name='btnCreateUser' id='btnCreateUser' class='btn btn-info' value='Inserisci'>
                    </div>
                </div>
            </div>
        </div>
    </div>
   


    <!-- Modal for confirm the update and recap password -->
    <div id="modalUpdateUser" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Mudifica utente</h4>
                </div>
                <div class="modal-body">
                     <p class="alert alert-warning">Stai modificando l'utente. Per tornare indietro clicca su annulla.</p><br/>
                    <p id="passwordAdvise" class="alert alert-warning">Ricordati di scrivere la nuova password da qualche parte<br/>
                    <span id="passwordOutput"></span> </p>
                 </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                    <input type='submit' name='btnUpdateUser' id='btnUpdateUser' class='btn btn-info' value='Modifica utente'>
                </div>
            </div>
        </div>
    </div>
    </div>
        </div>
         </form>

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
