

<div id="ratings" class="span5 pull-right well" >
    <h2><? echo($texts['profile_my_ratings']); ?></h2>

    <ul id="ratingsnavigation" class="nav nav-tabs">
      <li 
      <?
      if($Action=='' || $Action=='get_ratings_about'){
      echo('class="active"');
}
?>
      ><a href="#userdata"  onclick="showRatings('received')"><? echo($texts['ratings_received']); ?></a></li>
      <li

            <?
      if($Action=='get_ratings_from'){
      echo('class="active"');
}
?>
 ><a href="#userdata"  onclick="showRatings('written')"><? echo($texts['ratings_written']); ?></a></li>
   
    </ul>
      
   


<div id="ratings_received" class="ratings_sublayer">

      <?

$ratings=$gBase->RawData["ratings_about_user"];

if(count($ratings)>0){


    for($i=0; $i<count($ratings); $i++){

    
      ?>

<div class="rating"> 
<div class="comment well"> 

<? 
if($ratings[$i]["comment"]!=""){
echo($ratings[$i]["comment"]); 
}else{

 echo($texts['no_comment']);
}
?>
</div>
  <div class="emptyPigsRating"  ></div>
  <div class="fullPigsRating" style="width:<? echo(($ratings[$i]["rating"]*33.33)); ?>px" ></div><BR/>
<div class="pull-right"> 
<? echo($texts['from'].' <a href="?view=show_full_user&action=show_full_user&user_id='.$ratings[$i]['writer_id'].'&auction_id='.$ratings[$i]['auction_id'].'"  >'.$ratings[$i]["firstname"].' '.$ratings[$i]["lastname"].'</a> '.$texts['at'].' '.date("d.m.y", strtotime($ratings[$i]["date"]))); ?>
</div>
</div>
      <?

  }
?>

<div class="pagination">
  <ul>
<?
  $pages=(int)$ratings["number_of_rows"]/$GLOBALS["VIEHAUKTION"]["SMALLPAGEELEMENTS"]+1;
  $active=1;
if ($_REQUEST['page']!='') {
  $active=$_REQUEST['page'];
}
 for ($i=1; $i <= $pages; $i++) { 
  if($i==$active){
    echo('<li class="active"><a href="?view=profile&action=get_ratings_about&page='.$i.'#userdata"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=profile&action=get_ratings_about&page='.$i.'#userdata" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>

<?

}else{


  echo($texts['ratings_not_received']);
}

  ?>





</div>








<div id="ratings_written"  class="ratings_sublayer hide">

      <?

$ratings=$gBase->RawData["ratings_from_user"];

if(count($ratings)>0){


    for($i=0; $i<count($ratings); $i++){

    
      ?>

<div class="rating"> 
<div class="comment well"> 

<? 
if($ratings[$i]["comment"]!=""){
echo($ratings[$i]["comment"]); 
}else{

 echo($texts['no_comment']);
}
?>
</div>
  <div class="emptyPigsRating"  ></div>
  <div class="fullPigsRating" style="width:<? echo(($ratings[$i]["rating"]*33.33)); ?>px" ></div><BR/>
<div class="pull-right"> 
<? echo($texts['you'].' '.$texts['about'].' <a href="?view=show_full_user&action=show_full_user&user_id='.$ratings[$i]['about_id'].'&auction_id='.$ratings[$i]['auction_id'].'"  >'.$ratings[$i]["firstname"].' '.$ratings[$i]["lastname"].'</a> '.$texts['at'].' '.date("d.m.y", strtotime($ratings[$i]["date"]))); ?>
</div>
</div>
      <?

  }
?>

<div class="pagination">
  <ul>
<?
  $pages=(int)$ratings["number_of_rows"]/$GLOBALS["VIEHAUKTION"]["SMALLPAGEELEMENTS"]+1;
  $active=1;
if ($_REQUEST['page']!='') {
  $active=$_REQUEST['page'];
}
 for ($i=1; $i <= $pages; $i++) { 
  if($i==$active){
    echo('<li class="active"><a href="?view=profile&action=get_ratings_from&page='.$i.'#userdata"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=profile&action=get_ratings_from&page='.$i.'#userdata" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>

<?

}else{


  echo($texts['ratings_not_written']);
}

  ?>





</div>



</div>



<script type="text/javascript">

$('#ratingsnavigation a').click(function (e) {
  
  $(this).tab('show');

});

function showRatings(layer){

     

      $("#ratings .ratings_sublayer").hide();

      $("#ratings #ratings_"+layer).show();
  
}

</script>

