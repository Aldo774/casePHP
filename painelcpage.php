<html>
<?php
    include "views/headPainel.php"; 
?>
    <body>
        <div class="Admin">
            <?php include"views/painelAdmin.php";?>

            <section class="contentAdmin">

<?php
    $query_p = "SELECT pagina, id from tb_page";
    $consulta_page = mysqli_query($conexao, $query_p) or die(mysql_error());

/*----------------------------------------------------------------*/
/*------------------------PAGINA P/ EDIÇÃO------------------------*/

if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {

    $id = $_POST['pagina'];

    $consulta = "SELECT 
        id,
        pagina, 
        conteudo
        from tb_page 
        WHERE id = '$id'";

    $page = mysqli_query($conexao, $consulta) or die(mysql_error());
    if(@mysql_num_rows == '0'){
        echo "<h1>Pagina inexistente</h1>";
    }
    else{
        while($res_page = mysqli_fetch_array($page)){
            $id = $res_page[0];
            $pagina = $res_page[1];
            $conteudo = utf8_encode($res_page[2]);
?>

                <h1>Editar Pagina</h1>

                <form action="painelcpage.php" method="post">
                    <input type="hidden" name="acao" value="editar">
                    <label>PAGINA</label>
                    <select name="pagina">

    <?php
        if(@mysqli_num_rows($consulta_page) <= '0'){
            echo '<option></option>';
        }
        else{
            echo '<option value="'.$pagina.'">'.$pagina.'</option>';
            while ($resultado_page = mysqli_fetch_assoc($consulta_page)) {
                echo "<option value='".$resultado_page['id']."'>".$resultado_page['nome']."</option>";
            }
        }
    ?>
                        <input type="submit" value="Editar">
                    </select>
                </form>

                <article class="cadpage">

<?php

    if(isset($_GET['sit'])){
        if ($_GET['sit'] == 'ok') {
            echo "<h1 class='ok'>Publicação cadastrada com sucesso</h1>";
        }
        else{
            echo "<h1 class='error'>Falha ao cadastrar publicação</h1>";
        }
    }

?>

                    <form action="controllerPage.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <label>Titulo da pagina</label>
                        <input type="text" name="pagina" value="<?php echo $pagina;?>"/>
                        <label>Conteúdo</label>
                        <textarea name="conteudo"><?php echo $conteudo;?></textarea>
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

                <form action="painelcpage.php" method="post">
                    <label>PAGINA</label>
                    <input type="hidden" name="acao" value="editar">
                    <select name="pagina">

    <?php
        if(@mysqli_num_rows($consulta_page) <= '0'){
            echo '<option></option>';
        }
        else{
            echo '<option value="">Selecione uma opção</option>';
            while ($resultado_page = mysqli_fetch_assoc($consulta_page)) {
                echo "<option value='".$resultado_page['id']."'>".$resultado_page['pagina']."</option>";
            }
        }
    ?>

                    </select>
                    <input type="submit" value="Editar">
                </form>

                <article class="cadpost">

<?php

    if(isset($_GET['sit'])){
        if ($_GET['sit'] == 'ok') {
            echo "<h1 class='ok'>Publicação cadastrada com sucesso</h1>";
        }
        else{
            echo "<h1 class='error'>Falha ao cadastrar publicação</h1>";
        }
    }

?>

                    <form action="controllerPage.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acao" value="cadastrar">
                        <label>Titulo da pagina</label>
                        <input type="text" name="pagina"/>
                        <label>Conteúdo</label>
                        <textarea name="conteudo"></textarea>
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