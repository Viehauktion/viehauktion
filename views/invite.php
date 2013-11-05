<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Willkommen auf Viehauktion.com</title>
   <meta name="keywords" content="<? echo($texts["Page_Keywords"]);?>" />
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" type="text/css" />
         <link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/apple-touch-icon-ipad-retina.png">
          <link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/apple-touch-icon-iphone-retina.png">
           <link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/apple-touch-icon-ipad.png">
             <link rel="apple-touch-icon-precomposed" href="assets/apple-touch-icon-iphone.png">
            <link rel="shortcut icon" href="assets/favicon.png">
        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
       <script src="js/main.js"></script>

</head>
<style type="text/css">

#background-image{
background-repeat: no-repeat;
background-size: 100% auto;
background-image: url("assets/start.jpg");
min-width: 1000px;
}
#centerBox{
	position: absolute;
	width: 700px;
	height: 250px;
	top:30%;
	left:50%;
	margin-left: -250px;
	margin-top: -75px;
  font-size: 18px;
	
	background-color: white;
border: 1px solid #8F8F8F;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;

padding: 50px;
color: #3e937e;


}

h1{
    color: #525252;
}
</style>
<body>

<div id="background-image" style="height: 100%; width: 100%; overflow: hidden; position: fixed; top: 50px; left: 0px;"> 
</div>

  <div id="centerBox">
  	<h1><img src="assets/apple-touch-icon-iphone-retina.png" style="height:100px" />Willkommen auf Viehauktion.com</h1>
	<br/>
  Bitte geben Sie Ihren Einladungscode ein:
		<br/><br/>

  	<form class="form-inline" >
	<input type="hidden" name="action" value="check_code" /> 
  <input type="text" class="input" name="invite_code" placeholder="Einladungscode">
  <button type="submit" class="btn btn-primary">absenden</button><br/><br/>
  <a href="#contactModal" class="footerBtn"  role="button"  data-toggle="modal">Einladungscode beantragen.</a>
 
</form>


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