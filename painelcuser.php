<html>
<?php
    include "views/headPainel.php"; 
?>
    <body>
        <div class="Admin">
            <?php include"views/painelAdmin.php";?>

            <section class="contentAdmin">

<?php
    $query_c = "SELECT nivel, nome from tb_nivel";
    $consulta_user = mysqli_query($conexao, $query_c) or die(mysqli_error());
/*----------------------------------------------------------------*/
/*------------------------PAGINA P/ EDIÇÃO------------------------*/

if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {

    $id = $_POST['id'];

    if (($_SESSION['UsuarioNivel'] != 1) && ($_SESSION['UsuarioID'] != $id)) {
        header("Location: restrito.php"); exit;
    }

    $consulta = "SELECT 
        tb_usuario.id, 
        tb_usuario.usuario, 
        tb_usuario.senha, 
        tb_usuario.nivel, 
        tb_nivel.nome, 
        tb_usuario.email 
        from tb_usuario INNER JOIN 
        tb_nivel on 
        tb_usuario.nivel = tb_nivel.id 
        WHERE tb_usuario.id = '$id'";

    $user_q = mysqli_query($conexao, $consulta) or die(mysql_error());
    if(@mysql_num_rows == '0'){
        echo "<h1>Usuario inexistente</h1>";
    }
    else{
        while($res_user = mysqli_fetch_array($user_q)){
            $id = $res_user[0];
            $usuario = $res_user[1];
            $senha = $res_user[2];
            $nivel_nvl = $res_user[3];
            $nivel = $res_user[4];
            $email = $res_user[5];
?>

                <h1>Editar Usuário</h1>
                <article class="caduser">

<?php

    if(isset($_GET['sit'])){
        if ($_GET['sit'] == 'ok') {
            echo "<h1 class='ok'>Usuario cadastrado com sucesso</h1>";
        }
        else{
            echo "<h1 class='error'>Falha ao cadastrar usuario</h1>";
        }
    }

?>

                    <form action="controllerUser.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <label>Nome do Usuário</label>
                        <input type="text" name="usuario" value="<?php echo $usuario;?>"/>
                        <label>Senha</label>
                        <input type="text" name="senha" value="<?php echo $senha;?>"/>

                        <label>Nível</label>
                        <select name="nivel">

        <?php
            if(@mysqli_num_rows($consulta_user) <= '0'){
                echo '<option>Selecione uma opção</option>';
            }
            else{
                echo '<option value="'.$nivel_nvl.'">'.utf8_encode($nivel).'</option>';
                while ($resultado_user = mysqli_fetch_assoc($consulta_user)) {
                    echo "<option value='".$resultado_user['nivel']."'>".utf8_encode($resultado_user['nome'])."</option>";
                }
            }
        ?>

                        </select>

                        <label>Email</label>
                        <input type="text" name="email" value="<?php echo $email;?>"/>
                        <input type="submit" value="Atualizar"/>
                    </form>
<?php

        }

    }

}    
else{

    if ($_SESSION['UsuarioNivel'] != 1) {
        header("Location: restrito.php"); exit;
    }
/*----------------------------------------------------------------*/
/*------------------------PAGINA P/ CADASTRO----------------------*/

?>

                <h1>Cadastro de Usuário</h1>
                <article class="caduser">

<?php

    if(isset($_GET['sit'])){
        if ($_GET['sit'] == 'ok') {
            echo "<h1 class='ok'>Usuario cadastrada com sucesso</h1>";
        }
        else{
            echo "<h1 class='error'>Falha ao cadastrar Usuário</h1>";
        }
    }

?>

                    <form action="controllerUser.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acao" value="cadastrar">
                        <label>Nome do Usuário</label>
                        <input type="text" name="usuario"/>
                        <label>Senha</label>
                        <input type="text" name="senha"/>

                        <label>Nivel</label>
                        <select name="nivel">

        <?php
            if(@mysqli_num_rows($consulta_user) <= '0'){
                echo '<option>Selecione uma opção</option>';
            }
            else{
                while ($resultado_user = mysqli_fetch_assoc($consulta_user)) {
                    echo "<option value='".$resultado_user['nivel']."'>".utf8_encode($resultado_user['nome'])."</option>";
                }
            }
        ?>

                        </select>

                        <label>Email</label>
                        <input type="text" name="email"/>
                        <input type="submit" value="Atualizar"/>
                    </form>
<?php 
}
?>
                </article>
            </section>
        </div>
    </body>
</html>