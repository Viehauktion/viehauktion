<div class="row">
  <div class="span4">
    <h5>Für Schweinebauern</h5>
    <ul class="unstyled">
      <li <? if ($View=="edit_auction" && $_REQUEST['is_auction']=="yes") echo('class="active"'); ?> ><a href="?view=edit_auction&is_auction=yes"><?  echo($texts['navi_auction_add']); ?></a></li>
      <li <? if ($View=="market") echo('class="active"'); ?> ><a href="?view=market"><?  echo($texts['navi_market']); ?></a></li>
      <li <? if ($View=="how_it_works") echo('class="active"'); ?> ><a href="?view=how_it_works" ><? echo($texts['how_it_works_headline']); ?></a></li>
      <li class="<? if ($View=="faq") echo('active'); ?>" ><a href="?view=faq"><?  echo($texts['navi_faq']); ?></a></li>
    </ul>
  </div>
  <div class="span4">
    <h5>Für Schweinekäufer</h5>
    <ul class="unstyled">
      <li <? if ($View=="auctions") echo('class="active"'); ?> ><a href="?view=auctions"><?  echo($texts['navi_auction']); ?></a></li>
      <li <? if ($View=="market") echo('class="active"'); ?> ><a href="?view=market"><?  echo($texts['navi_market']); ?></a></li>
      <li <? if ($View=="how_it_works") echo('class="active"'); ?> ><a href="?view=how_it_works" ><? echo($texts['how_it_works_headline']); ?></a></li>
      <li class="<? if ($View=="faq") echo('active'); ?>" ><a href="?view=faq"><?  echo($texts['navi_faq']); ?></a></li>
    </ul>
  </div>
  <div class="span4">
    <h5>Über Uns</h5>
    <ul class="unstyled">
      <li><a href="?view=team" class="footerBtn"  role="button" ><?  echo($texts['footer_team']); ?></a></li>
      <li><a href="?view=agb" class="footerBtn" role="button" ><?  echo($texts['footer_agb']); ?></a></li>
      <li><a href="?view=imprint" class="footerBtn"  role="button"  ><?  echo($texts['footer_imprint']); ?></a></li>
      <li><a href="#contactModal" class="footerBtn"  role="button"  data-toggle="modal"><?  echo($texts['footer_contact']); ?></a></li>
    </ul>
  </div>
  <div class="span12 copy">
    &copy <? echo(date("Y")); ?> - Meyborg UG (haftungsbeschänkt)
  </div>
</div>

   