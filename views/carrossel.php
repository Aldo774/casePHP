<article class="cont-carrossel">
	<div class="box-carrossel">
        <div class="nav back"><p>&laquo;</p></div>
        <ul class="carrossel">

<?php

$limite = '3,5';

	$consulta = "Select 
		thumb, 
		titulo
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
?>

            <li class="item"><img src="<?php echo $path; echo $thumb;?>" alt="<?php echo $titulo;?>" title="<?php echo $titulo;?>"/><h1><?php echo $titulo;?></h1></li>

<?php
	}
}
?>
        </ul>
        <div class="nav forth"><p>&raquo;</p></div>
        <div class="clear"></div>
    </div>
</article>
