<?php

	session_start();
	require_once("database/dbcontroller.php");
$db_handle = new DBController();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: moje-konto.php');
		exit();
	}

    require_once "database/databaseconnect.php";

if (isset($_GET['delete']))
{
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM posilek WHERE id = '$delete_id'");
    header('Location: user-account.php');
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

<div class="container1">

<h1><span>Moje konto</span></h1>

       
          <div>
            <div id="zalogowanoJako">Zalogowano jako: 
              <span href='' style="font-weight: bold;"> <?php echo $_SESSION['user'] ?> </span> &nbsp;
            </div> 
              <a href="logout.php" class="wylogujSie" >Wyloguj się</a>
          </div>
          <div id='comment_name' style='display:none'>Foo bar</div> 
         
<div style="clear:both"></div>







<p class="twoje-posilki">Twoje posiłki:</p>

                <form method="post" class="data-posilku">
                    Data posiłku: <input type="date" name="inputdate" style="width: 100px;">
                                  <input type="submit" class="przycisk" style="height: 43px; font-size: 1rem; width: 40px;" value=">">
                </form>

<?php

	
 $userid = $_SESSION['id'];
 $input_date = 0;

 if (isset($_POST['inputdate']))
 {
 $input_date = $_POST['inputdate'];
 }
 

 


 if ($input_date == true)
 {
 echo '<span class="zjedzone-wdniu">Posiłki zjedzone w dniu: </span>'; 
 }
 if (isset($_POST["inputdate"]))
  {
    echo $input_date;
}

 
 if (isset($_POST['inputdate']))
 {
 $product_array = $db_handle->runQuery("SELECT * FROM posilek WHERE user_id = '$userid' AND date = '$input_date' ");
 }
	if (!empty($product_array)) { 
?>
	<table class="tbl-cart" id="tblcart" cellpadding="10" cellspacing="1">
            <tr class="desktop_table1">
                <th>Nazwa posiłku</th>
                <th>Waga[g]</th>
                <th>Białko[g]</th>
                <th>Tłuszcze[g]</th>
                <th>Węglowodany[g]</th>
                <th>Kalorie[kcal]</th>
                <th style="text-align:right;" width="12%">B:T:W</th>
				        <th style="text-align:right;" width="13%">% kcal B:T:W</th>
                <th>Usuń</th>
            </tr>
            <tr class="hide"></tr> 

            <tr class="mobile_table1">
                <th>Nazwa posiłku</th>
                <th>[g]</th>
                <th>B[g]</th>
                <th>T[g]</th>
                <th>W[g]</th>
                <th>Kcal</th>
                <th style="text-align:right;" width="12%">B:T:W</th>
                <th style="text-align:right;" width="13%">% kcal B:T:W</th>
                <th>Usuń</th>
                
            </tr>
<?php
    foreach($product_array as $key=>$value) {

        $id = $product_array[$key]["id"];
?>

			<tr class="desktop_table2">
            	   
                    <td><div >				   <?php echo $product_array[$key]["name"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-b"><?php echo "".$product_array[$key]["waga"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-b"><?php echo "".$product_array[$key]["b"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-t"><?php echo "".$product_array[$key]["t"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-w"><?php echo "".$product_array[$key]["w"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-k"><?php echo "".$product_array[$key]["k"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-b"><?php echo "".$product_array[$key]["proportions"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-b"><?php echo "".$product_array[$key]["kcal_percents"]; ?></div></td>
                    <td  style="text-align:center;"><a href="user-account.php?delete=<?php echo $id; ?>" onclick ="return confirm('Na pewno chcesz usunąć posiłek?');"><img src="images/icon-delete.png" alt="Remove Item" /></a></td>

       	 </tr>
         <tr class="hide"></tr> 

<tr class="mobile_table2">
                 
                    <td><div >           <?php echo $product_array[$key]["name"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-b"><?php echo "".$product_array[$key]["waga"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-b"><?php echo "".$product_array[$key]["b"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-t"><?php echo "".$product_array[$key]["t"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-w"><?php echo "".$product_array[$key]["w"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-k"><?php echo "".$product_array[$key]["k"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-b"><?php echo "".$product_array[$key]["proportions"]; ?></div></td>
                    <td style="text-align:right;"><div class="product-b"><?php echo "".$product_array[$key]["kcal_percents"]; ?></div></td>
                    <td  style="text-align:center;"><a href="user-account.php?delete=<?php echo $id; ?>" onclick ="return confirm('Na pewno chcesz usunąć posiłek?');"><img src="images/icon-delete.png" alt="Remove Item" /></a></td>
                    

         </tr>
    

         
<?php
}

require_once "database/databaseconnect.php";


          
  $add=mysqli_query($conn,"SELECT SUM(b),SUM(t),SUM(w),SUM(k),SUM(waga) from `posilek` WHERE user_id = '$userid' AND date = '$input_date'");
  
  while($row1=mysqli_fetch_array($add))
  {
    

    $mark0=$row1['SUM(waga)'];
    $mark=$row1['SUM(b)'];
    $mark1=$row1['SUM(t)']; 
    $mark2=$row1['SUM(w)'];  
    $mark3=$row1['SUM(k)'];   

                $mb = $mark*4;
                $mt = $mark1*9;
                $mw = $mark2*4;

                $total_sum = $mb+$mt+$mw;
                $b_total_percentage = number_format($mb/$total_sum*100, 1);
                $t_total_percentage = number_format($mt/$total_sum*100, 1);
                $w_total_percentage = number_format($mw/$total_sum*100, 1);



 ?>
 
  <tr class="desktop_table3">
    <th style="text-align:right;">Razem</th>
    <th style="text-align:right;"><?php echo number_format($mark0,1) ?></th>
    <th style="text-align:right;"><?php echo number_format($mark,1) ?></th>
    <th style="text-align:right;"><?php echo number_format($mark1,1) ?></th>
    <th style="text-align:right;"><?php echo number_format($mark2,1) ?></th>
    <th style="text-align:right;"><?php echo number_format($mark3,1) ?></th>

    <th style="text-align:right;"><?php echo $proportions = "[1]:"."[".number_format($mark1/$mark,1)."]" .":[".number_format($mark2/$mark,1)."]"; ?></th>
    <th style="text-align:right;"><?php echo $total_procenty = " [". $b_total_percentage."]:[". $t_total_percentage."]:[". $w_total_percentage."]"; ?></th>
    <td></td>
  </tr>
  <tr class="hide"></tr> 

  <tr class="mobile_table3">
    <th style="text-align:right;">Razem</th>
    <th style="text-align:right;"><?php echo number_format($mark0,1) ?></th>
    <th style="text-align:right;"><?php echo number_format($mark,1) ?></th>
    <th style="text-align:right;"><?php echo number_format($mark1,1) ?></th>
    <th style="text-align:right;"><?php echo number_format($mark2,1) ?></th>
    <th style="text-align:right;"><?php echo number_format($mark3,1) ?></th>

    <th style="text-align:right;"><?php echo $proportions = "[1]:"."[".number_format($mark1/$mark,1)."]" .":[".number_format($mark2/$mark,1)."]"; ?></th>
    <th style="text-align:right;"><?php echo $total_procenty = " [". $b_total_percentage."]:[". $t_total_percentage."]:[". $w_total_percentage."]"; ?></th>
    <td></td>
  </tr>
  <?php } ?>
</table>
<?php
}
else
{
    echo "<p>Brak posiłków</p>";
}

?>

  












</div>


















</article>




<!---STOPKA-->
<footer>
<?php require 'template/footer.php';?>
</footer>



</body>





</html>