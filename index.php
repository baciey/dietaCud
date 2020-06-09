<!DOCTYPE HTML>
<html lang="pl">

<head>
	<?php require 'template/head.php'; ?>
	<title>Dieta Niskowęglowodanowa</title>
	<link rel="stylesheet" type="text/css" href="slick/slick.css" />
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
	<link rel="stylesheet" href="style/styleindex.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="google-site-verification" content="GDut1LrU4GJw-vbm7RRMA9-YJVTT_em19PVZrZN2wXI">
	<link href="https://fonts.googleapis.com/css?family=Lato|Dancing+Script&display=swap" rel="stylesheet">
</head>

<body>

	<!---NAVBAR-->
	<header>
		<?php require 'template/navbar.php'; ?>
	</header>

	<!---TOPBAR-->
	<div class="topbar">
		<div class="centeredText">Witaj na stronie Dieta Cud!</div>
	</div>



	<!---GŁÓWNA TREŚĆ-->
	<section>
		<div class="flexContainer">
			<div class="flexItem hidden">
				<h2>Artykuły</h2>W zakładce
				<a class="menulink" href="artykuly">ARTYKUŁY</a> znajdziesz opisy, przyczyny różnych chorób oraz porady jak postępować aby się ich pozbyć
			</div>
			<div class="flexItem hidden">
				<h2>Baza produktów</h2>W zakładce
				<a class="menulink" href="baza-produktow.php">BAZA PRODUKTÓW</a>
				możesz sprawdzić zawartość kalorii, białek, tłuszczów i węglowodanów w różnych produktach spożywczych, ponadto kalkulator wyliczy dla Ciebie proporcje pomiędzy tymi składnikami oraz sprawdzisz ich udział kaloryczny wyrażony w procentach.
			</div>
			<div class="flexItem hidden">
				<h2>Moje konto</h2>Zalogowani użytkownicy mogą zapisywać skomponowane posiłki na swoim koncie. Historię swoich posiłków sprawdzisz w zakładce
				<a class="menulink" href="moje-konto.php">MOJE KONTO</a>
			</div>
			<div class="flexItem hidden">
				<h2>Kontakt</h2>Jeśli masz jakieś pytania, sugestie, chciałbyś się skontaktować, wyślij nam wiadomość na adres <?php echo $email; ?>lub użyj formularza kontaktowego w zakładce
				<a class="menulink" href="kontakt">KONTAKT</a>
			</div>
		</div>

		<h2>Polecane strony:</h2>

		<div class="flexContainer" style="background-color: var(--bg-color);">
			<div class="flexItem">
				<div class="title">Tabele kalorii</div>
				<a href="https://www.tabele-kalorii.pl" target="blank">
					<img src="images/tabele.jpg" class="zdjecieStrony"></a>
			</div>
			<div class="flexItem">
				<div class="title">Dr Kwaśniewski</div>
				<a href="http://www.dr-kwasniewski.pl/" target="blank">
					<img src="images/kwasniewski2.jpg" class="zdjecieStrony"></a>
			</div>
			<div class="flexItem">
				<div class="title">Dieta Lutza</div>
				<a href="http://www.dobradieta.pl/lutz.php" target="blank">
					<img src="images/lutz.jpg" class="zdjecieStrony"></a>
			</div>
		</div>
	</section>

	<script>
		const firstFlexItem = document.querySelector('.flexItem:nth-child(1)');
		const secondFlexItem = document.querySelector('.flexItem:nth-child(2)');
		const thirdFlexItem = document.querySelector('.flexItem:nth-child(3)');
		const fourthFlexItem = document.querySelector('.flexItem:nth-child(4)');

		const delay = 400;

		window.addEventListener("scroll", function(event) {
			var scroll = this.scrollY;
			if (window.innerWidth < 400) { //mobile
				if (scroll > 300) firstFlexItem.classList.add('show');
				if (scroll > 300 + firstFlexItem.offsetHeight) secondFlexItem.classList.add('show');
				if (scroll > 320 + firstFlexItem.offsetHeight + secondFlexItem.offsetHeight) thirdFlexItem.classList.add('show');
				if (scroll > 340 + firstFlexItem.offsetHeight + secondFlexItem.offsetHeight + thirdFlexItem.offsetHeight) fourthFlexItem.classList.add('show');
			}
			if (window.innerWidth > 1024) { //desktop
				if (scroll > 300) {
					firstFlexItem.classList.add('show');
					setTimeout(() => {
						secondFlexItem.classList.add('show');
						setTimeout(() => {
							thirdFlexItem.classList.add('show');
							setTimeout(() => {
								fourthFlexItem.classList.add('show');
							}, delay);
						}, delay);
					}, delay);
				}
			}
		});
	</script>



	<!---STOPKA-->
	<footer>
		<?php require 'template/footer.php'; ?>
	</footer>


</body>





</html>