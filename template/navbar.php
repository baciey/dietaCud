

	
<div class="topnav" id="myTopnav">
  <a href="strona-glowna" id="logoMenu" ><img src="images/logoPoziomo200.png" height="150" width="150" alt="logo"></a>
  <a href="strona-glowna" class="links">STRONA GŁÓWNA</a>
  <a href="artykuly.php" class="links">ARTYKUŁY</a>
  <a href="baza-produktow.php" class="links">BAZA PRODUKTÓW</a>
  <a href="kontakt" class="links">KONTAKT</a>
  <a href="przepisy" class="links">PRZEPISY</a>

  <div class="menuIcon" onclick="myFunction()">
    <div id="spoonMain">
      <div class="spoon1"></div>
      <div class="spoon2" ></div>
    </div>
    <div style="clear: both"></div>
    <div id="knifeMain">
      <div class="knife1"></div>
      <div class="knife2"></div>
    </div>
    <div style="clear: both"></div>
    <div id="porkMain">
      <div id="porkWidelki">
        <div id="pork1"></div>
        <div id="pork2"></div>
        <div id="pork3"></div>
        <div id="pork4"></div>
      </div>
      <div id="porkSrodek"></div>
      <div id="porkUchwyt"></div>
    </div>
  </div>

  <a href="moje-konto.php" class="links">MOJE KONTO</a>
</div>


<script>

function myFunction()
{
  var x = document.getElementById("myTopnav");
  var spoon = document.getElementById('spoonMain');
  var knife = document.getElementById('knifeMain');
  var pork = document.getElementById('porkMain');

  if (x.className === "topnav")
  {
    x.className += " responsive";
    x.style.animationName = "rozwinMenu";
    x.style.animationDuration =  "0.7s";
    x.style.animationFillMode =  "forwards";

    spoon.className = ('fadeOut');
    knife.style.transform = "rotate(45deg)";
    pork.style.top = "-30px";
    pork.style.transform = "rotate(135deg)";
  } 
  else
  {
    x.style.animationName = "zwinMenu";
    x.style.animationDuration =  "0.7s";
    x.style.animationFillMode =  "forwards";

    spoon.className = ('fadeIn');
    pork.style.top = "0px";
    knife.style.transform = "rotate(0deg)";
    pork.style.transform = "rotate(0deg)";


    setTimeout(fade, 700);

    function fade()
    {
      x.className = "topnav";
    }
  }
} 

</script>

