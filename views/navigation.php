<div class="navbar navbar-static-top">
  <div class="navbar-inner">
  
    <ul class="nav">
      <? /* <li <? if ($View=="home") echo('class="active"'); ?>  ><a href="?view=home"><?  echo($texts['navi_news']); ?></a></li> */ ?>
      <li <? if ($View=="auctions") echo('class="active"'); ?> ><a href="?view=auctions"><?  echo($texts['navi_auction']); ?></a></li>
      <li <? if ($View=="edit_auction" && $_REQUEST['is_auction']=="yes") echo('class="active"'); ?> ><a href="?view=edit_auction&is_auction=yes"><?  echo($texts['navi_auction_add']); ?></a></li>
      
      <li <? if ($View=="market") echo('class="active"'); ?> ><a href="?view=market"><?  echo($texts['navi_market']); ?></a></li>
      <li <? if ($View=="edit_auction" && $_REQUEST['is_auction']=="no") echo('class="active"'); ?> ><a href="?view=edit_auction&is_auction=no"><?  echo($texts['navi_market_add']); ?></a></li>
      
<? if($gBase->User['id'] != "") { ?>
      <li class="<? if ($View=="profile") echo('active'); ?>"><a href="?view=profile">Profil</a></li>
<? } ?>
		</ul>
    <ul class="nav pull-right">
      <li class="<? if ($View=="faq") echo('active'); ?>" ><a href="?view=faq"><?  echo($texts['navi_faq']); ?></a></li>
    </ul>
  </div>
</div>