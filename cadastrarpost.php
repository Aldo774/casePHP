<?php
    include "views/head.php"; 
    // A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();    
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: index.php"); exit;
    }
?>

<?php
    
    $titulo =       $_POST['titulo'];
    $img =          $_FILES['imagem'];
    $categoria =    $_POST['categoria'];
    $data =         $_POST['data'];
    $autor =        $_POST['autor'];
    $texto =        $_POST['texto'];

    $pasta = "uploads/$categoria";
    $permitido = array('image/jpg', 'image/jpeg', 'image/pjpeg');

    require("funcao_upload.php");
        $nome = $img['name'];
        $tmp = $img['tmp_name'];
        $type = $img['type'];

        $entrada = ("$data");

    $entrada = trim("$data");
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

?>