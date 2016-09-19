<html>
<?php
    include "views/headPainel.php"; 
?>
    <body>
        <div class="Admin">

            <?php include"views/painelAdmin.php";?>

            <section class="contentAdmin">
                <h1>Listar Categorias</h1>

                <article class="listarCat">
<?php
    if(isset($_GET['sit'])){
        if ($_GET['sit'] == 'okexc') {
            echo "<h1 class='ok'>Categoria excluida com sucesso</h1>";
        }
        elseif ($_GET['sit'] == 'erroexc'){
            echo "<h1 class='error'>Falha ao excluir Categoria</h1>";
        }
    }
?>
                    <h1>
                        <span>Nome da Categoria</span>
                        <span>Editar</span>
                        <span>Excluir</span>
                    </h1>

<?php

    $consulta = "SELECT nome, id 
                    from tb_categoria 
                    ORDER BY id desc";
        
    $categorias = mysqli_query($conexao, $consulta) or die(mysql_error());

    if(@mysql_num_rows == '0'){
        echo "<h1>Não há categorias disponíveis</h1>";
    }
    else{
        while($res_categorias = mysqli_fetch_array($categorias)){
            $nome = utf8_encode($res_categorias[0]);
            $id = $res_categorias[1];
?>

                    <div>
                        <span><?php echo $nome;?></span>
                        <form method="post" action="painelccat.php">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="acao" value="editar">
                            <input type="submit" value="">
                        </form>
                        <form method="post" action="controllerCat.php">
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