<html>
<?php
    include "views/headPainel.php"; 
    if ($_SESSION['UsuarioNivel'] != 1) {
        header("Location: restrito.php"); exit;
    }
?>
    <body>
        <div class="Admin">

            <?php include"views/painelAdmin.php";?>

            <section class="contentAdmin">
                <h1>Listar Usuários</h1>

                <article class="listarUser">
<?php
    if(isset($_GET['sit'])){
        if ($_GET['sit'] == 'okexc') {
            echo "<h1 class='ok'>Usuário excluido com sucesso</h1>";
        }
        elseif ($_GET['sit'] == 'erroexc'){
            echo "<h1 class='error'>Falha ao excluir usuário</h1>";
        }
    }
?>
                    <h1>
                        <span>Nome do Usuário</span>
                        <span>Nível</span>
                        <span>Editar</span>
                        <span>Excluir</span>
                    </h1>

<?php

    $consulta = "SELECT usuario, 
                    nivel, 
                    id 
                    from tb_usuario 
                    ORDER BY id desc";
        
    $usuarios = mysqli_query($conexao, $consulta) or die(mysql_error());

    if(@mysql_num_rows == '0'){
        echo "<h1>Não há usuarios disponíveis</h1>";
    }
    else{
        while($res_usuarios = mysqli_fetch_array($usuarios)){
            $usuario = utf8_encode($res_usuarios[0]);
            $nivel = $res_usuarios[1];
            $id = $res_usuarios[2];
?>

                    <div>
                        <span><?php echo $usuario;?></span>
                        <span><?php echo $nivel;?></span>
                        <form method="post" action="painelcuser.php">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="acao" value="editar">
                            <input type="submit" value="">
                        </form>
                        <form method="post" action="controllerUser.php">
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