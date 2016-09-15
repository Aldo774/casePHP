<html>
<?php
    include "views/headPainel.php"; 
?>
    <body>
        <div class="Admin">
            <?php include"views/painelAdmin.php";?>

            <section class="contentAdmin">

<?php
    $query_c = "SELECT id, nome from tb_categoria";
    $consulta_cat = mysqli_query($conexao, $query_c) or die(mysqli_error());

/*----------------------------------------------------------------*/
/*------------------------PAGINA P/ EDIÇÃO------------------------*/

if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {

    $id = $_POST['id'];

    $consulta = "SELECT 
        tb_publicacao.thumb, 
        tb_publicacao.titulo, 
        tb_categoria.nome, 
        tb_categoria.id, 
        tb_publicacao.data, 
        tb_publicacao.texto, 
        tb_publicacao.id 
        FROM tb_publicacao 
        INNER JOIN tb_categoria 
        ON (tb_publicacao.categoria = tb_categoria.id) 
        WHERE tb_publicacao.id = '$id' 
        ORDER BY data desc";

    $publicacoes = mysqli_query($conexao, $consulta) or die(mysql_error());
    if(@mysql_num_rows == '0'){
        echo "<h1>Não há publicãções disponíveis</h1>";
    }
    else{
        while($res_publicacoes = mysqli_fetch_array($publicacoes)){
            $thumb = $res_publicacoes[0];
            $titulo = utf8_encode($res_publicacoes[1]);
            $categoria = $res_publicacoes[2];
            $categoria_id = $res_publicacoes[3];
            $data = $res_publicacoes[4];
            $texto = $res_publicacoes[5];
            $id = $res_publicacoes[6];
    
?>

                <h1>Editar Publicação</h1>
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

                    <form action="controllerPub.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <label>Imagem</label>
                        <input type="file" name="imagem" size="60"/>
                        <label>Titulo</label>
                        <input type="text" name="titulo" value="<?php echo $titulo;?>"/>
                        <label>Categoria</label>

                        <select name="categoria">

        <?php
            if(@mysqli_num_rows($consulta_cat) <= '0'){
                echo '<option>Selecione uma opção</option>';
            }
            else{
                echo '<option value="'.$categoria_id.'">'.$categoria.'</option>';
                while ($resultado_cat = mysqli_fetch_assoc($consulta_cat)) {
                    echo "<option value='".$resultado_cat['id']."'>".$resultado_cat['nome']."</option>";
                }
            }
        ?>

                        </select>

                        <label>Data</label>
                        <input type="text" name="data" value="<?php echo date('d/m/y', strtotime($data));?>"/>
                        <label>Texto</label>
                        <textarea name="texto"><?php echo $texto;?></textarea>
                        <input type="submit" value="Enviar"/>
                    </form>
<?php

        }

    }

}    
else{

/*----------------------------------------------------------------*/
/*------------------------PAGINA P/ CADASTRO----------------------*/

?>

                <h1>Cadastro de Publicação</h1>
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
                    <form action="controllerPub.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acao" value="cadastrar">
                        <label>Imagem</label>
                        <input type="file" name="imagem" size="60"/>
                        <label>Titulo</label>
                        <input type="text" name="titulo" value=""/>
                        <label>Categoria</label>

                        <select name="categoria">

    <?php
        if(@mysqli_num_rows($consulta_cat) <= '0'){
            echo '<option></option>';
        }
        else{
            echo '<option value="">Selecione uma opção</option>';
            while ($resultado_cat = mysqli_fetch_assoc($consulta_cat)) {
                echo "<option value='".$resultado_cat['id']."'>".$resultado_cat['nome']."</option>";
            }
        }
    ?>

                        </select>

                        <label>Data</label>
                        <input type="text" name="data"/>
                        <label>Texto</label>
                        <textarea name="texto"></textarea>
                        <input type="submit" value="Enviar"/>
                    </form>

<?php 
}
?>
                </article>
            </section>
        </div>
    </body>

</html>