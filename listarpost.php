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
                    <h1>
                        <span>Titulo</span>
                        <span>Data</span>
                        <span>Categoria</span>
                        <span>Excluir</span>
                        <span>Editar</span>
                    </h1>

<?php

    $consulta = "Select 
        titulo, 
        categoria,
        Data,
        id
        from tb_publicacao";

    $publicacoes = mysqli_query($conexao, $consulta) or die(mysql_error());
    if(@mysql_num_rows == '0'){
        echo "<h1>Não há publicãções disponíveis</h1>";
    }
    else{
        while($res_publicacoes = mysqli_fetch_array($publicacoes)){
            $titulo = utf8_encode($res_publicacoes[0]);
            $categoria = $res_publicacoes[1];
            $data = $res_publicacoes[2];
            $id = $res_publicacoes[3];
?>

                    <div>
                        <span><?php echo $titulo;?></span>
                        <span><?php echo date('d/m/y', strtotime($data));?></span>
                        <span><?php echo $categoria;?></span>
                        <form method="post" action="editPub.php">
                            <input type="hidden" value="<?php echo $id;?>">
                            <input type="submit" value="">
                        </form>
                        <form method="post" action="excluirPub.php">
                            <input type="hidden" value="<?php echo $id;?>">
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