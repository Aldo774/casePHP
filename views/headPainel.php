	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/lib/jquery/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="js/lib/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="js/script/calcAlt.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector:'textarea',
				language:'pt_BR',
			  theme: 'modern',
			  plugins: [
			    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			    'searchreplace wordcount visualblocks visualchars code fullscreen',
			    'insertdatetime media nonbreaking save table contextmenu directionality',
			    'emoticons template paste textcolor colorpicker textpattern imagetools'
			  ],
			  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
			  toolbar2: 'print preview media | forecolor backcolor emoticons',
			  image_advtab: true,
			  templates: [
			    { title: 'Test template 1', content: 'Test 1' },
			    { title: 'Test template 2', content: 'Test 2' }
			  ]
			});
		</script>
		<title>Painel Gestor</title>
<?php 

	mb_internal_encoding("UTF-8"); 
	mb_http_output( "iso-8859-1" );  
	ob_start("mb_output_handler");   
	header("Content-Type: text/html; charset=ISO-8859-1",true);

	include "connections/config.php";
	$conexao = mysqli_connect("$hostname_config", "$username_config", "$password_config", "$database_config")
				or die(mysql_error("Erro ao acessar base de dados"));

    if (!isset($_SESSION)) session_start();    
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: index.php"); exit;
    }

?>
	</head>