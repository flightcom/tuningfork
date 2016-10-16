<!doctype html>
<html lang="fr">
<head>
		<link href="<?php echo (CSS_FILE); ?>" rel="stylesheet" type="text/css"></script>
		<title>404 Page introuvable</title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
	text-align: center;
}

#container {
	top: 50%;
	margin: 0 auto;
	margin-top: 100px;
}

.forbidden-outer {
	border-radius: 100%;
	background: red;
	width: 200px;
	height: 200px;
	display: inline-block;
	position: relative;
}

.forbidden-inner {
	position: absolute;
	height: 40px;
	width: 150px;
	margin: 0 auto;
	background: white;
	top: 50%;
	margin-top: -20px;
	left: 50%;
	margin-left: -75px;
}

p {
	padding: 0 0 20px 0;
	font-size: 13px;
}


</style>
</head>
<body>

	<div id="container">
		<div>
			<div class="forbidden-outer">
				<div class="forbidden-inner"></div>
			</div>
		</div>
		<h1>Vous faîtes fausse route !</h1>
		<p>La page que vous demandez n'existe pas</p>
		<button class="btn btn-primary" onclick="history.go(-1);">Retour au site</button>
	</div>

</body>
</html>