<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Uploads de imagens com Ajax</title>
	<link rel="stylesheet" type="text/css" href="css/base.css">
</head>
<body>
	<header class="container">
		<h1 class="logo">Upload de imagens com Ajax</h1>
	</header>
	<main class="container siza padd-top">
		<section class="form-upload">
			<div class="content-upload">
				<form method="POST" id="form-upload">
					<input class="input" type="text" name="title" placeholder="Título">
					<input class="input" type="text" name="keyword" placeholder="Palavra-chave separado por virgula">
					<label class="label-img" for="file-img">Escolha sua imagem</label>
					<div class="prepare">
						<ul class="group-img">
							
						</ul>
						<div class="clear"></div>
					</div>
					<div class="progress">
						<div class="barra"></div>
					</div>
					<input type="file" id="file-img" multiple accept="image/*">
					<input class="label-img" type="submit" value="Enviar">
				</form>
			</div>
		</section>
		<section class="img-enviada">
		<?php
		require 'config.php';
			$img = new userImages();
			$images = $img->read(0,20);
			if($images):
				foreach($images as $image):
		?>
			<div class="content-img">
				<img src="upload/<?= $image['img_src'].'/mini-'.$image['img_nome'];  ?>" data-src="upload/<?= $image['img_src'].'/original-'.$image['img_nome'];  ?>" >		
			</div>
		<?php 
				endforeach;
			endif;
		 ?>
		</section>
	</main>
	<div class="clear"></div>
	<footer>
		<section class="footer">
			<p>&copy; Copyright 2015 - <?=date('Y');?> by Neylton Benjamim 
				<a href="https://www.facebook.com/neylton.benjamim" title="Facebook" target="_blank">Facebook </a>
			</p>
		</section>
	</footer>
<script type="text/javascript" async src="js/main.js"></script>
</body>
</html>