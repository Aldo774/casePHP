<html>
<?php
    include "views/headPainel.php"; 
?>
    <body>
        <div class="Admin">

            <?php include"views/painelAdmin.php";?>

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
                    <p>Número de visitas: <?php echo $resultado['visitas'];?></p>
                </section>
            </section>
        </div>
    </body>

</html>