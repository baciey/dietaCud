<?php

  session_start();
  
  if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
  {
    header('Location: user-account.php');
    exit();
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
    <h1><span>Zaloguj się</span></h1>
      <div id="pojemnikFormularz">
        <a href="rejestracja.php">Rejestracja - załóż darmowe konto!</a><br /><br />
        <form class="formKonto" action="zaloguj.php" method="post">
          <input type="text" name="login" placeholder="Login" /> 
          <input type="password" name="haslo" placeholder="Hasło" />
            <?php
              if(isset($_SESSION['blad']))  echo $_SESSION['blad'];
            ?>
          <input type="submit" class="przycisk" id="przyciskKonto" value="Zaloguj się" />
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