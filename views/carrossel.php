<article class="cont-carrossel">
	<h1>Destaque</h1>
	<div class="box-carrossel">
        <div class="nav back"><p>&laquo;</p></div>
        <ul class="carrossel">

<?php

$limite = '3,5';

    $consulta = "SELECT 
        tb_publicacao.thumb, 
        tb_publicacao.titulo, 
        tb_categoria.nome, 
        tb_publicacao.id 
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
			$categoria = $res_publicacoes[2];
			$id = $res_publicacoes[3];
?>
			<a href="single.php?topico=<?php echo $id;?>">
	            <li class="item"><img src="<?php echo $path.$categoria.'/'.$thumb?>" alt="<?php echo $titulo;?>" title="<?php echo $titulo;?>"/>
	            	<h1><?php echo $titulo;?></h1>
	            	<div></div>
	            </li>
	        </a>

<?php
	}
}
?>
        </ul>
        <div class="nav forth"><p>&raquo;</p></div>
        <div class="clear"></div>
    </div>
</article>
