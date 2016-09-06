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
					<li><a href="index.php">page1</a></li>
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
			<section class="conteudo">
				<?php

				$busca = $_GET['busca'];

				$consulta = "SELECT
						thumb,
						titulo,
						texto,
						categoria,
						'data',
						autor,
						visitas
						FROM tb_publicacao
						where titulo LIKE '%$busca%'";

				$noticias = mysqli_query($conexao, $consulta)
						or die(mysqli_error());
				if(@mysqli_num_rows($noticias) <= '0'){

					echo "<h1>Busca sem Resultados</h1>";
				}else{

					$path = "uploads/publicacoes/imagens/";

					$numero = '0';


					while ($res_noticias = mysqli_fetch_array($noticias)) {
						
						$thumb = $res_noticias[0];
						$titulo = utf8_encode($res_noticias[1]);
						$texto = $res_noticias[2];
						$categoria = $res_noticias[3];
						$data = $res_noticias[4];
						$autor = $res_noticias[5];
						$visitas = $res_noticias[6];
						$numero++;
				?>

				<article>
					<div>
						<img src="<?php echo $path; echo $thumb;?>">
					</div>
					<div>
						<a href="single.php?topico=<?php echo $id;?>"><h1><?php echo $titulo;?></h1></a>
						<p><?php echo $texto; echo $visitas;?></p>
					</div>
				</article>

			<?php
				}
			}
			?>
			</section>

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