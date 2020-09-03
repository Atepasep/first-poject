<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?= 'assets/images/favicon.png' ?>">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Halaman tidak Ditemukan</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="<?= 'assets/css/style-error.css' ?>" />
</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>Db Error</h1>
			</div>
			<h2>Ada Error Fungsi Database</h2>
			<p>Hubungi administrator Website</p>
			<a href="<?= config_item('base_url') ?>">Kembali ke Dashboard</a><br>
			<div style="font-size: 8px; margin-top: 15px;">
			<?php 
			 $filename = "assets/error/error_".date('dmYHis').".txt";
			 $content = $heading."\n\n".$message; //file_get_contents($filename);
			 file_put_contents($filename, $content, LOCK_EX);
			?>
			</div>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
