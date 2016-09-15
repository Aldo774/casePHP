<html>
<?php
    include "views/headPainel.php"; 
?>
    <body>
        <div class="Admin">
            <?php include"views/painelAdmin.php";?>

            <section class="contentAdmin">

<?php
/*----------------------------------------------------------------*/
/*------------------------PAGINA P/ EDIÇÃO------------------------*/

if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {

    $id = $_POST['id'];

    $consulta = "SELECT 
        id,
        nome
        from tb_categoria 
        WHERE id = '$id'";

    $cat = mysqli_query($conexao, $consulta) or die(mysql_error());
    if(@mysql_num_rows == '0'){
        echo "<h1>Categoria inexistente</h1>";
    }
    else{
        while($res_cat = mysqli_fetch_array($cat)){
            $id = $res_cat[0];
            $nome = $res_cat[1];
?>

                <h1>Editar Pagina</h1>
                <article class="cadcat">

<?php

    if(isset($_GET['sit'])){
        if ($_GET['sit'] == 'ok') {
            echo "<h1 class='ok'>Categoria cadastrada com sucesso</h1>";
        }
        else{
            echo "<h1 class='error'>Falha ao cadastrar categoria</h1>";
        }
    }

?>

                    <form action="controllerCat.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <label>Nome da categoria</label>
                        <input type="text" name="nome" value="<?php echo $nome;?>"/>
                        <input type="submit" value="Atualizar"/>
                    </form>
<?php

        }

    }

}    
else{

/*----------------------------------------------------------------*/
/*------------------------PAGINA P/ CADASTRO----------------------*/

?>

                <h1>Cadastro de Pagina</h1>
                <article class="cadcat">

<?php

    if(isset($_GET['sit'])){
        if ($_GET['sit'] == 'ok') {
            echo "<h1 class='ok'>Categoria cadastrada com sucesso</h1>";
        }
        else{
            echo "<h1 class='error'>Falha ao cadastrar categoria</h1>";
        }
    }

?>

                    <form action="controllerCat.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acao" value="cadastrar">
                        <label>Nome da categoria</label>
                        <input type="text" name="nome"/>
                        <input type="submit" value="Cadastrar"/>
                    </form>
<?php 
}
?>
                </article>
            </section>
        </div>
    </body>
</html>