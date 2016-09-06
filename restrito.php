<html>
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
    <body>
        <div class="Admin">
            <aside class="sideAdmin">
                <h1>Painel</h1>
                <ul>
                    <li><h2>Gerenciar Posts</h2>
                        <ul>
                            <li><h3>Cadastrar Novo</h3></li>
                            <li><h3>Listar Posts</h3></li>
                        </ul>
                    </li>
                    <li><h2>Gerenciar Páginas</h2>
                        <ul>
                            <li><h3>Cadastrar Nova</h3></li>
                            <li><h3>Listar Paginas</h3></li>
                        </ul>
                    </li>
                    <li><h2>Cadastrar Usuário</h2>
                        <ul>
                            <li><h3>Cadastrar Novo</h3></li>
                            <li><h3>Listar Usuários</h3></li>
                        </ul>
                    </li>
                    <li><h2>Sistema</h2>
                        <ul>
                            <li><h3>Visualizar o Site</h3></li>
                            <li><h3>Logoff</h3></li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <section class="contentAdmin">
                <h1>Página restrita</h1>
                <p>Olá, <?php echo $_SESSION['UsuarioNome']; ?>!</p>
            </section>
        </div>
    </body>

</html>