<?php

    include "views/headPainel.php";
    
    if (isset($_POST['acao'])) {

/*--------------------------------------EXCLUIR-------------------------------------*/
/*----------------------------------------------------------------------------------*/

        if ($_POST['acao'] == 'excluir' && isset($_POST['id'])) {

            $id = $_POST['id'];
            $deletar = "DELETE FROM tb_usuario WHERE id = '$id'";

            $deletar_cat = mysqli_query($conexao, $deletar) or die(mysql_error());
            if ($deletar_cat >= '1') {
                header("Location: listarusuario.php?sit=okexc"); exit;
            }
            else{
                header("Location: painelcuser.php?sit=erroexc"); exit;
            }

        }        
        
/*------------------------------------CADASTRAR-------------------------------------*/
/*----------------------------------------------------------------------------------*/

        if ($_POST['acao'] == 'cadastrar') {

            $usuario =  $_POST['usuario'];
            $senha =    $_POST['senha'];
            $nivel =    $_POST['nivel'];
            $email =    $_POST['email'];

            $query = "INSERT INTO tb_usuario (usuario, 
                        senha, 
                        nivel, 
                        email, 
                        ativo) 
                        VALUES ('$usuario', 
                        '$senha', 
                        '$nivel', 
                        '$email', 
                        1)";
            
            $cadastro_categoria = mysqli_query($conexao, $query)
            or die (mysql_error());

            if($cadastro_categoria >= '1'){
                chdir("uploads");
                mkdir("$nome");
                header("Location: painelcuser.php?sit=ok"); exit;
            }
            else{
                header("Location: painelcuser.php?sit=erro"); exit;
            }

        }

/*--------------------------------------EDITAR--------------------------------------*/
/*----------------------------------------------------------------------------------*/

        elseif ($_POST['acao'] == 'editar' && isset($_POST['id'])) {

            $id =       $_POST['id'];
            $usuario =  $_POST['usuario'];
            $senha =    $_POST['senha'];
            $nivel =    $_POST['nivel'];
            $email =    $_POST['email'];

            $query = "UPDATE tb_usuario 
                        SET usuario = '$usuario', 
                        senha = '$senha', 
                        nivel = '$nivel', 
                        email = '$email' 
                        WHERE id = '$id'";
            
            $cadastro_usuario = mysqli_query($conexao, $query)
            or die (mysql_error());


            if($cadastro_usuario >= '1'){
                header("Location: painelccat.php?sit=ok"); exit;
            }
            else{
                header("Location: painelccat.php?sit=erro"); exit;
            }

        }

        else{

            header("Location: erro.php"); exit;
        }
    }

    else{

        header("Location: erro.php"); exit;
    }

?>