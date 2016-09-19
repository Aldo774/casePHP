<html>
	<?php include "views/head.php";?>
	<body>
		<div class="titulo">
			<div></div>
			<div class="wrap">
				<img src="img/monk-logo.png">
				<h1>O PRIMATA BOLADO</h1>
			</div>
		</div>
		<nav class="meno">
			<div class="wrap">
				<ul>
					<li><a href="#">HOME</a></li>
					<li><a href="#">NOTICIAS</a></li>
					<li><a href="#">SOBRE</a></li>
					<li><a href="#">CONTATO</a></li>
				</ul>
			</div>
		</nav>
		<div class="wrap">
			<aside class="asideHome">
				<article>
					<h1>Pesquisar</h1>
					<div>
						<form name="pesquisa" action="pesquisa.php" method="GET">
							<input type="text" name="busca">
							<input type="submit" value="">
						</form>
					</div>
				</article>
				<article>
					<h1>Midia</h1>
				</article>
				<?php 
					include "views/carrossel.php";
				?>
				<article>
					<h1>Rede</h1>
				</article>
			</aside>
		<?php include"noticias.php";?>			
		</div>
		<footer>
			<div class="wrap">
				<div>
					<div>
						<h1>Logo</h1>
						<img src="img/monk-logo-B.png">
					</div>
					<div>
						<h1>Links</h1>
						<a href="#">HOME</a>
						<a href="#">NOTICIAS</a>
						<a href="#">SOBRE</a>
						<a href="#">CONTATO</a>
					</div>
					<div>
						<h1>Contatos</h1>
						<p><b>Email</b>: soares_aldo@hotmail.com</p>
						<p><b>Tel</b>: (17)98195-1045</p>
						<a href="http://www.facebook.com/aldo.santossoares" target="_blank"><img src="img/facebook.png"></a>
						<a href="https://br.linkedin.com/in/soaresaldo" target="_blank"><img src="img/linkedin.png"></a>
						<a href="https://github.com/Aldo774" target="_blank"><img src="img/github.png"></a>
					</div>
				</div>
			</div>
			<div>
				<div class="wrap">
					<p>Desenvolvido para fins de estudo por Aldo dos Santos Soares</p>
				</div>
			</div>
		</footer>
	</body>
</html>