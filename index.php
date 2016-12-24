<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>AFAST ICT :: Login</title>
<link rel="stylesheet" href="css/bootstrap.css?v=1.15">
<link rel="stylesheet" href="css/style.css?v=1.15">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top ">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="col-md-3" id="icticon" href="http://www.ict.ufvjm.edu.br/">
					<img src="img/logo_ICT1.0.png" width="60" height="64" alt="Logo ICT" />
				</a>
			</div>
		</div>
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
				<input type="text" id="email_login" class="form-control" placeholder="Usuário" autofocus>
			</div>
			<br>
			<div class="input-group center-block">
				<input type="password" id="senha_login" class="form-control" placeholder="Senha">
			</div>
			<br>
			<button id="Logar" class="btn btn-lg btn-primary btn-block">Entrar</button>
		</div>
	</div>
	<br>
	<p class="text-center text-titulo col-md-12">Sistema de Gerenciamento de Frequência de Docentes</p>
	</main>
	<footer class="mainfooter navbar-default navbar-fixed-bottom">
		<section>
			<!--<a class="col-md-3" id="afasticon"><img src="img/logo_AFAST1.5.png" width="60" height="64" alt=""/></a>-->
			<p class="text-center footertext col-md-12">Todos os direitos
				reservados.</p>
		</section>
	</footer>
	<script src="js/jquery.js?v=1.15"></script>
	<script src="js/jquerymask.min.js?v=1.15"></script>
	<script type="text/javascript" src="js/bootstrap.js?v=1.15"></script>
	<script src="js/login.js?v=1.15"></script>
</body>
</html>