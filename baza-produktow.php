<?php
session_start();
require_once("database/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
    case "Change":
        if(!empty($_POST["quantity"])) {
            $productByname = $db_handle->runQuery("SELECT * FROM owoce WHERE name='" . $_GET["name"] . "'");
            $itemArray = array($productByname[0]["name"]=>array('name'=>$productByname[0]["name"], 'name'=>$productByname[0]["name"], 'quantity'=>$_POST["quantity"],'b'=>$productByname[0]["b"],'t'=>$productByname[0]["t"],'w'=>$productByname[0]["w"],'k'=>$productByname[0]["k"]));
            
            if(!empty($_SESSION["cart_item"])) {
                if(in_array($productByname[0]["name"],array_keys($_SESSION["cart_item"]))) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByname[0]["name"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                            }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
        }
    break;
    case "remove":
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["name"] == $k)
                        unset($_SESSION["cart_item"][$k]);              
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
            }
        }
    break;
    case "empty":
        unset($_SESSION["cart_item"]);
    break;  
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require 'template/head.php';?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- MDB icon -->
  <link rel="icon" href="mdbfree/img/mdb-favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="mdbfree/css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="mdbfree/css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="style/stylebaza-produktow.css">
  <link rel="stylesheet" href="style/style.css">
  <!-- MDBootstrap Datatables  -->
  <link href="mdbfree/css/addons/datatables.min.css" rel="stylesheet">



</head>
<body onresize="limitToOneLetter()" onload="limitToOneLetter()">
  <!---NAVBAR-->
<header>
<?php require 'template/navbar.php';?>
</header>

  <!-- Start your project here-->
  <div id="pojemnik">
<h1><span>Baza produktów</span></h1>
<div id="pojemnikFormularz">  
<div id="shopping-cart">
<div class="txt-heading bold">Dodane produkty</div>

<a id="btnEmpty" href="baza-produktow.php?action=empty">Wyczyść tabelę</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    
    $total_b = 0;
    $total_t = 0;
    $total_w = 0;
    $total_k = 0;
?>  
<div class="parent_table">
    <div class="table-responsive-lg">
      <table class="table table-sm table-bordered table-striped " id="tblcart" >
        <tr class="thead-dark">
          <th style="text-align: left;" >Nazwa</th>
          <th class="displayNone">Waga[g]</th>
          <th class="replace">Białko[g]</th>
          <th class="replace">Tłuszcze[g]</th>
          <th class="replace">Węglowodany[g]</th>
          <th class="replace">Kalorie</th>
          <th id="proporcje" >Proporcje B:T:W</th>
          <th id="udzialKalorii"  >Udział % kalorii B:T:W</th>
          <th style="text-align:center;">Usuń</th>
          <th style="text-align:center;">Waga[g]</th>
          <th style="text-align:center;">Zmień</th>
        </tr>   



