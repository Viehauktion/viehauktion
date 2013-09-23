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
<style type="text/css">

#background-image{
background-repeat: no-repeat;
background-size: 100% auto;
background-image: url("assets/invite.jpg");
min-width: 1000px;
}
#centerBox{
	position: absolute;
	width: 500px;
	height: 150px;
	top:30%;
	left:50%;
	margin-left: -250px;
	margin-top: -75px;
	
	background-color: white;
border: 1px solid #8F8F8F;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
filter: alpha(opacity=90);
-khtml-opacity: 0.9;
-moz-opacity: 0.9;
opacity: 0.9;
padding: 50px;
color: #3e937e;


}
</style>
<body>

<div id="background-image" style="height: 100%; width: 100%; overflow: hidden; position: fixed; top: 30px; left: 0px;"> 
</div>

  <div id="centerBox">
  	<h2>Weser-Ems-Schwein.de</h2>
	Bitte geben Sie Ihren Einladungscode ein:
		<br/>

  	<form class="form-inline" >
	<input type="hidden" name="action" value="check_code" /> 
  <input type="text" class="input" name="invite_code" placeholder="Einladungscode">
  <button type="submit" class="btn">absenden</button><br/><br/>
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