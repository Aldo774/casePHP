<?php

    include "views/headPainel.php";
    
    if (isset($_POST['acao']) && isset($_POST['id'])) {

        $id = $_POST['id'];

        if ($_POST['acao'] == 'excluir') {
            //echo "excluir";
            $query_img = "SELECT thumb, categoria FROM tb_publicacao WHERE id = '$id'";

            $resultado = mysqli_query($conexao, $query_img) or die (mysqli_error());

            if (@mysqli_num_rows($resultado) <= '0') {
                echo "erro";
            }
            else
            {
                while ($res_resultado=mysqli_fetch_array($resultado)) {
                    $thumb_meta = $res_resultado[0];
                    $categoria_meta = $res_resultado[1];

                    chdir("uploads/$categoria_meta");
                    $del = unlink("$thumb_meta");

                    $deletar = "DELETE FROM tb_publicacao WHERE id = '$id'";
                    $deletar_pub = mysqli_query($conexao, $deletar) or die(mysqli_error());

                    if ($deletar_pub >= '1') {
                        echo "Publicação Cadastrada";
                        header("Location: listarpost.php?sit=okexc"); exit;
                    }
                    else{
                        echo "Erro ao enviar mensagem";
                        header("Location: painelcpost.php?sit=erroexc"); exit;
                    }
                }
            }

        }

        elseif ($_POST['acao'] == 'editar') {
            echo "editar";
        }

        else{

            header("Location: erro.php"); exit;

        }
    
    }

    else{

        header("Location: erro.php"); exit;
    
    }

?>