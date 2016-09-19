<html>
<?php
    include "views/headPainel.php"; 
?>
    <body>
        <div class="Admin">

            <?php include"views/painelAdmin.php";?>

            <section class="contentAdmin">
                <h1>Listar Publicações</h1>

                <article class="listarPubs">
<?php
    if(isset($_GET['sit'])){
        if ($_GET['sit'] == 'okexc') {
            echo "<h1 class='ok'>Publicação excluida com sucesso</h1>";
        }
        elseif ($_GET['sit'] == 'erroexc'){
            echo "<h1 class='error'>Falha ao excluir publicação</h1>";
        }
    }
?>
                    <h1>
                        <span>Titulo</span>
                        <span>Data</span>
                        <span>Categoria</span>
                        <span>Editar</span>
                        <span>Excluir</span>
                    </h1>

<?php

    $consulta = "SELECT 
        tb_publicacao.titulo, 
        tb_categoria.nome, 
        tb_categoria.id, 
        tb_publicacao.Data, 
        tb_publicacao.id 
        from tb_publicacao INNER JOIN 
        tb_categoria ON 
        (tb_publicacao.categoria = tb_categoria.id) 
        ORDER BY data desc";

    $publicacoes = mysqli_query($conexao, $consulta) or die(mysql_error());
    if(@mysql_num_rows == '0'){
        echo "<h1>Não há publicãções disponíveis</h1>";
    }
    else{
        while($res_publicacoes = mysqli_fetch_array($publicacoes)){
            $titulo = utf8_encode($res_publicacoes[0]);
            $categoria = $res_publicacoes[1];
            $categoria_id = $res_publicacoes[2];
            $data = $res_publicacoes[3];
            $id = $res_publicacoes[4];
?>

                    <div>
                        <span><?php echo $titulo;?></span>
                        <span><?php echo date('d/m/y', strtotime($data));?></span>
                        <span><?php echo $categoria;?></span>
                        <form method="post" action="painelcpost.php">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="acao" value="editar">
                            <input type="submit" value="">
                        </form>
                        <form method="post" action="controllerPub.php">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="submit" value="">
                        </form>
                    </div>
<?php
    }
}
?>
                </article>
            </section>
        </div>
    </body>
</html>