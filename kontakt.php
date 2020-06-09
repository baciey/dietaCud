<!DOCTYPE HTML>
<html lang="pl">
<head>
<title>Dieta Niskowęglowodanowa, kontakt</title>
<?php require 'template/head.php';?>
<link rel="stylesheet" href="style/stylecontact.css" type="text/css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
	
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
		<div id="pojemnikFormularzOutter">
			<div id="pojemnikFormularz">
				<h3>Formularz kontaktowy</h3>
				<p>* pola wymagane </p>

				<form action="contact.php" method="post" id="formKontakt">
				<input type="text" name="yourname" placeholder="Imię *" required ><br />
				<input type="text" name="subject" placeholder="Temat" /><br />
				<input type="email" name="email" placeholder="E-mail *" required ><br />
				<input type="text" name="website" placeholder="Strona internetowa"></p>
			</div>

			<div id="pojemnikFormularz2">
				
					<textarea name="comments"   placeholder="Twoja wiadomość" style="resize: none; height: 196px; margin-bottom: 16px;  "></textarea>  
					<input type="submit" value="Wyślij" class="przycisk" id="przyciskKontakt">
				</div>
				</form>
			</div>

			<div id="pojemnikEmail">
				<i class="material-icons md-48">mail_outline</i><a href="mailto:<?php echo $email; ?>">
				<p><?php echo $email; ?></p> </a>  
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