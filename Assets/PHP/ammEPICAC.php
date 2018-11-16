<?php

	include('sessionSet.php');
	include('controlLogged.php');
	 
?>



<!DOCTYPE html>

<html lang='it'>
<head>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='../../../Assets/Libs/Bootstrap/CSS/bootstrap.css'>
	<link rel='stylesheet' href='../../../HMR_Style.css'>
	<link rel='stylesheet' href='../CSS/Administration_Style.css'>
	<script src='../../../Assets/Libs/jQuery/jquery-3.3.1.min.js'></script>
	<script src='../../../Assets/Libs/Bootstrap/JS/bootstrap.js'></script>
	<!-- <script src='../js/javascript.js'></script> -->
	<script type='text/javascript' src='../../../Assets/JS/HMR_CreaHTML.js'></script>
	<script src="https://www.w3schools.com/lib/w3.js"></script>
	<title>Pannello di Controllo - web editor - HMR</title>
</head>


<body>
	<div class="HMR_Banner">
		<script> creaHeader(3, 'HMR_2017g_GC-WebHeaderRite-270x105-1.png') </script>
	</div>
	
	<div id="HMR_Menu" class="HMR_Menu" >
		<script> creaMenu(3, 0) </script>
	</div>

    <?php
    include 'navbarHomeAdmin.php';
?>
	<div class="HMR_Content">
    
		<div class="jumbotron">
			
			<br class="stop" />

			<h1 id="titoloPannelloControllo">Pannello di controllo Web Editor</h1>


			<h3>Avvenimenti</h3>

			<ul class="list-group">
				<li class="list-group-item"><a href="../../../EPICAC/PHP/formHappeningss.php">Nuovo avvenimento</a></li>
				<li class="list-group-item"><a href="../../../EPICAC/PHP/showListInRevision.php">Avvenimenti in revisione</a></li>
				<li class="list-group-item"><a href="../../../EPICAC/PHP/showListPublished.php">Avvenimenti pubblicati</a></li>
				<li class="list-group-item"><a href="../../../EPICAC/PHP/showListInEditing.php">Avvenimenti in redazione</a></li>
				<li class="list-group-item"><a href="../../../EPICAC/PHP/newAuthorForm.php">Aggiungi autore</a></li>
			</ul>

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