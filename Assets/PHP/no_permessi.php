<?php
    include("../api/configUtenti.php");
    session_start();
    if(!isset($_SESSION['login_user'])) {
        header('Location: no_login.php?error=inv_access');
    }
    $autore = $_SESSION['login_user'];
    $amministratore = $_SESSION['amministratore'];
    $redattore = $_SESSION['redattore'];
    $revisore = $_SESSION['revisore'];

      


?>

<!DOCTYPE html>
<html lang='it'>
<head>
<meta charset='utf-8'>
<link rel="icon" type="image/png" href="../img/HMR-Icon16x16.png" />
<link rel='stylesheet' href='../css/bootstrap.css'>
<link rel='stylesheet' href='../../../oggiSTI/asset/css/style.css'>
<script src='../js/jquery-3.2.0.min.js'></script>
<script src='../js/bootstrap.js'></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
    



<title>Oggi nella storia dell'informatica - HMR</title>
</head>
<body>
<!-- header -->
	<div class="banner">
	<table>
	<tr>
	<td>
	<a href="#"> <img src='../img/HMRlogo.svg' alt='Logo HMR'> </a>
	</td>
	<td>
	<a href="#"><h1>Hackerando la Macchina Ridotta</h1></a> <b>storia e archeologia sperimentale dell'informatica</b>
	</td>
	</tr>
	</table>
	</div>
	<div class="menuNavigazione">
		<?PHP
		include('menuNavigazione.php');
		?>
	</div>
	<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button	type="button" class= "navbar-toggle" data-toggle="collapse" data-target="#nav-toggle">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#"><img id="logoHMR" src="../img/HMRlogo.svg" alt="LOGO HMR"/></a>
	</div>
	<div class="collapse navbar-collapse" id="nav-toggle">
	<ul class="nav	navbar-nav">
		<li><a href="welcome.php">Home</a></li>
		<li><a href="listaEventi.php">Lista Eventi</a></li>
        <li><a href="listaEventiSalvati.php">Lista Eventi Salvati</a></li>
		<li><a href="add.php">Aggiungi evento</a></li>
	</ul>
	<form class="navbar-form navbar-right" role="search">
		<a class="btn btn-primary" href="logout.php">Log Out</a>
		</form>
	</div>
	</nav>
    <div class="text-right iconaUser"><a href="welcome.php"><span class="glyphicon glyphicon-user"></span> <?php echo $autore; ?></a></div>
    
    <div class='container'>
        <div class='jumbotron'>
        <p>Non hai i permessi per accedere a questa pagina</p>
        <a href='javascript:history.back()'>torna indietro</a>    
		</div>
</div>
   <div class="footer">
	<table>
		<tr>
		<td>
		<img src='../img/by-nc-nd.eu.png' alt='CC by nc nd'>
		</td>
		<td>
		<cite>Copyright © 2009-2016 Giovanni A. Cignoni<br/>
		Pagina creata: 03/08/2017; 
        <script type="text/javascript">

  lastmod = document.lastModified
  lastmoddate = Date.parse(lastmod)
  if (lastmoddate != 0) {
    document.writeln("ultima modifica: " + lastmod)
  }

</script></cite>
		</td>
		</tr>
	</table>
	</div>
</body>
</html>
