<script>
	$(document).ready(function(e) {
		$('#bread_home').click(function(e) {
			e.preventDefault();
			//alert("breadhome");
			$('#afast_sistema').click();
    	});
		
		$('#Voltar').click(function(e) {
			e.preventDefault();
			//alert("Voltar");
			$('#loader').load('cadastro/docentes/docentes.lista.php');
    	});
		
		$('#Salvar').click(function(e) {
			e.preventDefault();
			//alert('salvar');
			//1 instansciar e recuperar valores dos inputs
			var id_curso = null;
			var nome_curso = $('#nome_curso').val();

			//2 validar os inputs
			if(nome_curso === ""){
				return alert('Preencha o nome do curso.');
			}
			else{
					$.ajax({
					   url: '../engine/controllers/curso.php',
					   data: {
						  	id_curso : id_curso,
							nome_curso : nome_curso,
 							action: 'create'
					   },
					   error: function() {
							alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
					   },
					   success: function(data) {
							console.log(data);
							if(data === 'true'){
								alert('Curso cadastrado com sucesso!');
								$('#docenteloader').load('cadastro/docentes/docentes.curso.lista.php');
							}
							else{
								alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');	
							}
					   },
					   
					   type: 'POST'
					});	
				}
			
			
			//3 transferir os dados dos inputs para o arquivo q ira tratar
			
			//4 observar a resposta, e falar pra usuario o que aconteceu
		});
		
	});
</script>

<?php
require_once "../../../engine/config.php";
?>


<br>
<ol class="breadcrumb">
	<li><a href="#" id="bread_home">Home</a></li>
	<li><a href="#">Gerenciar Docentes</a></li>
	<li><a href="#">Menu</a></li>
	<li><a href="#">Lista de Cursos</a></li>
	<li class="active">Cadastro</li>
</ol>

<h1>Cadastro de Novo Curso</h1>

<br>

<section class="col-md-12">

	<button type="button" class="btn btn-info" id="Voltar">

		<span class="glyphicon glyphicon-menu-left"></span>Voltar
	</button>

	<button type="button" class="btn btn-success" id="Salvar">
		<span class="glyphicon glyphicon-save" aria-hidden="true"></span>Salvar
	</button>

</section>

<br>
<br>

<section class="row">
	<section class="col-md-4"></section>
	<section class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Nome</span> <input
				type="text" class="form-control" id="nome_curso"
				placeholder="Nome do Curso" aria-describedby="basic-addon1">
		</div>
	</section>
	<section class="col-md-4"></section>
</section>