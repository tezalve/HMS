<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" media="screen" href="/css/bootstrap.min.css">
	<script src="/js/jquery.js"></script>
	<style>
	.login-card {
	  padding: 20px;
	  width: 400px;
	  background-color: #F7F7F7;
	  margin: 0 auto 10px;
	  border-radius: 2px;
	  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	  overflow: hidden;
	}
	/* enable absolute positioning */
	.inner-addon { 
	    position: relative; 
	}

	/* style icon */
	.inner-addon .glyphicon {
	  position: absolute;
	  padding: 10px;
	  pointer-events: none;
	}

	/* align icon */
	.left-addon .glyphicon  { left:  0px;}
	.right-addon .glyphicon { right: 0px;}

	/* add padding  */
	.left-addon input  { padding-left:  30px; }
	.right-addon input { padding-right: 30px; }
</style>
	<script src="/js/bootstrap.min.js"></script>
	<title>HMS</title>
</head>
<body>
	@yield('branding')
	@yield('login')
	<!-- #page>div.logo+ul#navigation>li*5>a{Item $} -->

</body>
</html>