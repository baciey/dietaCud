<?php

	session_start();
	
	if (!isset($_SESSION['udanarejestracja']))
	{
		header('Location: moje-konto.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
	
	//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
	if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
	if (isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
	
	
	//Usuwanie błędów rejestracji
	if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
	if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
	
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<?php require 'template/head.php';?>
<title>Dieta Niskowęglowodanowa, moje-konto</title>
<link rel="stylesheet" href="style/stylekonto.css" type="text/css"/>

</head>
<body>
<!---NAVBAR-->
<header>
<?php require 'template/navbar.php';?>
</header>

<!---TOPBAR-->
<section>

</section>



<!---GŁÓWNA TREŚĆ-->
<article>

<div id="pojemnik">
		<h1><span>Utwórz nowe konto</span></h1>
			<div id="pojemnikFormularz">
				<h2>Dziękujemy za rejestrację</h2>
				<p>Możesz już zalogować się na swoje konto.</p>
				<a href="moje-konto.php" class="sprzycisk">Zaloguj się na swoje konto.</a>
				<br /><br />
</div>
			</div>

<div style="clear:both"></div>
</article>




<!---STOPKA-->
<footer>
<?php require 'template/footer.php';?>
</footer>



</body>





</html>