<?

 
if($gBase->User['is_seller']!="no"){

  if($gBase->User==null){
?>
 <div class="well">
<h2><? echo($texts['edit_auction_not_logged_in_headline']); ?></h2>
<?
if($_REQUEST['is_auction']=="yes"){ 
?>
<p><? echo($texts['edit_auction_not_logged_in_description']); ?></p>
<?
}else{
?>
<p><? echo($texts['edit_auction_not_logged_in_description']); ?></p>
<?
}
?>
</div>

<?
  }

?>

<div id="editAuction">
  <?

	$isEditing=false;
	$error="";

	if($gBase->CurrentAuction!=NULL){
		
	if($gBase->CurrentAuction['user_id']==$gBase->User['id']){
		
		$isEditing=true;
		
		

	}else{
		$error=$text['edit_auction_not_allowed'];
		
	
	}
	}

		
?>
  <? if($error!=""){ ?>
  <div class="alert-error"  >
    <h4><? echo($error); ?></h4>
    <span id="error_message"></span> </div>
  <? }else{ 


if($_REQUEST['is_auction']=="yes"){ 

  	?>
  

       
        <?if($_REQUEST['auction_id']!=""){
?>
  <h2><? echo($texts['edit_auction_headline']); ?></h2>
<?
}else{
?>
 <h2><? echo($texts['add_auction_headline']); ?></h2>
<?

}
  ?>  
      <p><? echo($texts['add_auction_description']); ?></p>

      <? if(count($gBase->UserAuctions)==0){
echo("<p>".$texts['add_first_auction']."</p>");
      }
      ?>


      <? }else{ ?>


         <?if($_REQUEST['auction_id']!=""){
?>
  <h2><? echo($texts['edit_offer_headline']); ?></h2>
<?
}else{
?>
 <h2><? echo($texts['add_offer_headline']); ?></h2>
<?

}
  ?>  
      <p><? echo($texts['add_offer_description']); ?></p>

      <? } ?>
     <!--  <form>
  <div class="control-group">
        <label class="control-label" for="category"><? echo($texts['auction_category']); ?></label>
        <div class="controls">
          <select name="category"  id="category" onchange="showForm()" >
            <option value="pigs_auction" ><? echo($texts['pigs']); ?></option>
            <option value="bulls_auction" ><? echo($texts['bulls']); ?></option>
            <option value="chickens_auction" ><? echo($texts['chicken']); ?></option>
          </select>
        </div>
      </div>



      </form>
 -->
  
  	<div id="auction_form">
    	<? include('edit_pigs_auction.php')?>
        <? include('edit_bulls_auction.php')?>
        <? include('edit_chickens_auction.php')?>
    </div>
    <script type="text/javascript">

function showForm(){
	$("#pigs_auction").hide();
	$("#bulls_auction").hide();
	$("#chickens_auction").hide();
	
	//$("#"+$("#category").val()).show();
  
  
  $("#pigs_auction").show();
	
	}
	
	
	
	
	
	
</script>
  
  <? } ?>
  
 
  
</div>



<?

 
}else{

?>

<h2><? echo($texts['no_seller_error_headline']); ?></h2>
<p><? echo($texts['no_seller_error_description']); ?></p>

<?

}

?>

