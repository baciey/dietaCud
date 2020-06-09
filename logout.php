<?php

	session_start();
	
	session_unset();
	
	header('Location: moje-konto.php');

?>