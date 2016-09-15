	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/lib/jquery/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="js/script/carroussel.js"></script>
		<script type="text/javascript" src="js/script/calcAlt.js"></script>
		<title>HOME</title>
<?php 

	mb_internal_encoding("UTF-8"); 
	mb_http_output( "iso-8859-1" );  
	ob_start("mb_output_handler");   
	header("Content-Type: text/html; charset=ISO-8859-1",true);

	include "connections/config.php";
	$conexao = mysqli_connect("$hostname_config", "$username_config", "$password_config", "$database_config")
				or die(mysql_error("Erro ao acessar base de dados"));
?>
	</head>