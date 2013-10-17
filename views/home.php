<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=219777581532139";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="home" class="row">


  <div id="stage" class="span12">


    <h1><? echo($texts["stage_banner"]); ?></h1>
    <ul class="unstyled">
      <li>
        <span class="icon-stack"><i class="icon-certificate icon-stack-base"></i><i class="icon-ok icon-light"></i></span>
        Die erste Auktion ist provisionsfrei
      </li>
      <li>
        <span class="icon-stack"><i class="icon-certificate icon-stack-base"></i><i class="icon-ok icon-light"></i></span>
        Anonyme Angebote sind möglich
      </li>
    </ul>
    <button onclick="submitSelectAuctionForm();" class="btn btn-primary btn-large">Jetzt Ausprobieren</button>
    <a href="?view=how_it_works" class="btn"><? echo($texts['how_it_works_headline']); ?></a>

  </div>


  <div class="span6">
  	<br/><br/>
  	<a href="?view=how_it_works" ><? echo($texts['how_it_works_headline']); ?></a>
    <p>To Do:</p>
    <p>- Erste Auktion ist provisionsfrei.</p>
    <p>- Auswahl, ob anonym angeboten werden soll</p>
    <p>- Käufer und Verkäufer Bewertung</p>
    <p>- Aktivierungsmail Seller/Buyer </p>
    <p>- Kauf Mail</p>
    <p>- Gekauft Mail</p>
    <p>- Pagination</p>
    <p>- Darstellung nächster Auktionen</p>
    <p>- <strong>Breadcrumb</strong></p>
  </div>
    <div div="socialMedia" class="class4 pull-right">
<div class="fb-like-box" data-href="https://www.facebook.com/pages/Viehauktioncom/126104434226988" data-width="300" data-height="241" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>

  </div>


</div>