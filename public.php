<?php

session_start();

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<title>Dieta Niskowęglowodanowa, cukrzyca</title>
<?php require 'template/head.php';?>
	<link rel="stylesheet" href="style/stylewpisy.css" type="text/css"/>
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</head>
<body>

<!---NAVBAR-->
<header>
<?php require 'template/navbar.php';?>
</header>


<!---TOPBAR-->
<section>
<div class="bibliotekaZdjecie"></div>
</section>

<!---GŁÓWNA TREŚĆ-->
<article>
  <div id="pojemnik">
	 <div class="zbior">
    <?php
      require_once "database/databaseconnect.php";
      $idz = mysqli_real_escape_string($conn, $_GET['id']);
      $sql = "SELECT * FROM articles WHERE id='$idz'";
      $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
      $row = mysqli_fetch_array($result);
      $_SESSION['idz'] = $row['id'];
    ?>

      <div id="data">
        <i class="material-icons">access_time</i>
        <?php echo $row['date']; ?> 
      </div>
      <div id="mobileImage">
        <img src="images/<?php echo $row['img']; ?>" >
      </div>
        <?php echo $row['content']; ?>

      <div class="borderBottom" style="margin-bottom: 50px; width: 100%"></div>

      <div id="iloscKomentarzy">
        
        <?php

        $sql2 = "SELECT COUNT(article_id) as total FROM tbl_comment WHERE article_id='$idz'";
        $result2 = mysqli_query($conn, $sql2) or die("Bad Query: $sql2");
        $row2 = mysqli_fetch_array($result2);

        if ($row2['total'] == 0)
        {
          echo "Brak komentarzy";
        }
        else
        {
          echo "Komentarze: ".$row2['total'];
        }

        
        ?>
      </div>

      
    </div>

    <div>
      
      <?php
      if (!isset($_SESSION['zalogowany']))
      {
        ?>
          <div  class='nieZalogowano' >
          Komentujesz jako niezalogowany użytkownik
          <a href='moje-konto.php' > Zaloguj się</a>
          </div>
        <?php
      }
      else
      {
        
    ?>

    </div>


          <div class='zalogowano'>
            <div id="zalogowanoJako">Komentujesz jako: 
              <a href='moje-konto.php' style="font-weight: bold;"> <?php echo $_SESSION['user'] ?> </a> &nbsp;
            </div> 
              <a href="logout.php" class="wylogujSie" style="color: lightgrey; border: 1px solid lightgrey;" >Wyloguj się</a>
          </div>
          <div id='comment_name' style='display:none'>Foo bar</div> <br><br>
        <?php    
      }
      ?>
  <div class="container">

      <div id="komentarze">
        
       
        <p class="text-danger"></p>

          <form method="POST" id="comment_form"><?php if (isset($_SESSION['zalogowany'])) {echo "<div class ='username-session'>".$_SESSION['user'].'</div>';} ?> 
            <input type="text" name="comment_name" id="comment_name" <?php if (isset($_SESSION['zalogowany'])) { echo 'style="display:none;"'; } ?> placeholder="Imię" />
            <textarea name="comment_content" id="comment_content" placeholder="Treść komentarza" rows="" ></textarea>
            <input type="hidden" name="comment_id" id="comment_id" value="0" /> 
           <!-- <div id="kod"> -->
              <input type="text" name="txtcode"  class="txtcode" id="kod" placeholder="Kod" >  
              <div id="captcha"><img src="captchaimg.php"  alt="CAPTCHA"></div>
            <!-- </div> -->
            <div style="clear:both"></div>
            <input type="submit" name="submit" id="submit" class="przycisk przyciskKoment"   value="Wyślij" />
            <input type="text"  class="txtcode" id="hidden" value="0" />
            <br/>
          </form>
         
      </div>
         <span id="comment_message" style="text-align: left;"></span>

  </div>


         <div class="container-output">
            <div id="display_comment"></div>
         </div>
</div>


 

<script>

$(document).ready(function()
  {
   $('#comment_form').on
   (
    'submit', function(event)
     {
      event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax
      ({
         url:"add_comment.php",
         method:"POST",
         data:form_data,
         dataType:"JSON",
         success:function(data)
           {
              if(data.error != '<div class="komentarzDodany">Komentarz dodany</div>')
              {
               $('#comment_message').html(data.error);
               $('#comment_id').val('0');
               load_comment();
              }
              else
              {
               $('#comment_message').html(data.error);
               $('#comment_id').val('0');
               $('#comment_form')[0].reset();
               load_comment();

              }

           }
      })
     }
   );

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });
 
});
</script>

</article>

<div style="clear:both"></div>

<!---STOPKA-->
<footer>
<?php require 'template/footer.php';?>
</footer>


</body>





</html>