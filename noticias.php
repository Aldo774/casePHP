<section class="conteudo">
<?php

$limite = '0,3';


    $consulta = "SELECT 
        tb_publicacao.thumb, 
        tb_publicacao.titulo, 
        tb_publicacao.texto, 
        tb_categoria.nome, 
        tb_publicacao.id, 
        tb_publicacao.data 
        FROM tb_publicacao 
        INNER JOIN tb_categoria 
        ON (tb_publicacao.categoria = tb_categoria.id) 
        ORDER BY data desc 
        LIMIT $limite";

	$publicacoes = mysqli_query($conexao, $consulta) or die(mysql_error());
	if(@mysql_num_rows == '0'){
		echo "<h1>Não há publicãções disponíveis</h1>";
	}
	else{
		$path = "uploads/";
		while($res_publicacoes = mysqli_fetch_array($publicacoes)){
			$thumb = $res_publicacoes[0];
			$titulo = utf8_encode($res_publicacoes[1]);
			$texto = $res_publicacoes[2];
			$categoria = $res_publicacoes[3];
			$id = $res_publicacoes[4];
?>
	<article>
		<div>
			<a href="single.php?topico=<?php echo $id;?>"><h1><?php echo $titulo;?></h1></a>
			<img src="<?php echo $path.$categoria.'/'.$thumb?>">
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