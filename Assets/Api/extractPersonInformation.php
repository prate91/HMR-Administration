<?php

require("../../../../Config/EPICAC_config_rd.php");
$idPp_Id = $_SESSION['idPp_Id'];

// extract user information
$sql = "SELECT Name, Surname, Brief FROM people WHERE IdPp='$idPp_Id'";
$result = mysqli_query($EPICAC_conn_rd,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$_SESSION['briefName'] =  $row["Brief"];
$_SESSION['name'] = $row["Name"];
$_SESSION['surname'] = $row["Surname"];
$_SESSION['completeName'] =$row["Name"] . " " . $row["Surname"];


?>