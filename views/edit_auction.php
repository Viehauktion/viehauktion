<?

 

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

<div id="editAuction" class="span9">
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
  <h2><? echo($texts['edit_auction_headline']); ?> (1/2)</h2>
<?
}else{
?>
 <h2><? echo($texts['add_auction_headline']); ?> (1/2)</h2>
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
  <h2><? echo($texts['edit_offer_headline']); ?> (1/2)</h2>
<?
}else{
?>
 <h2><? echo($texts['add_offer_headline']); ?> (1/2)</h2>
<?

}
  ?>  
      <p><? echo($texts['add_offer_description']); ?></p>

      <? } ?>
      <br/>
 <form class="form-horizontal">
  <div class="control-group">
        <label class="control-label" for="category"><strong><? echo($texts['auction_category']); ?></strong></label>
        <div class="controls">
          <select name="category"  id="category" onchange="showForm()" >
            <option value="pigs_auction" ><? echo($texts['pigs']); ?></option>
            <option value="ferkel_auction"  ><? echo($texts['ferkel']); ?></option>
        
          </select>
        </div>
      </div>



      </form>

  
  	<div id="auction_form">
    	<? include('edit_pigs_auction.php') ?>

      <? include('edit_ferkel_auction.php') ?>
    
    </div>
    <script type="text/javascript">

function showForm(){
	$("#pigs_auction").hide();
  $("#ferkel_auction").hide();
	$("#"+$("#category").val()).show();
  
  
	
	}
	
	

    <?
            if($_REQUEST['category_id']=='2'){
          ?>

          $("#category").val('ferkel_auction');
  $("#pigs_auction").hide();
  $("#ferkel_auction").show();
          <?  }else{
?>

 $("#category").val('pigs_auction');
  $("#pigs_auction").show();
  $("#ferkel_auction").hide();

<?            }
              ?>
  


	
	<?

 
if($gBase->User['is_seller']=="no"){

?>

  $("#category").val('ferkel_auction');
  $("#pigs_auction").hide();
  $("#ferkel_auction").show();

<?

}

?>
	        
</script>
  
  <? } ?>
  
 
  
</div>





