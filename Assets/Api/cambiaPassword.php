<?php

require("../../../../Config/UsersConfig.php");

if(isset($_POST['invia'])) {

// define variables and set to empty values
$user = $password = $nome = $cognome = $mail = $errore = "";
$permessi = array();
$ok = 1;
$amministratore = $webeditor = $redattore =  $revisore  = 0;
$result = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = isset($_POST["selectUtente"]) ? $_POST['selectUtente'] : '';
  $password = isset($_POST["pw"]) ? $_POST['pw'] : '';
  $password = mysqli_real_escape_string($connUtenti, $password);
  
}
}

//inserting data order
$toinsert = "UPDATE admin SET Passcode = MD5('$password') WHERE Username = '$user'";

//declare in the order variable
$result = mysqli_query($connUtenti, $toinsert);	//order executes

if($result){

   $inserito="Inserimento avvenuto correttamente";
    header( "Location:../PHP/users.php?messaggio=password" );

}else{

	$inserito="Inserimento non eseguito";
  header( "Location:../PHP/users.php?messaggio=errore" );


}


?>
