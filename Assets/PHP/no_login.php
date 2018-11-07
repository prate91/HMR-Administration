<?php

$errore=$_GET['error'];
switch ($errore) {
    case 'inv_access':
        $err_login = "Devi fare il login";
        break;
    case 'inv_user_password':
        $err_login = "L'username o la password sono sbagliati";
}

include("../api/configUtenti.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      $mypassword = MD5($mypassword); 
          
      $sql = "SELECT id_auth, nome, cognome, mail, amministratore, webeditor, redattore, revisore FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         $_SESSION['nome_utente'] = $row["nome"];
         $_SESSION['cognome_utente'] = $row["cognome"];
         $_SESSION['amministratore'] = $row["amministratore"];
         $_SESSION['webeditor'] = $row["webeditor"];
         $_SESSION['redattore'] = $row["redattore"];
         $_SESSION['revisore'] = $row["revisore"];
         $_SESSION['nome_completo'] = $row["nome"]." ".$row["cognome"];
         $_SESSION['data_evento'] = "";
          $_SESSION['titolo_ita'] = "";
          $_SESSION['titolo_eng']  = "";  
          $_SESSION['abstr_ita'] = "";
          $_SESSION['abstr_eng'] = "";
          $_SESSION['desc_ita'] = "";
        $_SESSION['desc_eng'] = "";
        $_SESSION['keywords'] = "";
          
          
          
         header("location: welcome.php");
      }else {
         header("location: no_login.php?error=inv_user_password");
      }
   }

?>

<!DOCTYPE html>
<html lang='it'>
<head>
<meta charset='utf-8'>
<link rel="icon" type="image/png" href="../img/HMR-Icon16x16.png" />
<link rel='stylesheet' href='../../../oggiSTI/asset/css/bootstrap.css'>
<link rel='stylesheet' href='../../../oggiSTI/asset/css/style.css'>
<link rel='stylesheet' href='../css/dcalendar.picker.css'>
<script src='../js/jquery-3.2.0.min.js'></script>
<script src='../../../oggiSTI/asset/js/bootstrap.js'></script>
<script src='../js/javascript.js'></script>
<script src='../js/dcalendar.picker.js'></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>


<title>Welcome - Oggi nella storia dell'informatica - HMR</title>
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
	
	
	
	
	
<!-- Contenuto della pagina -->
	<div class="content">
	<div class="jumbotron">
	<img id="logoAvatar" class="img-responsive" src="../img/HMRlogo.svg" alt="Logo HMR">
	<br/>
	<div class="alert alert-danger">
		<strong>Errore!</strong> <?php echo $err_login; ?>
	</div>
	 <form class="form-horizontal" action = "" method = "post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="user">Username:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name = "username" id="user" placeholder="Enter username">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-6">          
        <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </form>
      
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
     <p id="loginBtn"><a href="autenticazione.php">Autenticazione</a></p>
	</div>
</body>
</html>
