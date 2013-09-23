<div id="signin" class="pull-right">
  <? if($gBase->User['id'] != "") { ?>
    <span class="muted"><?= $texts['signin_signedin_as'] ?></span>
    <a href="?&view=profile" <? if ($View=="profile") echo('class="active"'); ?>>
      <?= $gBase->User['username'] ?>
    </a>
    <span class="muted">&bull;</span>
    <a href="?action=logout_user&view=home" >
      <i class="icon-signout"></i>
      <?= $texts['signin_logout'] ?>
    </a>
  <? } else { ?>
    <a href="#loginModal" role="button"  data-toggle="modal">
      <i class="icon-signin"></i>
      <?  echo($texts['signin_login']); ?>
    </a>
    <span class="muted">oder</span>
    <a href="?view=registration" <? if ($View=="registration") echo('class="active"'); ?>>
      <?  echo($texts['signin_register']); ?>!
    </a>
  <? } ?>
</div>