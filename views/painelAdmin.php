<aside class="sideAdmin">
    <div>
        <img src="img/settings.png">
        <h1>Painel</h1>
    </div>
    <ul>
        <li><span>&nbsp</span>
            <ul>
                <li>
                    <div>
                        <a href="restrito.php">HOME</a>
                        <div></div>
                    </div>
                </li>
            </ul>
        </li>
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
                        <a href="listarpost.php">Listar Post</a>
                        <div></div>
                    </div>
                </li>
            </ul>
        </li>
        <li><span>Gerenciar Páginas</span>
            <ul>
                <li>
                    <div>
                        <a href="painelcpage.php">Editar/Cadastrar Nova</a>
                        <div></div>
                    </div>
                </li>
            </ul>
        </li>
        <li><span>Gerenciar Categorias</span>
            <ul>
                <li>
                    <div>
                        <a href="painelccat.php">Cadastrar Nova</a>
                        <div></div>
                    </div>
                </li>
                <li>
                    <div>
                        <a href="listarcat.php">Listar Categorias</a>
                        <div></div>
                    </div>
                </li>
            </ul>
        </li>
        <li><span>Cadastrar Usuário</span>
            <ul>

<?php
    if ($_SESSION['UsuarioNivel'] != 1) {
?>

                <li>
                    <div>
                        <form action="painelcuser.php" method="POST">
                            <input type="hidden" name="acao" value="editar">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['UsuarioID'];?>">
                            <input type="submit" value="Editar Usuário">
                        </form>
                        <div></div>
                    </div>
                </li>
<?php
    }
    else{
?>
                <li>
                    <div>
                        <a href="painelcuser.php">Cadastrar Novo</a>
                        <div></div>
                    </div>
                </li>
                <li>
                    <div>
                        <a href="listarusuario.php">Listar Usuários</a>
                        <div></div>
                    </div>
                </li>
<?php
    }
?>
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