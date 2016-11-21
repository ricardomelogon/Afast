<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>AFAST ICT :: Login</title>

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top ">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">

				<a class="col-md-3" id="icticon" href="http://www.ict.ufvjm.edu.br/">
					<img src="img/logo_ICT1.0.png" width="60" height="64"
					alt="Logo ICT" />
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->


		</div>
		<!-- /.container-fluid -->
	</nav>


	<main class="container-fluid" id="mainlogin">
	<div class="row">
		<div class="col-md-3 "></div>
		<div class="col-md-3 ">
			<img src="img/logo_AFAST1.5.png" alt="Logo AFAST"
				class="img-responsive img-rounded">
		</div>
		<div class="col-md-3 ">
			<br>
			<h1 class="text-center">Login</h1>
			<div class="input-group center-block">
				<input type="text" id="email_login" class="form-control"
					placeholder="Usuário" autofocus>
			</div>
			<br>
			<div class="input-group center-block">
				<input type="password" id="senha_login" class="form-control"
					placeholder="Senha">
			</div>
			<br>
			<button id="Logar" class="btn btn-lg btn-primary btn-block">Entrar</button>
		</div>
	</div>
	<br>
	<p class="text-center text-titulo col-md-12">Sistema de Gerenciamento
		de Frequência de Docentes</p>
	</main>

	<footer class="mainfooter navbar-default navbar-fixed-bottom">
		<section>
			<!--<a class="col-md-3" id="afasticon"><img src="img/logo_AFAST1.5.png" width="60" height="64" alt=""/></a>-->
			<p class="text-center footertext col-md-12">Todos os direitos
				reservados.</p>
		</section>
	</footer>

	<script src="js/jquery.js"></script>
	<script src="js/jquerymask.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="js/login.js"></script>

</body>
</html>