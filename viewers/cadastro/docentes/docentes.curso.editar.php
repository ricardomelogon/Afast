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
			$('#docenteloader').load('cadastro/docentes/docentes.curso.lista.php');
    	});
		
		$('#Salvar').click(function(e) {
			e.preventDefault();
			//alert('salvar');
			//1 instansciar e recuperar valores dos inputs
			var id_curso = $('#id_curso').val();
			var nome_curso = $('#nome_curso').val();
			//2 validar os inputs
			if(id_curso === "" || nome_curso === ""){
				return alert('Preencha o nome do curso.');
			}
			else{
					$.ajax({
					   url: '../engine/controllers/curso.php',
					   data: {
							id_curso : id_curso,
							nome_curso : nome_curso,
 							action: 'update'
					   },
					   error: function() {
							alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
					   },
					   success: function(data) {
							console.log(data);
							if(data === 'true'){
								alert('Curso modificado com sucesso.');
								$('#docenteloader').load('cadastro/docentes/docentes.curso.lista.php');
							}
							else{
								alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');	
							}
					   },
					   
					   type: 'POST'
					});	
				}
				
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
	<li><a href="#">Lista Cursos</a></li>
	<li class="active">Editar Curso</li>
</ol>

<h1>Editar Curso</h1>

<br>

<section>

	<button type="button" class="btn btn-info" id="Voltar">

		<span class="glyphicon glyphicon-menu-left"></span>Voltar
	</button>

	<button type="button" class="btn btn-success" id="Salvar">
		<span class="glyphicon glyphicon-save" aria-hidden="true"></span>Salvar
	</button>

</section>

<br>
<br>

<?php
$Item = new Curso ();
$Item = $Item->Read ( $_POST ['id'] );
// var_dump($Item);
?>

<section class="row">
	<section class="col-md-4"></section>
	<section class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Nome</span> <input
				type="text" class="form-control" id="nome_curso" placeholder="Nome"
				aria-describedby="basic-addon1"
				value="<?php echo $Item['nome_curso']?>">
		</div>
	</section>
	<section class="col-md-4"></section>
	<input id="id_curso" type="hidden"
		value="<?php echo $Item['id_curso']?>">
</section>