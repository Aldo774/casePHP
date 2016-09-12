<html>
<?php
    include "views/headPainel.php"; 
?>
    <body>
        <div class="Admin">
            <?php include"views/painelAdmin.php";?>

            <section class="contentAdmin">
                <h1>Cadastrar de Publicações</h1>
                <article class="cadpost">

<?php
    $query = "SELECT nome from tb_categoria";
    $consulta = mysqli_query($conexao, $query) or die(mysqli_error());
?>
<?php
    if(isset($_GET['sit'])){
        $msg = $_GET['sit'];
        if ($msg == 'ok') {
            echo "<h1 class='ok'>Publicação cadastrada com sucesso</h1>";
        }
        else{
            echo "<h1>Falha ao cadastrar publicação</h1>";
        }
    }
?>

                    <form action="cadastrarpost.php" method="POST" enctype="multipart/form-data">
                        <label>Imagem</label>
                        <input type="file" name="imagem" size="60"/>
                        <label>Titulo</label>
                        <input type="text" name="titulo"/>
                        <label>Categoria</label>

                        <select name="categoria">

<?php
    if(@mysqli_num_rows($consulta) <= '0'){
        echo '<option></option>';
    }
    else{
        echo '<option value="">Selecione uma Categoria</option>';
        while ($resultado = mysqli_fetch_assoc($consulta)) {
            echo "<option value='".$resultado['nome']."'>".$resultado['nome']."</option>";
        }
    }
?>

                        </select>

                        <label>Data</label>
                        <input type="text" name="data"/>
                        <label>Autor</label>
                        <input type="text" name="autor"/>
                        <label>Texto</label>
                        <textarea name="texto"></textarea>
                        <input type="submit" value="Enviar"/>
                    </form>
                </article>
            </section>
        </div>
    </body>

</html>