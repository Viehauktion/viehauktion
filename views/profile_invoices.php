




<div id="invoices_layer"  class="sublayer hide"> 
      <h2><? echo($texts['profile_my_invoices']); ?></h2>
      
     
      <?

$invoices=$gBase->UserInvoices;
$counter=0;
if(count($invoices)>1){

?>

   <table class="table table-striped">
    <tr>
      <td><? echo($texts['invoice_date']); ?></td>
      <td><? echo($texts['invoice_number']); ?></td>
      <td><? echo($texts['invoice_type']); ?></td>
      <td><? echo($texts['invoice_total']); ?></td>
      <td></td>
   
    </tr>

<?
  for($i=0; $i<count($invoices)-1; $i++){
 
?>

<tr>
  <td><? echo(date("d.m.Y", strtotime($invoices[$i]["date"]))); ?></td>
  <td><? echo($invoices[$i]["invoice_number"]); ?></td>
  <td><? 
  if($invoices[$i]['type']=='provision'){
  echo($texts["invoice_provision"]); 
}else{
 echo($texts["invoice_storno"]); 
}
?>
</td>
  <td><? echo(formatPrice($invoices[$i]["total"])); ?></td>
  <td> <a href="?action=get_invoice&invoice_id=<? echo($invoices[$i]["invoice_number"]); ?>" class="btn" type="button" target="_blank"  ><?  echo($texts['profile_get_invoice']); ?></a></td>
 
</tr>

  <?

  }

?>

</table>

<div class="pagination">
  <ul>
<?
  $pages=(int)$invoices["number_of_rows"]/$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]+1;
  $active=1;
if ($_REQUEST['page']!='') {
  $active=$_REQUEST['page'];
}
 for ($i=1; $i <= $pages; $i++) { 
  if($i==$active){
    echo('<li class="active"><a href="?view=profile&action=get_user_invoices&page='.$i.'#invoices"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=profile&action=get_user_invoices&page='.$i.'#invoices" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>


<?


}else{
   echo($texts['profile_no_invoice']);
  
  }


?>
  