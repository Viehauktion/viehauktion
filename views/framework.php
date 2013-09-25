<!DOCTYPE html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><? echo($texts["Page_Title"]);?></title>
    <meta name="keywords" content="<? echo($texts["Page_Keywords"]);?>" />
    <link rel="stylesheet" href="css/bootstrap.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" media="screen" type="text/css" />
<!-- SCRIPTS BELONG TO THE BOTTOM OF THE PAGE!!! -->    


  </head>
  <body>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script src="js/main.js"></script>

    <div class="masthead">
      <div class="container">
        <div class="row">
          <div class="span6">
            <a href="./" id="logo"><img src="./assets/logo.png" alt="Weser-Ems Schwein Logo" title="Weser-Ems Schwein / Ihre Schweinebörse"></a>
          </div>
          <div class="span6">
            <? include("signin.php") ?>
          </div>
        </div>
      </div>
    </div>

    <div class="navigation">
      <div class="container">
        <div class="row">
          <? include("navigation.php") ?>
        </div>
      </div>
    </div>

    <div class="page">
      <div class="container">
      <? if($View!=="home") { ?>
        <div class="row">
          <div class="span12">
            <ul class="breadcrumb">
<?

for($i=0; $i<count($breadcrumb);$i++){
    if($i<count($breadcrumb)-1){
     echo('<li><a href="?view='.$breadlinks[$i].'">'.$breadcrumb[$i].'</a> <span class="divider"><i class="icon-angle-right"></i></span></li>');
    }else{
    echo('<li class="active">'.$breadcrumb[$i].'</li>');
    }
}

?>

            </ul>
          </div>
        </div>
      <? } ?>

        <? include($View.".php") ?>
      </div>
    </div>

    <div id="footer">
      <div class="container">	
        <? include("footer.php") ?>
      </div>
    </div>
    <? include("modals.php") ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44199305-1', 'viehauktion.com');
  ga('send', 'pageview');

</script>


    
    
  </body>
</html>