<?php       
    foreach ($_SESSION["cart_item"] as $item){
        
        $item_b = $item["quantity"]*$item["b"]/100;
        $item_t = $item["quantity"]*$item["t"]/100;
        $item_w = $item["quantity"]*$item["w"]/100;
        $item_k = $item["quantity"]*$item["k"]/100;



            $b_item = $item_b*4;
            $t_item = $item_t*9;
            $w_item = $item_w*4;

                $sum = $b_item+$t_item+$w_item;
                $b_percentage = number_format($b_item/$sum*100, 1);
                $t_percentage = number_format($t_item/$sum*100, 1);
                $w_percentage = number_format($w_item/$sum*100, 1);

                $proportions = "[1]:"."[".number_format($item_t/$item_b,1)."]" .":[".number_format($item_w/$item_b,1)."]";
                $percents = " [". $b_percentage."]:[". $t_percentage."]:[". $w_percentage."]";
                $waga = $item["quantity"];
                $nazwa = $item["name"];
            ?>  




        <tr>
            <form method="post" action="baza-produktow.php?action=Change&name=<?php echo $item["name"]; ?>">
                <td style="text-align: left;"><?php echo $item["name"]; ?></td>
                <td class="displayNone"><?php echo $item["quantity"]; ?></td>
                <td><?php echo number_format($item_b,1); ?></td>
                <td><?php echo number_format($item_t,1); ?></td>
                <td><?php echo number_format($item_w,1); ?></td>
                <td><?php echo number_format($item_k,0); ?></td>
                <td><?php echo $proportions ?></td>
                <td><?php echo $percents; ?></td>
                <td  style="text-align:center;"><a href="baza-produktow.php?action=remove&name=<?php echo $item["name"]; ?>" class="btnRemoveAction"><img src="images/icon-delete.png" alt="Remove Item" /></a></td>
                <td style="text-align:center;"><input type="number" class="quantity" name="quantity" value="<?php echo $item["quantity"]; ?>"   /></td>
                <td style="text-align:center;"><input type="submit" class="changeBtn" value=""></td>
            </form>
        </tr>
        



                    



                <?php
                $total_quantity += $item["quantity"];
                
                $total_b += ($item["b"]*$item["quantity"]/100);
                $total_t += ($item["t"]*$item["quantity"]/100);
                $total_w += ($item["w"]*$item["quantity"]/100);
                $total_k += ($item["k"]*$item["quantity"]/100);

                }
                
                $b1 = $total_b*4;
                $t1 = $total_t*9;
                $w1 = $total_w*4;

                $b2 = $total_b;
                $t2 = $total_t;
                $w2 = $total_w;



                $total_sum = $b1+$t1+$w1;
                $b_total_percentage = number_format($b1/$total_sum*100, 1);
                $t_total_percentage = number_format($t1/$total_sum*100, 1);
                $w_total_percentage = number_format($w1/$total_sum*100, 1);

                $total_proporcje = " [1]:"."[".number_format($t2/$b2, 1)."]:"."[".number_format($w2/$b2, 1)."]";
                $total_procenty = " [". $b_total_percentage."]:[". $t_total_percentage."]:[". $w_total_percentage."]";


                $tot_k = number_format($total_k, 0);
                $tot_b = number_format($total_b, 1);
                $tot_t = number_format($total_t, 1);
                $tot_w = number_format($total_w, 1);
                


  ?>
<tr class="bold">
  <form action="baza-produktow.php" method="post" >
  <td >Razem:</td>
  <td class="displayNone"><?php echo $total_quantity; ?></td>
  <td><?php echo " ".$tot_b; ?></td>
  <td><?php echo " ".$tot_t; ?></td>
  <td><?php echo " ".$tot_w; ?></td>
  <td><?php echo " ".$tot_k; ?></td>
  <td><?php echo $total_proporcje; ?></td>
  <td><?php echo $total_procenty; ?></td>
  <td colspan="4"></td>
</tr>
</table>
</div>





</div>



<?php
} else {
?>
<div class="no-records">0 dodanych produktów</div>
<?php 
}
?>
</div>

<div class="txt-heading bold">Zapisz posiłek</div>
<?php if (!isset($_SESSION['zalogowany']))
  {
    echo "<p  id='zalogowano' >";
    echo "*Możliwość zapisywania posiłków tylko dla zalogowanych użytkowników ";
    echo "<a href='moje-konto.php' class='logoutbtn'> Zaloguj się</a>"; 
    echo "</p>";

  }

else
{ ?>
  



    
   
    

            <div id="zapiszPosilek">
              <div class="zapiszPosilekInner borderBottom"><div id="zalogowanoJako">Zalogowano jako: <a href='moje-konto.php' style="font-weight: bold;"> <?php echo $_SESSION['user'] ?> </a> &nbsp;</div> 
              <a href="logout.php" class="wylogujSie" >Wyloguj się</a></div>
              <div class="zapiszPosilekInner"><div class="beforeInput">Data posiłku:</div> <input type="date" id="inputDate" name="input_date" ></div>
              <div class="zapiszPosilekInner"><div class="beforeInput">Nazwa posiłku:</div> <input type="text" name="save_as"></div>
              <div class="zapiszPosilekInner"><div class="beforeInput"></div><input type="submit" name="dodaj" class="przycisk" id="przyciskBaza" value="Zapisz"></div>
             <div class="zapiszPosilekInner borderTop" >Zapisane posiłki sprawdzisz w <a href="moje-konto.php" style="font-weight: bold;">MOJE KONTO</a></div>
            </div>
            </form>
              

          <?php
}


if (isset($_POST['dodaj']))
    {
require_once "database/databaseconnect.php";

$date = date("Y-m-d");
$saveas = $_POST['save_as'];
$userid = $_SESSION['id'];

if($_POST['input_date'] != 0000-00-00)
{

$input_date = $_POST['input_date'];

$sql = "INSERT INTO posilek (id, user_id, name, waga, b, t, w, k, proportions, kcal_percents, date)
 VALUES (NULL, '$userid','$saveas','$total_quantity','$total_b','$total_t','$total_w','$total_k','$total_proporcje','$total_procenty', '$input_date')";
}
else 
{
   $sql = "INSERT INTO posilek (id, user_id, name, waga, b, t, w, k, proportions, kcal_percents, date)
 VALUES (NULL, '$userid','$saveas','$total_quantity','$total_b','$total_t','$total_w','$total_k','$total_proporcje','$total_procenty', '$date')";
}


if(mysqli_query($conn, $sql))
{
    echo "<div class='dodanoPosilek'>Pomyślnie dodano posiłek </div>";

}

else
{
    echo "Przepraszamy, wystąpił błąd.";
}
}





           


