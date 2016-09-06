<html>
	<?php include "views/head.php";?>
	<body>
		<div class="titulo">
			<div></div>
			<div class="wrap">
				<h1>Titulo</h1>
			</div>
		</div>
		<div class="wrap">
			<nav class="meno">
				<ul>
					<li><a href="#">page1</a></li>
					<li><a href="#">page2</a></li>
					<li><a href="#">page3</a></li>
					<li><a href="#">page4</a></li>
					<li><a href="#">page5</a></li>
				</ul>
			</nav>
			<aside>
				<div>
					<form name="pesquisa" action="pesquisa.php" method="GET">
						<input type="text" name="busca">
						<input type="submit" value="">
					</form>
				</div>
				<article>
					<h1>Sobre</h1>
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
					</div>
					<div>
						<h1>Contatos</h1>
					</div>
					<div>
						<h1>Links</h1>
					</div>				
				</div>
				<div>
					<p>Desenvolvido para fins de estudo por ...</p>
				</div>
			</div>
		</footer>
	</body>
</html>