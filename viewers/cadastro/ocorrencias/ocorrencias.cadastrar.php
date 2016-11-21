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
			$('#loader').load('cadastro/ocorrencias/ocorrencias.lista.php');
    	});
		
		$('#Salvar').click(function(e) {
			e.preventDefault();
			//alert('salvar');
			//1 instansciar e recuperar valores dos inputs
			var id_ocorrencia = $('#id_ocorrencia').val();
			var tipo_ocorrencia = $('#tipo_ocorrencia').val();
			var codigo_ocorrencia = $('#codigo_ocorrencia').val();
			
			//2 validar os inputs
			if(id_ocorrencia === "" || tipo_ocorrencia === "" || codigo_ocorrencia === ""){
				return alert('Todos os campos devem ser preenchidos.');
			}
			else{
			  $.ajax({
				 url: '../engine/controllers/ocorrencia.php',
				 data: {
					  id_ocorrencia : null,
					  tipo_ocorrencia : tipo_ocorrencia,
					  codigo_ocorrencia : codigo_ocorrencia,
					  action: 'create'
				 },
				 error: function() {
					  alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
				 },
				 success: function(data) {
					  console.log(data);
					  if(data === 'true'){
						  alert('Ocorrência cadastrada com sucesso');
						  $('#loader').load('cadastro/ocorrencias/ocorrencias.lista.php');
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
	<li><a href="#">Gerenciar Ocorrências</a></li>
	<li><a href="#">Lista de Dados</a></li>
	<li class="active">Cadastrar Ocorrência</li>
</ol>

<h1>Cadastrar Nova Ocorrência</h1>

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

	<section class="col-md-8">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Tipo</span> <input
				type="text" class="form-control" id="tipo_ocorrencia"
				placeholder="Tipo de Ocorrência" aria-describedby="basic-addon1">
		</div>
	</section>

	<section class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Código</span> <input
				type="text" class="form-control" id="codigo_ocorrencia"
				placeholder="01-234" aria-describedby="basic-addon1">
		</div>
	</section>
</section>