?>





<div class="txt-heading bold">Znajdź produkt</div>

<?php $product_array = $db_handle->runQuery("SELECT * FROM owoce");
if (!empty($product_array)) { ?>
<table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
  width="100%">
  <thead>
    <tr class="bold">
      <th>Nazwa</th>
      <th class="replace">Białko[g]</th>
      <th class="replace">Tłuszcze[g]</th>
      <th class="replace">Węglowodany[g]</th>
      <th class="replace">Kalorie</th>
      <th style="text-align: center;">Waga</th>
      <th style="text-align: center;">Dodaj</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($product_array as $key=>$value) { ?>
    <tr>
      <form method="post" action="baza-produktow.php?action=Change&name=<?php echo $product_array[$key]["name"]; ?>">
        <td style="text-align: left;"><?php echo $product_array[$key]["name"]; ?></td>
        <td><?php echo $product_array[$key]["b"]; ?></td>
        <td><?php echo $product_array[$key]["t"]; ?></td>
        <td><?php echo $product_array[$key]["w"]; ?></td>
        <td><?php echo $product_array[$key]["k"]; ?></td>
        <td style="text-align: center;"><input type="number" name="quantity" class="quantity" value="100" ></td>
        <td style="text-align: center;"><input type="submit" class="addBtn" value=""></td>
      </form>
    </tr>

     <?php
            }
        }
   else
  {
    echo "<p class='wynik'>";
    echo "0 wyników";
    echo "</p>";
  } ?>

    
  </tbody>
</table>

</div>
</div>
 
  <!-- End your project here-->

  <!-- jQuery -->
  <script type="text/javascript" src="mdbfree/js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="mdbfree/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="mdbfree/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="mdbfree/js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script>
if ($(window).width() > 850)
{
  $(document).ready(function () {
  $('#dtHorizontalVerticalExample').DataTable({

    columnDefs: [{
  orderable: false,
  targets: 6
  } , {
  orderable: false,
  targets: 5
  }],
  "scrollX": true,
  "scrollY": 200,
  "pagingType": "numbers",
  "language": {
    "search": "Szukaj:",
    "info": "Strona _PAGE_ z _PAGES_",
    "lengthMenu": "Pokaż _MENU_ wyników",
    "infoEmpty": "Brak wyników",
    "infoFiltered": "(Spośród _MAX_ pozycji)",
    "zeroRecords": "Brak wyników"
  }

  });
  $('.dataTables_length').addClass('bs-select');
  });
}

else
{
  $(document).ready(function () {
  $('#dtHorizontalVerticalExample').DataTable({

  "ordering": false,
  "scrollX": true,
  "scrollY": 200,
  "pagingType": "numbers",
  "language": {
    "search": "Szukaj:",
    "info": "Strona _PAGE_ z _PAGES_",
    "lengthMenu": "Pokaż _MENU_ wyników",
    "infoEmpty": "Brak wyników",
    "infoFiltered": "(Spośród _MAX_ pozycji)",
    "zeroRecords": "Brak wyników"
  }

  });
  $('.dataTables_length').addClass('bs-select');
  });
}



longName = [];
       y = document.getElementsByClassName('replace');

for (i = 0; i < y.length; i++) {
      name = y[i].textContent;
      longName.push(name);
    }


function limitToOneLetter() {
 var x, i;
 x = document.getElementsByClassName('replace');
    for (i = 0; i < x.length; i++) {
      if ($(window).width() < 1000) {
        if (x[i].textContent == "Kalorie" || x[i].textContent == "kcal") {
          x[i].innerHTML = "kcal";
        } else {
            x[i].innerHTML = x[i].textContent.substring(0,1) + "[g]";
          }
        
      } else {
          x[i].innerHTML = longName[i];
        }
    }
}

</script>
  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" src="mdbfree/js/addons/datatables.min.js"></script>



<div style="clear: both"></div>

<!---STOPKA-->
<footer>
<?php require 'template/footer.php';?>
</footer>

</body>
</html>
