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
                <div>
                    <img src="img/settings.png">
                    <h1>Painel</h1>
                </div>
                <ul>
                    <li><span>Gerenciar Posts</span>
                        <ul>
                            <li>
                                <div>
                                    <p>Cadastrar Post</p>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p>Listar Post</p>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><span>Gerenciar Páginas</span>
                        <ul>
                            <li>
                                <div>
                                    <p>Cadastrar Nova</p>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p>Listar Paginas</p>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><span>Cadastrar Usuário</span>
                        <ul>
                            <li>
                                <div>
                                    <p>Cadastrar Novo</p>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p>Listar Usuários</p>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><span>Sistema</span>
                        <ul>
                            <li>
                                <div>
                                    <p>Visualizar o Site</p>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p>Logoff</p>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <section class="contentAdmin">
                <h1>Página restrita</h1>
                <section>
                    <p>Olá, <?php echo $_SESSION['UsuarioNome']; ?>!</p>
                </section>
            </section>
        </div>
    </body>

</html>