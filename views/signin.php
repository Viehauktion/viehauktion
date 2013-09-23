
<div class="row"> 
<div id="signin" class="pull-right inline">

<?  if($gBase->User['id']!=""){ ?>
<a href="?&view=profile" ><?  echo($texts['signin_signedin_as'].$gBase->User['username']); ?>&nbsp;<?  echo($texts['signin_profil']); ?></a>&nbsp;-&nbsp;
<a href="?action=logout_user&view=home" ><?  echo($texts['signin_logout']); ?></a>

<? }else{ ?>


<a href="#loginModal" role="button"  data-toggle="modal"><?  echo($texts['signin_login']); ?></a>&nbsp;-&nbsp;
<a href="?view=registration" ><?  echo($texts['signin_register']); ?></a>

<? }?>

</div>
</div>