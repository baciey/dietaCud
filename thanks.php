<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<title>Dieta Niskowęglowodanowa, thanks</title>
<?php require 'template/head.php';?>
<link rel="stylesheet" href="style/stylecontact.css" type="text/css"/>
</head>

<body>
<!---NAVBAR-->
<header>
<?php require 'template/navbar.php';?>
</header>


<!---GŁÓWNA TREŚĆ-->
<article>

<div id="pojemnik">
	<h1><span>Kontakt</span></h1>
	<div id="pojemnikText">
		<div id="pojemnikTextInner">
		<div class="text"><i class="material-icons md-24">notifications_active</i> Wiadomość została wysłana</div>

		<div id="wiadomosc">
			
			<p>Imię:    			<?php echo $_SESSION['$yourname'] ?></p>
			<p>Temat:   			<?php echo $_SESSION['$subject']  ?></p>
			<p>E-mail:  			<?php echo $_SESSION['$email2']   ?></p>   
			<p>Strona internetowa:  <?php echo $_SESSION['$website']  ?></p>       
			<p>Treść wiadomości:    <?php echo $_SESSION['$comments'] ?></p>



		</div>
		<div class="text"><i class="material-icons md-24">mood</i> Dziękujemy</div>
	</div>
	</div>
</div>

</article>

<div style="clear: both"></div>

<!---STOPKA-->
<footer>
<?php require 'template/footer.php';?>
</footer>


</body>





</html>