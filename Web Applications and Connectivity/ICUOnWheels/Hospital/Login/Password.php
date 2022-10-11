<html>
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>ICU On Wheels | Forget Password</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Krishna" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script type="text/javascript">
        	/*function userdiv() 
        	{
        		var uname = prompt("Please enter your username for security question");
				if (uname == null || uname == "") {
	    			document.getElementById("sec_question").innerHTML="You haven't entered username.<br>Sorry";
	    			document.getElementById("user").disabled=true;
	    			document.getElementById("ans").disabled=true;
				} 
				else {
					document.getElementById("user").value=uname;
				}
        	}*/
        </script>
		<script src="js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>	
			@import url(http://fonts.googleapis.com/css?family=Montserrat:400,700|Handlee);
			body {
				background: #eedfcc url(images/3.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.5);
			}
			h2{
				color: #283abc;
				text-shadow:0 1px 1px rgba(0,0,0,0.3);
			}
		</style>
    </head>
    <body>
        <div class="container">
			<header>
				<h1>OOPs !!! Forget Password</h1>
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
			</header>
			
			<section class="main">
				<form class="form-5 clearfix" action="View_Password.php" method="post">
					<p>
					<input type="text" name="user" placeholder="Username" required >
				   	<input type="text" name="emailid" placeholder="Email ID" required >
				   	</p>
				    <button type="submit" name="submit">
				    	<i class="icon-arrow-right"></i>
				    	<span>Done</span>
				    </button>  
				</form>
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