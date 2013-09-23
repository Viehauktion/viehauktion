<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><? echo($texts["Page_Title"]);?></title>
   <meta name="keywords" content="<? echo($texts["Page_Keywords"]);?>" />
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" type="text/css" />
     
        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
       <script src="js/main.js"></script>

</head>
<body>
<div class="masthead">
<div class="container">

	<a href="/"><img src="/assets/logo.png" alt="REBELLE Logo" title="REBELLE"></a>
<? include("signin.php") ?>
</div>
</div>

<div class="navigation">
<div class="container">
<? include("navigation.php") ?>
</div>
</div>
<div class="page">
<div class="container">
<? include($View.".php") ?>
</div>
</div>

<div id="footer">
<div class="container">	
<? include("footer.php") ?>
<? include("modals.php") ?>
</div>
</div>


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