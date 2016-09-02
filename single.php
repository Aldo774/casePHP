<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/lib/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="js/script/carroussel.js"></script>
		<?php

			mb_internal_encoding("UTF-8"); 
			mb_http_output( "iso-8859-1" );  
			ob_start("mb_output_handler");   
			header("Content-Type: text/html; charset=ISO-8859-1",true);

			include "connections/config.php";
			$conexao = mysqli_connect("$hostname_config", "$username_config", "$password_config", "$database_config")
			or die(mysql_error("Erro ao acessar base de dados"));

		?>
		<title>HOME</title>
	</head>
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

				$topico = $_GET['topico'];

				$consulta = "SELECT
						thumb,
						titulo,
						texto,
						categoria,
						'data',
						autor,
						visitas
						FROM tb_publicacao
						where id = '$topico'";

				$noticias = mysqli_query($conexao, $consulta)
						or die(mysqli_error());
				if(@mysqli_num_rows($noticias) <= '0'){

					echo "Publicação Inexistente";
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
						<h1><?php echo $titulo;?></h1>
						<p><?php echo $texto; echo $visitas;?></p>
					</div>
				</article>

			<?php
				}

				$up_visitas = $visitas + 1;
				$add_visitas = mysqli_query($conexao, "UPDATE tb_publicacao SET visitas = '$up_visitas' WHERE id = '$topico'")
				or die(mysqli_error(""));
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