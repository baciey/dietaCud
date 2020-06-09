<?php

	session_start();
	
	if (isset($_POST['nick']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność nickname'a
		$nick = $_POST['nick'];
		
		//Sprawdzenie długości nicka
		if ((strlen($nick)<0) || (strlen($nick)>50))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Login musi posiadać od 1 do 50 znaków!";
		}
		
		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Login może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		
		
		
		
		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
					
		
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		
		
		require_once "database/databaseconnect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($servername, $username, $password, $dbname);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				
						

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM users WHERE user='$nick'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="Ten login jest zajęty! Wybierz inny.";
				}
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$nick', '$haslo_hash')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: witamy.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<?php require 'template/head.php';?>
<title>Dieta Niskowęglowodanowa, moje-konto</title>
<link rel="stylesheet" href="style/stylekonto.css" type="text/css"/>


</head>
<body>

<!---LOGO/MENU-->
<header>
<?php require 'template/navbar.php';?>
</header>

<!---TOPBAR-->
<section>

</section>



<!---GŁÓWNA TREŚĆ-->
<article>

	<div id="pojemnik">
		<h1><span>Rejestracja</span></h1>
		<div id="pojemnikFormularz">
			<h3>Utwórz nowe konto</h3>
	<form class="formKonto" method="post">
	
		 <input type="text" placeholder="Login" value="<?php
			if (isset($_SESSION['fr_nick']))
			{
				echo $_SESSION['fr_nick'];
				unset($_SESSION['fr_nick']);
			}
		?>" name="nick" />
		
<?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
?>
		
		 
		
		
		
		 <input type="password" placeholder="Hasło" value="<?php
			if (isset($_SESSION['fr_haslo1']))
			{
				echo $_SESSION['fr_haslo1'];
				unset($_SESSION['fr_haslo1']);
			}
		?>" name="haslo1" /><br />
		
<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
?>		
		
		 <input type="password" placeholder="Powtórz hasło" value="<?php
			if (isset($_SESSION['fr_haslo2']))
			{
				echo $_SESSION['fr_haslo2'];
				unset($_SESSION['fr_haslo2']);
			}
		?>" name="haslo2" /><br />
		
<?php
			if (isset($_SESSION['e_bot']))
			{
				echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
				unset($_SESSION['e_bot']);
			}
?>	
		
		
		<input type="submit" class="przycisk" id="przyciskKonto" value="Zarejestruj się" />
		
	</form>
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