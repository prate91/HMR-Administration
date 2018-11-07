<?php

require("../../../../Config/UsersConfig.php");

if(isset($_POST['invia'])) {

// define variables and set to empty values
$user = $password = $errore = $IdPp = "";
$permessi = array();
$ok = 1;
$amministratore = $webeditor = $redattore =  $revisore  = 0;
$result = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = isset($_POST["username"]) ? $_POST['username'] : '';
  $user = mysqli_real_escape_string($connUtenti, $user);
  $password = isset($_POST["password"]) ? $_POST['password'] : '';
  $password = mysqli_real_escape_string($connUtenti, $password);
  $IdPp = isset($_POST["selectPerson"]) ? $_POST['selectPerson'] : ''; 
  echo $IdPp; 
  

  $permessi = isset($_POST['permessi']) ? $_POST['permessi'] : array();
  if (!count($permessi)) {
      $errore = 'Errore! Devi selezionare almeno un permesso!';
      $ok = 0;
  }    
      
  foreach($permessi as $permesso) {
    if($permesso == "amministratore"){
        $amministratore = 1;
    }
      if($permesso == "webeditor"){
        $webeditor = 1;
    }
    if($permesso == "redattore"){
        $redattore = 1;
    }
    if($permesso == "revisore"){
        $revisore = 1;
    }
  }
  
  
}
}

//inserting data order
$toinsert = "INSERT INTO admin (username, passcode, amministratore, webeditor, redattore, revisore, IdPp) 
VALUES ('$user',MD5('$password'),'$amministratore','$webeditor','$redattore','$revisore', '$IdPp')";

//declare in the order variable
if($ok ==1 ){
    $result = mysqli_query($connUtenti, $toinsert);	//order executes
}
if($result){

   $inserito="Inserimento avvenuto correttamente";
    header( "Location:../html/utenti.php?messaggio=inserito" );

}else{

	$inserito="Inserimento non eseguito";
  header( "Location:../html/utenti.php?messaggio=errore" );


}


?>
