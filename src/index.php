<!Doctype html>
<html>
  <title>Welcome Page </title>
  <link href="style/style.css?=time()" rel="stylesheet" type="text/css">
  <link href="style/style1.css?=time()" rel="stylesheet" type="text/css">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="style/style1.css?<?php echo time(); ?>">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>

<header>
	<!-- Navbar -->
	<ul>
		<li><a href="pages/about.html">About Us</a></li>
		<li><a href="index.php">Home</a></li>
		<li style="float:right"><a class="active1" href="pages/login.php">Login</a></li>
	  </ul>
</header>
<body>

<!-- Slideshow container -->
<div class="slideshow-container">

	<!-- Full-width images -->
	<div class="mySlides fade">
	  <img src="images/coffee1.jpeg" style="width:100%; opacity:0.75">
	  <img src="images/OverseerTransparent.png" class="imtip" style="width:25%">
	</div>
  
	<div class="mySlides fade">
	  <img src="images/coffee2.jpeg" style="width:100%; opacity:0.75">
	  <img src="images/OverseerTransparent.png" class="imtip" style="width:25%">
	</div>
  
	<div class="mySlides fade">
	  <img src="images/coffee12.jpeg" style="width:100%; opacity:0.75">
	  <img src="images/OverseerTransparent.png" class="imtip" style="width:25%">
	</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 5000); // Change image every 5 seconds
}
</script>

<div class="footer">
	<p>&#169 2021 Overseer</p>
</div>

</body>
</html>
