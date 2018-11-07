<?php

	
	function carica_dati($query, $campi_tabella)
	{
		require("../../../../Config/UsersConfig.php");
			
		$risultato = array();
		$i = 0;
		$risultato_query = mysqli_query($connUtenti, $query);
		if($risultato_query != false && mysqli_num_rows($risultato_query) > 0)
		{
			while($riga = mysqli_fetch_assoc($risultato_query))
			{
				$risultato[$i] = array();
				foreach($campi_tabella as $campo)
					$risultato [$i][$campo] = $riga[$campo]; // utf8_encode( $riga[$campo])
				$i++;				
			}
			
			return json_encode($risultato);
		}
		else
		{			
			return json_encode(array("status" => "error", "details" => "nessun risultato"));
		}
	}

	function loadDataEpicac($query, $campi_tabella)
	{
		require("../../../../Config/EPICACConfig.php");
			
		$risultato = array();
		$i = 0;
		$risultato_query = mysqli_query($connEpicac, $query);
		if($risultato_query != false && mysqli_num_rows($risultato_query) > 0)
		{
			while($riga = mysqli_fetch_assoc($risultato_query))
			{
				$risultato[$i] = array();
				foreach($campi_tabella as $campo)
					$risultato [$i][$campo] = $riga[$campo]; // utf8_encode( $riga[$campo])
				$i++;				
			}
			
			return json_encode($risultato);
		}
		else
		{			
			return json_encode(array("status" => "error", "details" => "nessun risultato"));
		}
	}
		
?>