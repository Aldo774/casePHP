<?php

    include "views/headPainel.php";
    
    if (isset($_POST['acao'])) {
/*----------------------------------------------------------------------------------*/

        if ($_POST['acao'] == 'cadastrar') {

            $pagina =       $_POST['pagina'];
            $conteudo =    $_POST['conteudo'];

            $query = "INSERT INTO tb_page (pagina,
                                conteudo) 
                            VALUES ('$pagina', 
                                    '$conteudo')";
            
            $cadastro_page = mysqli_query($conexao, $query)
            or die (mysql_error());

            if($cadastro_page >= '1'){
                echo "Pagina cadastrada";
                header("Location: painelcpage.php?sit=ok"); exit;
            }
            else{
                echo "Erro ao cadastrar pagina";
                header("Location: painelcpage.php?sit=erro"); exit;
            }

        }

/*--------------------------------------EDITAR--------------------------------------*/
/*----------------------------------------------------------------------------------*/

        elseif ($_POST['acao'] == 'editar' && isset($_POST['id'])) {

            $id =           $_POST['id'];
            $pagina =       $_POST['pagina'];
            $conteudo =    $_POST['conteudo'];

            $query = "UPDATE tb_page SET 
                                pagina = '$pagina', 
                                conteudo = '$conteudo' 
                                WHERE id = '$id'";
            
            $cadastro_publicacao = mysqli_query($conexao, $query)
            or die (mysql_error());

            if($cadastro_publicacao >= '1'){
                echo "Pagina alterada com sucesso";
                header("Location: painelcpage.php?sit=ok"); exit;
            }
            else{
                echo "Erro ao atualizar pagina";
                header("Location: painelcpage.php?sit=erro"); exit;
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