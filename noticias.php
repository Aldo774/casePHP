<section class="conteudo">
<?php

$limite = '0,3';

	$consulta = "Select 
		thumb, 
		titulo, 
		texto, 
		categoria,
		id
		from tb_publicacao 
		LIMIT $limite";

	$publicacoes = mysqli_query($conexao, $consulta) or die(mysql_error());
	if(@mysql_num_rows == '0'){
		echo "<h1>Não há publicãções disponíveis</h1>";
	}
	else{
		$path = "uploads/publicacoes/imagens/";
		while($res_publicacoes = mysqli_fetch_array($publicacoes)){
			$thumb = $res_publicacoes[0];
			$titulo = utf8_encode($res_publicacoes[1]);
			$texto = $res_publicacoes[2];
			$categoria = $res_publicacoes[3];
			$id = $res_publicacoes[4];
?>
	<article>
		<div>
			<img src="<?php echo $path; echo $thumb;?>">
		</div>
		<div>
			<a href="single.php?topico=<?php echo $id;?>"><h1><?php echo $titulo;?></h1></a>
			<p><?php echo $texto;?></p>
		</div>
	</article>
<?php
	}
}
?>
</section>