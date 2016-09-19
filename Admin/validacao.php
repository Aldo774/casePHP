<?php  
    // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
    if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
        header("Location: index.php"); exit;
    }

	include "connections/config.php";
	$conexao = mysqli_connect("$hostname_config", "$username_config", "$password_config", "$database_config")
		or die(mysqli_error("Erro ao acessar base de dados"));

    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $sql = "SELECT id, usuario, nivel FROM tb_usuario WHERE (usuario = '".$usuario ."') AND (senha = '".$senha."') AND (ativo = 1) LIMIT 1";
    $query = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($query) != 1) {
        // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
        echo "Login inválido!"; exit;
    } else {
        // Salva os dados encontados na variável $resultado
        $resultado = mysqli_fetch_assoc($query);

        // Se a sessão não existir, inicia uma
        if (!isset($_SESSION)) session_start();
      
        // Salva os dados encontrados na sessão
        $_SESSION['UsuarioID'] = $resultado['id'];
        $_SESSION['UsuarioNome'] = $resultado['usuario'];
        $_SESSION['UsuarioNivel'] = $resultado['nivel'];
      
        // Redireciona o visitante
        header("Location: restrito.php"); exit;
    }

?>