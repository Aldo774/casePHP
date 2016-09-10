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
                                    <a href="painelcpost.php">Cadastrar Post</a>
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
                <h1>Cadastrar de Publicações</h1>
                <article class="cadpost">

<?php
    $query = "SELECT nome from tb_categoria";
    $consulta = mysqli_query($conexao, $query) or die(mysqli_error());
?>
<?php
    if(isset($_GET['sit'])){
        $msg = $_GET['sit'];
        if ($msg == 'ok') {
            echo "<h1 class='ok'>Publicação cadastrada com sucesso</h1>";
        }
        else{
            echo "<h1>Falha ao cadastrar publicação</h1>";
        }
    }
?>

                    <form action="cadastrarpost.php" method="POST" enctype="multipart/form-data">
                        <label>Imagem</label>
                        <input type="file" name="imagem" size="60"/>
                        <label>Titulo</label>
                        <input type="text" name="titulo"/>
                        <label>Categoria</label>

                        <select name="categoria">

<?php
    if(@mysqli_num_rows($consulta) <= '0'){
        echo '<option></option>';
    }
    else{
        echo '<option value="">Selecione uma Categoria</option>';
        while ($resultado = mysqli_fetch_assoc($consulta)) {
            echo "<option value='".$resultado['nome']."'>".$resultado['nome']."</option>";
        }
    }
?>

                        </select>

                        <label>Data</label>
                        <input type="text" name="data"/>
                        <label>Autor</label>
                        <input type="text" name="autor"/>
                        <label>Texto</label>
                        <textarea name="texto"></textarea>
                        <input type="submit" value="Enviar"/>
                    </form>
                </article>
            </section>
        </div>
    </body>

</html>