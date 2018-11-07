<?php
    require("../../../../Config/UsersConfig.php");
    session_start();
    if(!isset($_SESSION['login_user'])) {
        header('Location: no_login.php?error=inv_access');
    }
    $autore = $_SESSION['login_user'];
	
	//header('Content-Type : application/json');
	
        $id_auth = $_GET["id_auth"];
		
       
        $sql = "DELETE FROM admin WHERE id_auth='$id_auth'";

    if (mysqli_query($connUtenti, $sql)){
   $inserito="Evento cancellato correttamente";
   header( "Location:../html/utenti.php?messaggio=eliminato" );
	

}else{
	$inserito="Error deleting record: " . mysqli_error($connUtenti);
  header('Location:../html/utenti.php?messaggio=errore' );
}

?>


