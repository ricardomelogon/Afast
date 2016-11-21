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
			var nome_docente = $('#nome_docente').val();
			var siape_docente = $('#siape_docente').val();
			var email_docente = $('#email_docente').val();
			var efetivo_docente = $('#efetivo_docente').val();
			var id_curso = $('#id_curso').val();
			var dt_inicio_exercicio = $('#dt_inicio_exercicio').val();
			
			
			//2 validar os inputs
			if(nome_docente === "" || siape_docente === "" || email_docente === "" || efetivo_docente === "" || id_curso === "" || dt_inicio_exercicio === ""){
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
					   url: '../engine/controllers/docente_exercicio.php',
					   data: {
							nome_docente : nome_docente,
							siape_docente : siape_docente,
							email_docente : email_docente,
							efetivo_docente : efetivo_docente,
							id_curso : id_curso,
							dt_inicio_exercicio : dt_inicio_exercicio,
 							action: 'create'
					   },
					   error: function() {
							alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
					   },
					   success: function(data) {
							console.log(data);
							if(data === 'true'){
								alert('Docente cadastrado com sucesso!');
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
		
		$('.curso_select').click(function(e) {
			e.preventDefault();
			//alert("curso_select");
			$('#id_curso').val($(this).attr('id'));
			$('#curso_placeholder').val($(this).text());
			
    	});
		
		$('#docente_cadastro_datepicker').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "pt-BR",
			orientation: "bottom",
			autoclose: true
		});
		
		$('#docente_cadastro_datepicker').on("changeDate", function() {
    		$('#dt_inicio_exercicio').val(
        		$('#docente_cadastro_datepicker').datepicker('getFormattedDate')
    		);
			
			var invertdata = $('#docente_cadastro_datepicker').datepicker('getFormattedDate').split('-').reverse().join('/');
			//alert(invertdata);
			$('#date_display').val(invertdata);
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
	<li class="active">Cadastro</li>
</ol>

<h1>Cadastro de Docente</h1>

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

	<section class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Nome</span> <input
				type="text" class="form-control" id="nome_docente"
				placeholder="Nome" aria-describedby="basic-addon1">
		</div>
	</section>

	<section class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Siape</span> <input
				type="text" class="form-control" id="siape_docente"
				placeholder="1234567" aria-describedby="basic-addon1">
		</div>
	</section>

	<section class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">E-Mail</span> <input
				type="text" class="form-control" id="email_docente"
				placeholder="exemplo@email.com" aria-describedby="basic-addon1">
		</div>
	</section>
</section>

<br>
<section class="row">

	<section class="col-md-4">
		<div class="input-group">
			<div class="input-group-btn dropup">
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
			<input id="efetivo_docente" type="hidden"> <input type="text"
				class="form-control" id="efetivo_placeholder" disabled
				placeholder="Escolha uma opção" aria-describedby="basic-addon1">
		</div>
		<!-- /input-group -->
	</section>

	<section class="col-md-4">
		<div class="input-group">
			<div class="input-group-btn dropup">
				<button type="button" class="btn btn-default dropdown-toggle"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Curso <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">           	
<?php
$Item = new Curso ();
$Item = $Item->ReadAll ();
if (empty ( $Item )) {
	?>
				  	<li><a href="#">Nenhum curso encontrado</a></li>
<?php
} else {
	foreach ( $Item as $itemRow ) {
		// var_dump($itemRow);
		?>
				    <li><a href="#" id=<?php echo $itemRow['id_curso']; ?>
						class="curso_select"><?php echo $itemRow['nome_curso']; ?></a></li>     
				              
<?php
	}
}
?>
                
            </ul>
			</div>
			<!-- /btn-group -->
			<input id="id_curso" type="hidden"> <input type="text"
				class="form-control" id="curso_placeholder" disabled
				placeholder="Escolha um curso" aria-describedby="basic-addon1">
		</div>
		<!-- /input-group -->
	</section>

	<section class="col-md-4">
		<div class="input-group">
			<div class="input-group-btn">
				<input type="hidden" id="dt_inicio_exercicio">
				<button type="button" class="btn btn-default" aria-haspopup="true"
					id="docente_cadastro_datepicker" aria-expanded="false">
					Data de Entrada <span class="caret">
				
				</button>
			</div>
          <?php
										
$Data = getdate ();
										$Dia = $Data ['mday'];
										$Mes = $Data ['mon'];
										$Ano = $Data ['year'];
										$Dataform = $Dia . '/' . $Mes . '/' . $Ano;
										?>
          <input type="text" disabled class="form-control"
				id="date_display" placeholder=<?php echo $Dataform;?>
				aria-describedby="basic-addon1">
		</div>
	</section>
</section>
<div class="bottom-pad"></div>