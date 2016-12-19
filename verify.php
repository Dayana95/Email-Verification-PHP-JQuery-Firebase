<!doctype html>
<html lang="en" class="has-pattern">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Shimmy App</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
        <meta name="HandheldFriendly" content="true">
        <meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=0.9, user-scalable=no, target-densitydpi=device-dpi">
		<script src="javascript/head.js"></script>
		<link rel="stylesheet" media="screen" href="styles/screen.css">
		<link rel="stylesheet" media="print" href="styles/print.css">
		<link rel="icon" type="image/x-icon" href="images/sqwad-icons.png">
			<script type="text/javascript" src="firebase.js"></script>

	</head>
	<body>
	<?php 
if (isset($_GET)) {

	if (isset($_GET['email']) && isset($_GET['code'])) {
		$email =  $_GET['email'];
		$code = $_GET['code'];
		?>
		<script>
			var dbRef = new Firebase("https://sqwad-app.firebaseio.com/");
            var usersRef = dbRef.child('users');
            var	emailSqwad = "<?php echo $email; ?>";
            var code = "<?php echo $code; ?>";

              usersRef.orderByChild('verification_code').equalTo(code).once('value', function(snapvideo){
                                          if(snapvideo.val() === 'undefined' || snapvideo.val() === null){
                                                  console.log("Ha occurido un error!");
                                              }
                                              else{
                                                   snapvideo.forEach(function(childsnaphot){
                                                        console.log("KEY", childsnaphot.key());
                                                    var key = childsnaphot.key();

                                                     usersRef.child(key).update({
                                                  		verified: 'true'
                                                  })

                                                     usersRef.child(key).child('verification_code').remove();
                                                  })

                                              }

              })
		</script>

		<?php
	}
}


 ?>
		<div id="root">
			<header id="top">
				<h1><a href="#" accesskey="h"><img src="images/sqwad-logo.png" alt="SqwadApp Logo" width="257" ></a></h1>
				<nav id="skip">
					<ul>
						<li><a href="#nav" accesskey="n">Skip to navigation (n)</a></li>
						<li><a href="#content" accesskey="c">Skip to content (c)</a></li>
						<li><a href="#footer" accesskey="f">Skip to footer (f)</a></li>
					</ul>
				</nav>
				<nav id="nav">
					<ul>
						<li><a accesskey="1" href="index.html">Home</a> <em>(1)</em></li>
						<li><a accesskey="2" href="#content">About</a> <em>(2)</em>
						
						</li>
					<!--	<li><a accesskey="3" href="blog.html">Blog</a> <em>(3)</em></li> -->
						<li><a accesskey="4" href="#request">Request Video</a> <em>(4)</em></li>
						<li><a accesskey="5" href="#contact">Contact</a> <em>(5)</em></li>
						<li class="a"><a accesskey="6" href="http://sqwad.senorcoders.com:3333/">Webapp</a> <em>(6)</em></li>
					</ul>
				</nav>
			</header> 
			<article id="welcome">
				<h1 style="text-align: center !important;">Thank you!</h1>
			</article>
			
			<footer id="footer">
				<figure><img src="images/sqwad-logo.png" alt="Placeholder" width="174" height="55"></figure>
				<h3>Follow us</h3>
				<ul class="social-a">
					
					<li class="fb"><a rel="external" href="./">Facebook</a></li>
					<li class="tw"><a rel="external" href="./">Twitter</a></li>
					<li class="in"><a rel="external" href="./">Instagram</a></li>
				</ul>
				<ul class="download-a">
					<li class="as"><a rel="external" href="./">Download on the App Store</a></li>
					<li class="gp"><a rel="external" href="./">Get it on Google Play</a></li>
				</ul>
				<p>&copy; <span class="date">2015</span> Shimmy App. All rights reserved. <a href="./">Privacy Policy</a> <a href="./">Terms of Service</a></p>
			</footer>
		</div>
        <script>
            head.load('javascript/jquery.js','javascript/tf.js','javascript/scripts.js','javascript/mobile.js')
        </script>
	</body>
</html>
