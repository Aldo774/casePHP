<?php

    include "views/headPainel.php";
    
    if (isset($_POST['acao'])) {

/*--------------------------------------EXCLUIR-------------------------------------*/
/*----------------------------------------------------------------------------------*/

        if ($_POST['acao'] == 'excluir' && isset($_POST['id'])) {

            $id = $_POST['id'];

            $query_c = "SELECT nome FROM tb_categoria WHERE id = '$id'";

            $resultado = mysqli_query($conexao, $query_c) or die (mysqli_error());

            if (@mysqli_num_rows($resultado) <= '0') {
                echo "erro";
            }
            else
            {
                while ($res_resultado=mysqli_fetch_array($resultado)) {
                    $categoria_meta = $res_resultado[0];

                    chdir("../uploads/");

                    function rmdir_recursive($dir) {
                        foreach(scandir($dir) as $file) {
                            if ('.' === $file || '..' === $file) continue;
                            if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
                            else unlink("$dir/$file");
                        }
                        rmdir($dir);
                    }

                    rmdir_recursive($categoria_meta);

                    $deletar = "DELETE FROM tb_categoria WHERE id = '$id'";
                    $deletar_posts = "DELETE FROM tb_publicacao WHERE categoria = '$id'";

                    $deletar_cat = mysqli_query($conexao, $deletar) or die(mysql_error());
                    $deletar_pub = mysqli_query($conexao, $deletar_posts) or die(mysql_error());

                    if (($deletar_cat >= '1') AND ($deletar_pub >= '1')) {
                        header("Location: listarcat.php?sit=okexc"); exit;
                    }
                    else{
                        header("Location: painelccat.php?sit=erroexc"); exit;
                    }
                }
            }

        }        
        
/*------------------------------------CADASTRAR-------------------------------------*/
/*----------------------------------------------------------------------------------*/

        if ($_POST['acao'] == 'cadastrar') {

            $nome = strip_tags(trim($_POST['nome']));

            $query = "INSERT INTO tb_categoria (nome) 
                            VALUES ('$nome')";
            
            $cadastro_categoria = mysqli_query($conexao, $query)
            or die (mysql_error());

            if($cadastro_categoria >= '1'){
                chdir("../uploads");
                mkdir("$nome");
                header("Location: painelccat.php?sit=ok"); exit;
            }
            else{
                header("Location: painelccat.php?sit=erro"); exit;
            }

        }

/*--------------------------------------EDITAR--------------------------------------*/
/*----------------------------------------------------------------------------------*/

        elseif ($_POST['acao'] == 'editar' && isset($_POST['id'])) {

            $id =           $_POST['id'];
            $nome =         strip_tags(trim($_POST['nome']));

            $query = "UPDATE tb_categoria 
                        SET nome = '$nome' 
                        WHERE id = '$id'";

            $query_c = "SELECT nome FROM tb_categoria WHERE id = '$id'";
            
            $resultado_n = mysqli_query($conexao, $query_c)
            or die (mysql_error());            
            
            $cadastro_categoria = mysqli_query($conexao, $query)
            or die (mysql_error());

            while ($res_resultado_n=mysqli_fetch_array($resultado_n)) {
                $categoria_meta = $res_resultado_n[0];

                if(($cadastro_categoria >= '1') AND ($resultado_n >= '1')){
                    chdir("../uploads");
                    rename("$categoria_meta", "$nome");
                    echo $categoria_meta." ".$nome;
                    header("Location: painelccat.php?sit=ok"); exit;
                }
                else{
                    header("Location: painelccat.php?sit=erro"); exit;
                }

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