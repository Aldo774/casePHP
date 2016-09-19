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
			<section class="conteudo">
				<?php

				$busca = $_GET['busca'];

				$consulta = "SELECT
				        tb_publicacao.thumb, 
				        tb_publicacao.titulo, 
				        tb_publicacao.texto, 
				        tb_categoria.nome, 
				        tb_publicacao.data, 
	 			        tb_publicacao.autor, 
				        tb_publicacao.visitas, 
				        tb_publicacao.id 
				        FROM tb_publicacao 
				        INNER JOIN tb_categoria 
				        ON (tb_publicacao.categoria = tb_categoria.id) 
						where tb_publicacao.titulo LIKE '%$busca%'";

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
						$id = $res_noticias[7];
						$numero++;
				?>

				<article>
					<div>
						<a href="single.php?topico=<?php echo $id;?>"><h1><?php echo $titulo;?></h1></a>
						<img src="uploads/<?php echo $categoria.'/'.$thumb;?>">
					</div>
					<div>
						<p><?php echo $texto;?></p>
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