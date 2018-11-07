<?php
	session_start();
	$autore = $_SESSION['userLogin'];
	$administratorPermission = $_SESSION['administratorPermission'];
	$webEditorPermission = $_SESSION['webEditorPermission'];
	$editorPermission = $_SESSION['editorPermission'];
	$reviserPermission = $_SESSION['reviserPermission'];



   
    if(!isset($_SESSION['userLogin'])) {
        header('Location: ../../../../amministrazione/asset/html/no_login.php?error=inv_access');
    }
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

    
	<div class="HMR_Content">
    
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button	type="button" class= "navbar-toggle" data-toggle="collapse" data-target="#nav-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="../../../amministrazione/asset/html/welcome.php"><img id="logoHMR" src="../../../oggiSTI/asset/img/HMRlogo.svg" alt="LOGO HMR"/></a>

			</div>

			<div class="collapse navbar-collapse" id="nav-toggle">
				<ul class="nav	navbar-nav">
					<li class="active"><a href="#">Home</a></li>
				</ul>

				<form class="navbar-form navbar-right" role="search">
					<a class="btn btn-primary logout" href="../../../amministrazione/asset/html/logout.php">Log Out</a>
				</form>
			</div>
		</nav>

    

		<div class="text-right iconaUser"><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $autore; ?></a></div>

		<div class="jumbotron">
			<ul id="briciole">
				<li><a href="../../../amministrazione/asset/html/welcome.php">Homepage amministrazione</a></li>	
				<li>&gt; <a href="#" class="active">Amministrazione web editor</a></li>
			</ul>

			

			<h1 id="titoloPannelloControllo">Pannello di controllo Web Editor</h1>

			<br/>

        

			<h2><small>Utente: </small><?php echo $nome_utente ." ". $cognome_utente; ?></h2>

			<h2 id="permessi"><small>permessi: </small></h2> 

				<ul id="listaPermessi" class="list-group list-inline">
					<?php if($administratorPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Amministratore </li>';} ?> 
					<?php if($webEditorPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Web Editor</li>';} ?>
					<?php if($editorPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Redattore</li>';} ?>
					<?php if($reviserPermission==1){echo '<li class="list-group-item active"><span class="glyphicon glyphicon-ok"></span> Revisore</li>';} ?>           
				</ul>

				<br class="stop"/>

        

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

		

	<div class="HMR_Footer">
	</div>

</body>

</html>