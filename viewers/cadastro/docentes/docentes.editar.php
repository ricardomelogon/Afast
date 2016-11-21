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
			var id_docente = $('#id_docente').val();
			var nome_docente = $('#nome_docente').val();
			var siape_docente = $('#siape_docente').val();
			var email_docente = $('#email_docente').val();
			var efetivo_docente = $('#efetivo_docente').val();
			
			
			//2 validar os inputs
			if(id_docente === "" || nome_docente === "" || siape_docente === "" || email_docente === "" || efetivo_docente === ""){
				return alert('Todos os campos devem ser preenchidos.');
			}
			else{
				var emailtester = false;
				var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
				emailtester = re.test(email_docente);
				if(!emailtester){	
					return alert("Formato de email incorreto. Corrija o campo e tente novamente");
				}
				else{
					$.ajax({
					   url: '../engine/controllers/docente.php',
					   data: {
							id_docente : id_docente,
							nome_docente : nome_docente,
							siape_docente : siape_docente,
							email_docente : email_docente,
							efetivo_docente : efetivo_docente,
 							action: 'update'
					   },
					   error: function() {
							alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
					   },
					   success: function(data) {
							console.log(data);
							if(data === 'true'){
								alert('Docente modificado com sucesso!');
								$('#loader').load('cadastro/docentes/docentes.lista.php');
							}
							else{
								alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');	
							}
					   },
					   
					   type: 'POST'
					});	
				}
			}
			
			//3 transferir os dados dos inputs para o arquivo q ira tratar
			
			//4 observar a resposta, e falar pra usuario o que aconteceu
		});
		
		$('#efetivo_sim').click(function(e) {
			e.preventDefault();
			//alert("efetivo_sim");
			$('#efetivo_docente').val("1");
			$('#efetivo_placeholder').val("Sim");
    	});
		
		$('#efetivo_nao').click(function(e) {
			e.preventDefault();
			//alert("efetivo_sim");
			$('#efetivo_docente').val("0");
			$('#efetivo_placeholder').val("Não");
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
	<li class="active">Editar</li>
</ol>

<h1>Editar Docente</h1>

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
$Item = new Docente ();
$Item = $Item->Read ( $_POST ['id'] );
?>

<section class="row">

	<section class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Nome</span> <input
				type="text" class="form-control" id="nome_docente"
				placeholder="Nome" aria-describedby="basic-addon1"
				value="<?php echo $Item['nome_docente']?>">
		</div>
	</section>

	<section class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Siape</span> <input
				type="text" class="form-control" id="siape_docente"
				placeholder="1234567" aria-describedby="basic-addon1"
				value="<?php echo $Item['siape_docente']?>">
		</div>
	</section>
  
</section>

<section class="row">

	<section class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">E-Mail</span> <input
				type="text" class="form-control" id="email_docente"
				placeholder="exemplo@email.com" aria-describedby="basic-addon1"
				value="<?php echo $Item['email_docente']?>">
		</div>
	</section>

	<section class="col-md-3">
		<div class="input-group">
			<div class="input-group-btn">
				<button type="button" class="btn btn-default dropdown-toggle"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Efetivo <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="#" id="efetivo_sim">Sim</a></li>
					<li><a href="#" id="efetivo_nao">Não</a></li>
				</ul>
			</div>
			<!-- /btn-group -->
			<input id="efetivo_docente" type="hidden"
				value="<?php echo $Item['efetivo_docente']?>"> <input type="text"
				class="form-control" id="efetivo_placeholder" disabled
				placeholder="Escolha uma opção" aria-describedby="basic-addon1"
				value="<?php
				
if ($Item ['efetivo_docente'] === 1) {
					echo "Sim";
				} else {
					echo "Não";
				}
				?>">
		</div>
		<!-- /input-group -->
	</section>

	<input id="id_docente" type="hidden"
		value="<?php echo $Item['id_docente']?>">
</section>