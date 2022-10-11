<!DOCTYPE html>
<html lang="en">
   	<head>
   		<script type="text/javascript">
	        function preventBack() { window.history.forward(); }
	        setTimeout("preventBack()", 0);
	        window.onunload = function () { null };
	    </script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>ICU On Wheels | Login</title>
        <link rel="icon" type="image/ico" href="images/icon.png" />
        <meta name="description" content="ICU On Wheels Login Form" />
        <meta name="keywords" content="Hospital, ICU On Wheels, login" />
        <meta name="author" content="Aakruti Ambasana" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.63321.js"></script>
		<style>	
			@import url(http://fonts.googleapis.com/css?family=Montserrat:400,700|Handlee);
			body {
				/*background: #eedfcc url(images/3.jpg) no-repeat center top;*/
				background-image:url(images/3.jpg);
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #FFFFFF;
				text-shadow: 0 1px 1px rgba(0,0,0,0.5);
			}
			h2{
				text-shadow:0 1px 1px rgba(0,0,0,0.5);}
			a:hover{
				color:#FF0000;
				text-decoration:underline;
			}
		</style>
    </head>
    <body>
    	<script type="text/javascript">
	        function preventBack() { window.history.forward(); }
	        setTimeout("preventBack()", 0);
	        window.onunload = function () { null };
	    </script>
        <div class="container">
			<header>
				<h1>Hospital Login</h1>
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
			</header>
			<section class="main">
				<form class="form-5 clearfix" action="login_ins.php" method="post">
				    <p>
				        <input type="text" id="login" name="user" placeholder="Username" required="">
				        <input type="password" name="pwd" id="password" placeholder="Password" required=""> 
				    </p>
				    <button type="submit" name="submit">
				    	<i class="icon-arrow-right"></i>
				    	<span>Sign in</span>
				    </button>  
				</form>
				<center>
					<h2><a href="Password.php">Forget Password ? </a></h2>
					<h2><a href="../Registration.php">Create an new account</a></h2>   
				</center>
			</section>
        </div>
		<!-- jQuery if needed -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$('input, textarea').placeholder();
			});
		</script>
    </body>
</html>