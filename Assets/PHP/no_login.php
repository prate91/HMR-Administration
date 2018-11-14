<?php

$errore=$_GET['error'];
switch ($errore) {
    case 'inv_access':
        $err_login = "Devi fare il login";
        break;
    case 'inv_user_password':
        $err_login = "L'username o la password sono sbagliati";
}

require("../../../../Config/Users_config_adm.php");
require_once('managePermission.php');
   session_start();
   
   
  if($_SERVER["REQUEST_METHOD"] == "POST") {
// username and password sent from form 
  $myusername = mysqli_real_escape_string($users_conn_adm,$_POST['username']);
  $mypassword = mysqli_real_escape_string($users_conn_adm,$_POST['password']); 
  $mypassword = MD5($mypassword); 
  $sql = "SELECT AuthId, Permissions, AdministratorPermission, WebEditorPermission, EditorPermission, ReviserPermission, IdPp_Id FROM admin WHERE Username = '$myusername' and Passcode = '$mypassword'";
  $result = mysqli_query($users_conn_adm,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $active = $row['active'];
  $count = mysqli_num_rows($result);
  // If result matched $myusername and $mypassword, table row must be 1 row
  if($count == 1) {
    //session_register("myusername");
    $_SESSION['userLogin'] = $myusername;
    $_SESSION['authId'] = $row["AuthId"];
    $permission = new Permission(intval($row["Permissions"]));
    $_SESSION['administratorPermission'] = $permission->checkAdmin();
    $_SESSION['webEditorPermission'] = $permission->checkWebEditor();
    $_SESSION['editorPermission'] = $permission->checkOggiSTIEditor();
    $_SESSION['reviserPermission'] =  $permission->checkOggiSTIReviser();
    $_SESSION['idPp_Id'] = $row["IdPp_Id"];
    $_SESSION['nome_completo'] = $row["nome"]." ".$row["cognome"];
    $_SESSION['eventDate'] = "";
    $_SESSION['itaTitle'] = "";
    $_SESSION['engTitle']  = "";  
    $_SESSION['itaAbstract'] = "";
    $_SESSION['engAbstract'] = "";
    $_SESSION['itaDescription'] = "";
    $_SESSION['engDescription'] = "";
    $_SESSION['keywords'] = "";
    include '../Api/extractPersonInformation.php';
    header("location: welcome.php");
  }else {
    header("location: no_login.php?error=inv_user_password");
  }
}
?>


<!DOCTYPE html><html lang="it"><head><meta charset="UTF-8">

<title>Autenticazione - HMR</title>



<link rel='stylesheet' href='../../../Assets/Libs/Bootstrap/CSS/bootstrap.css'>
<script src='../../../Assets/Libs/Bootstrap/JS/bootstrap.js'></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>


<!-- Load HMR CSS styles & fonts -->
<link rel="stylesheet" type="text/css" href="../../../HMR_Style.css">

<!-- Load Administration styles & fonts -->
<link rel="stylesheet" type="text/css" href="../CSS/Administration_Style.css">

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

<!-- Load favorite icon -->
<link rel="icon" type="image/png" href="../../../Assets/Images/HMR_2017g_GC-WebFavIcon16x16.png" />

<!-- Load HMR standard libraries -->
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 
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
  
<!-- Content -->
<div class="HMR_Content">

  <div id="headerLogin">
<h1><span class="glyphicon glyphicon-lock"></span> Login</h1>
</div>
<div class="jumbotron">
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
