<?php session_start ();
// var_dump($_SESSION);
if (empty ( $_SESSION )) {
	?>
<script>
				document.location.href = '..';
			</script>
<?php
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>AFAST ICT</title>
    <link rel="stylesheet" href="../css/bootstrap.css?v=1.15">
	<link rel="stylesheet" href="../css/style.css?v=1.15">
    <link rel="stylesheet" href="../css/bootstrap-datepicker3.css?v=1.15">
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top ">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="col-md-3" id="icticon" href="http://www.ict.ufvjm.edu.br/">
					<img src="../img/logo_ICT1.0.png" width="60" height="64" alt="" />
				</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" id="gerenciar_admin">ADMINISTRADOR</a></li>
				<li><a href="#" id="afast_sistema">HOME</a></li>
				<li><a href="#" id="getout"><i class="fa fa-sign-out"
						aria-hidden="true"></i> SAIR </a></li>
			</ul>
		</div>
	</nav>

	<!-- Paginas carregadas em modo de impressão aqui -->
	<section id="printloader"></section>
	<!-- Paginas carregadas em modo de impressão aqui -->
    
	<!-- Paginas carregadas aqui -->
	<main class="container-fluid" id="loader"></main>
	<!-- Paginas carregadas aqui -->
	

	<footer class="mainfooter navbar-default navbar-fixed-bottom">
		<section>
			<a class="col-md-3" id="afasticon"> <img
				src="../img/logo_AFAST1.5.png" width="60" height="64" alt="" />
			</a>
			<p class="text-right footertext col-md-9">Todos os direitos
				reservados.</p>
		</section>
	</footer>

	<script type="text/javascript" src="../js/jquery.js?v=1.15"></script>
	<script type="text/javascript" src="../js/bootstrap.js?v=1.15"></script>
    <script type="text/javascript" src="../js/jquerymask.min.js?v=1.15"></script>
    <script type="text/javascript" src="../js/bootstrap-datepicker.js?v=1.15"></script>
	<script type="text/javascript" src="../locales/bootstrap-datepicker.pt-BR.min.js?v=1.15"></script>
	<script type="text/javascript" src="../locales/pt-br.js?v=1.15"></script>
	<script type="text/javascript" src="../js/bootbox.min.js?v=1.15"></script>
    <script type="text/javascript" src="../js/menu.js?v=1.15"></script>
    <script type="text/javascript" src="../js/login.js?v=1.15"></script>
</body>
</html>