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
                                    <a href="#">Cadastrar Post</a>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="#">Listar Post</a>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><span>Gerenciar Páginas</span>
                        <ul>
                            <li>
                                <div>
                                    <a href="#">Cadastrar Nova</a>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="#">Listar Paginas</a>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><span>Cadastrar Usuário</span>
                        <ul>
                            <li>
                                <div>
                                    <a href="#">Cadastrar Novo</a>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="#">Listar Usuários</a>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><span>Sistema</span>
                        <ul>
                            <li>
                                <div>
                                    <a href="index.php" target="_blank">Visualizar o Site</a>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="logout.php">Logoff</a>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <section class="contentAdmin">
                <h1>Página restrita</h1>
<?php
    $query =  "SELECT Sum(visitas) as visitas from tb_publicacao";
    
    $visitas_total = mysqli_query($conexao, $query) or die(mysqli_error());

    if(@mysqli_num_rows($visitas_total) != '1'){
        echo '';
    }
    else{
        $resultado = mysqli_fetch_assoc($visitas_total);
    }

?>
<section>
    <p>Olá, <?php echo $_SESSION['UsuarioNome']; ?>!</p>
    <p>Número de visitas: <?php echo $resultado['visitas'];?></p></section>
</section>
        </div>
    </body>

</html>