<?php

    include "views/headPainel.php";
    
    if (isset($_POST['acao'])) {

/*--------------------------------------EXCLUIR-------------------------------------*/
/*----------------------------------------------------------------------------------*/

        if ($_POST['acao'] == 'excluir' && isset($_POST['id'])) {
            $id = $_POST['id'];
            //echo "excluir";
            $query_img = "SELECT tb_publicacao.thumb, tb_categoria.nome 
                            FROM tb_publicacao INNER JOIN tb_categoria ON 
                            (tb_publicacao.categoria = tb_categoria.id) 
                            WHERE tb_publicacao.id = '$id'";

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
                        header("Location: listarpost.php?sit=okexc"); exit;
                    }
                    else{
                        header("Location: painelcpost.php?sit=erroexc"); exit;
                    }
                }
            }

        }

/*--------------------------------------CADASTRAR-------------------------------------*/
/*----------------------------------------------------------------------------------*/

        elseif ($_POST['acao'] == 'cadastrar') {

            $titulo =       $_POST['titulo'];
            $img =          $_FILES['imagem'];
            $categoria =    $_POST['categoria'];
            $data =         $_POST['data'];
            $autor =        $_SESSION['UsuarioID'];
            $texto =        $_POST['texto'];
            $categoria_nome = "";

            $query_cimg = "SELECT nome FROM tb_categoria WHERE id = '$categoria'";
            $resultado_query_cat = mysqli_query($conexao, $query_cimg);

            if(@mysqli_num_rows($resultado_query_cat) <= '0'){
                echo 'ERRO';
            }
            else{
                while ($resultado_cat = mysqli_fetch_assoc($resultado_query_cat)) {
                    $categoria_nome = $resultado_cat['nome'];
                }
            }

            $pasta = "uploads/$categoria_nome";
            $permitido = array('image/jpg', 'image/jpeg', 'image/pjpeg');

            require("funcao_upload.php");
                $nome = $img['name'];
                $tmp = $img['tmp_name'];
                $type = $img['type'];

                $entrada = ("$data");

            $entrada = trim("$data");
            if (!$data) {
                $entrada = date('d/m/y');
            }
            if(strstr($entrada, "/")){
                $aux = explode("/", $entrada);
                $aux2 = date('H:i:s');
                $aux3 = $aux[2]."-".$aux[1]."-".$aux[0]." ". $aux2;
            }

            if(!empty($nome) && in_array($type, $permitido)){
                $nomeimg = md5(uniqid(rand(),true)).".jpg";
                Redimensionar($tmp, $nomeimg, 500, $pasta);

                $query = "INSERT INTO tb_publicacao (thumb,
                                    titulo,
                                    categoria,
                                    data,
                                    autor,
                                    texto,
                                    visitas) 
                                VALUES ('$nomeimg', 
                                        '$titulo', 
                                        '$categoria', 
                                        '$aux3', 
                                        '$autor', 
                                        '$texto',
                                        '1')";
                
                $cadastro_publicacao = mysqli_query($conexao, $query)
                or die (mysql_error());

                if($cadastro_publicacao >= '1'){
                    echo "Publicação Cadastrada";
                    header("Location: painelcpost.php?sit=ok"); exit;
                }
                else{
                    echo "Erro ao enviar mensagem";
                    header("Location: painelcpost.php?sit=erro"); exit;
                }

            }

        }

/*--------------------------------------EDITAR--------------------------------------*/
/*----------------------------------------------------------------------------------*/

        elseif ($_POST['acao'] == 'editar' && isset($_POST['id'])) {

            $id =           $_POST['id'];
            $titulo =       $_POST['titulo'];
            $categoria =    $_POST['categoria'];
            $data =         $_POST['data'];
            $autor =        $_SESSION['UsuarioID'];
            $texto =        $_POST['texto'];
            $entrada = ("$data");
            $entrada = trim("$data");
            $categoria_nome = "";

            if (!$data) {
                $entrada = date('d/m/y');
            }
            if(strstr($entrada, "/")){
                $aux = explode("/", $entrada);
                $aux2 = date('H:i:s');
                $aux3 = $aux[2]."-".$aux[1]."-".$aux[0]." ". $aux2;
            }

            $query = "UPDATE tb_publicacao SET 
                                titulo = '$titulo', 
                                categoria = '$categoria', 
                                data = '$aux3', 
                                autor = '$autor', 
                                texto = '$texto' 
                                WHERE id = '$id'";

            if (empty($_FILES['imagem']['name'])) {
                
            }
            else{

/*--VERIFICA SE HÁ ATUALIZAÇÃO DE IMAGEM--------------------------------------------*/

            //if (isset($_FILES['imagem'])) {

            //Deleta a imagem antiga---------------------------------------------------
                $query_cimg = "SELECT nome FROM tb_categoria WHERE id = '$categoria'";
                $resultado_query_cat = mysqli_query($conexao, $query_cimg);

                if(@mysqli_num_rows($resultado_query_cat) <= '0'){
                    echo 'ERRO';
                }
                else{
                    while ($resultado_cat = mysqli_fetch_assoc($resultado_query_cat)) {
                        $categoria_nome = $resultado_cat['nome'];
                    }
                }


                $img =      $_FILES['imagem'];             

                require("funcao_upload.php");

                $nome = $img['name'];
                $tmp = $img['tmp_name'];
                $type = $img['type'];
                $pasta = "uploads/$categoria_nome";
                $permitido = array('image/jpg', 'image/jpeg', 'image/pjpeg');

                if(!empty($nome) && in_array($type, $permitido)){
                    $nomeimg = md5(uniqid(rand(),true)).".jpg";
                    Redimensionar($tmp, $nomeimg, 500, $pasta);
                }

                $query_img = "SELECT thumb FROM tb_publicacao WHERE id = '$id'";
                $resultado_img = mysqli_query($conexao, $query_img) or die (mysqli_error());

                if (@mysqli_num_rows($resultado_img) <= '0') {
                    echo "erro";
                }
                else
                {
                    while ($res_resultado_img=mysqli_fetch_array($resultado_img)) {
                        $thumb_meta = $res_resultado_img[0];

                        $del = unlink("uploads/".$categoria_nome."/".$thumb_meta);
                    }
                }

                $query = "UPDATE tb_publicacao SET 
                                    thumb = '$nomeimg', 
                                    titulo = '$titulo', 
                                    categoria = '$categoria', 
                                    data = '$aux3', 
                                    autor = '$autor', 
                                    texto = '$texto' 
                                    WHERE id = '$id'";

            }


            
/*----------------------------------------------------------------------------------*/
            echo $query;
            
            $cadastro_publicacao = mysqli_query($conexao, $query)
            or die (mysql_error());

            if($cadastro_publicacao >= '1'){
                echo "Publicação Cadastrada";
                header("Location: painelcpost.php?sit=ok"); exit;
            }
            else{
                echo "Erro ao enviar mensagem";
                header("Location: painelcpost.php?sit=erro"); exit;
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