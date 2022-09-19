<?php 
$baseUrl = "http://".$_SERVER["HTTP_HOST"];
$pieces = explode("/",$_SERVER['REQUEST_URI']);
$projectName = $pieces[1];
unset($pieces[0], $pieces[1]);
$userRequest = implode("/", $pieces);
// create the path to different files:
$cssPath = "{$baseUrl}/{$projectName}/cathywebsite/wp-content/themes/cathywebsite/css/error.css";
$jsPath = "{$baseUrl}/{$projectName}/cathywebsite/wp-content/themes/cathywebsite/js/main.js";
$imagePath = "{$baseUrl}/{$projectName}/cathywebsite/wp-content/themes/cathywebsite/images/";
$homePath = "{$baseUrl}/{$projectName}/cathywebsite/wp-content/themes/cathywebsite/index.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- link to logo as tag image -->
   <link rel="icon" type="image/png" href="<?php bloginfo( 'template_url' ); ?>/images/core-image/logo.png">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/error.css">
  <title>Page Not Found/Blog</title>
</head>
<body>
	<div class="container grid-container">	
		<p class="text grid-item">
			Link broken, <br><span class="highlight"><?php echo home_url().$_SERVER['REQUEST_URI']; ?><br>Page is not found.</span></p>
		<div class="count-center grid-item">
			<div class="counter" data-count="404">0</div>
		</div>
		<div class="margin-b grid-item">
			<img src="<?php bloginfo( 'template_url' ); ?>/images/broken_world.jpg" alt="Broken World" class="nolazyload">
		</div>
		<h3 class="grid-item">
			Please go back to the <a href="<?php bloginfo('url'); ?>">HOME</a> page. 
		</h3>					
	</div><!-- end of container -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/main.js"></script>
</body>
</html>