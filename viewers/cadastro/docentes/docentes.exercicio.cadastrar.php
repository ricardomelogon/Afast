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
			var id_curso = $('#id_curso').val();
			var dt_inicio_exercicio = $('#dt_inicio_exercicio').val();
			
			//2 validar os inputs
			if(id_docente === "" || id_curso === "" || dt_inicio_exercicio === ""){
				return alert('Todos os campos devem ser preenchidos.');
			}
			else{
					$.ajax({
					   url: '../engine/controllers/exercicio.php',
					   data: {
							id_exercicio : null,
							id_docente : id_docente,
							id_curso : id_curso,
							dt_inicio_exercicio : dt_inicio_exercicio,
							dt_fim_exercicio : null,
 							action: 'create'
					   },
					   error: function() {
							alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
					   },
					   success: function(data) {
							console.log(data);
							if(data === 'true'){
								alert('Exercício cadastrado com sucesso.');
								$('#loader').load('cadastro/docentes/docentes.lista.php');
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
				
		$('.curso_select').click(function(e) {
			e.preventDefault();
			//alert("curso_select");
			$('#id_curso').val($(this).attr('id'));
			$('#curso_placeholder').val($(this).text());
			
    	});
		
		$('#exercicio_cadastro_datepicker').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "pt-BR",
			orientation: "bottom",
			autoclose: true
		});
		
		$('#exercicio_cadastro_datepicker').on("changeDate", function() {
    		$('#dt_inicio_exercicio').val(
        		$('#exercicio_cadastro_datepicker').datepicker('getFormattedDate')
    		);
			
			var invertdata = $('#exercicio_cadastro_datepicker').datepicker('getFormattedDate').split('-').reverse().join('/');
			//alert(invertdata);
			$('#date_display').val(invertdata);
		});
		
	});
</script>

<?php
require_once "../../../engine/config.php";
$Docente = new Docente ();
$Docente = $Docente->Read ( $_POST ['id'] );
?>


<br>
<ol class="breadcrumb">
	<li><a href="#" id="bread_home">Home</a></li>
	<li><a href="#">Gerenciar Docentes</a></li>
	<li><a href="#">Menu</a></li>
	<li class="active">Cadastro de Exercício</li>
</ol>

<h1>Cadastro de Exercício</h1>

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
				type="text" class="form-control" disabled placeholder="Nome"
				aria-describedby="basic-addon1"
				value="<?php echo $Docente['nome_docente']?>">
		</div>
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
					id="exercicio_cadastro_datepicker" aria-expanded="false">
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
<input type="hidden" value="<?php echo $Docente['id_docente']; ?>"
	id="id_docente">
<div class="bottom-pad"></div>