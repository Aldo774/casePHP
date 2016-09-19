<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Login</title>
    </head>
    <body class="formLogin">
        <form action="validacao.php" method="post">
            <legend>Dados de Login</legend>
            <label for="txUsuario">Usuário</label>
            <input type="text" name="usuario" id="txUsuario"/>
            <label for="txSenha">Senha</label>
            <input type="password" name="senha" id="txSenha" />
            <input type="submit" value="Entrar" />
        </form>
    </body>
</html>