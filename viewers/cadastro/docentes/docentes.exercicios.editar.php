<script>
	$(document).ready(function(e) {
		$('#bread_home').click(function(e) {
			e.preventDefault();
			//alert("breadhome");
			$('#afast_sistema').click();
    	});
		
		$('#Voltar').click(function(e) {
			e.preventDefault();
			var id = $("#id_docente").val();
			$('#docenteloader').load('cadastro/docentes/docentes.exercicios.php',{ id: id});
    	});
		
		$('#Salvar').click(function(e) {
			e.preventDefault();
			//alert('salvar');
			//1 instansciar e recuperar valores dos inputs
			var id_exercicio = $('#id_exercicio').val();
			var id_docente = $('#id_docente').val();
			var id_curso = $('#id_curso').val();
			var dt_inicio_exercicio = $('#dt_inicio_exercicio').val();
			var dt_fim_exercicio = $('#dt_fim_exercicio').val();
			
			
			//2 validar os inputs
			//alert(dt_fim_exercicio);
			if(id_exercicio === "" || id_docente === "" || id_curso === "" || dt_inicio_exercicio === ""){
				return alert('Todos os campos devem ser preenchidos.');
			}
			else{
				$.ajax({
				   url: '../engine/controllers/exercicio.php',
				   data: {
						id_exercicio : id_exercicio,
						id_docente : id_docente,
						id_curso : id_curso,
						dt_inicio_exercicio : dt_inicio_exercicio,
						dt_fim_exercicio : dt_fim_exercicio,
						action: 'update'
				   },
				   error: function() {
						alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
				   },
				   success: function(data) {
						console.log(data);
						if(data === 'true'){
							var id = $("#id_docente").val();
							alert('Exercício do docente atualizado com sucesso.');
							$('#docenteloader').load('cadastro/docentes/docentes.exercicios.php',{ id: id});
						}
						else{
							alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');	
						}
				   },
				   
				   type: 'POST'
				});		
			}
		});
		
		$('.curso_select').click(function(e) {
			e.preventDefault();
			//alert("curso_select");
			$('#id_curso').val($(this).attr('id'));
			$('#curso_placeholder').val($(this).text());
			
    	});
		
		$('#efetivar').click(function(e) {
			e.preventDefault();
			//alert("curso_select");
			$('#dt_fim_exercicio').val("0000-00-00");
			$('#date_display2').val("Exercício Ativo");
			
    	});
		
		$('#datepicker1').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "pt-BR",
			orientation: "auto",
			autoclose: true
		});
		
		$('#datepicker1').on("changeDate", function() {
    		$('#dt_inicio_exercicio').val(
        		$('#datepicker1').datepicker('getFormattedDate')
    		);
			
			var invertdata = $('#datepicker1').datepicker('getFormattedDate').split('-').reverse().join('/');
			//alert(invertdata);
			$('#date_display1').val(invertdata);
		});
		
		$('#datepicker2').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "pt-BR",
			orientation: "auto",
			autoclose: true
		});
		
		$('#datepicker2').on("changeDate", function() {
    		$('#dt_fim_exercicio').val(
        		$('#datepicker2').datepicker('getFormattedDate')
    		);
			
			var invertdata = $('#datepicker2').datepicker('getFormattedDate').split('-').reverse().join('/');
			//alert(invertdata);
			$('#date_display2').val(invertdata);
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

<h1>Editar Exercício</h1>

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
$Item = new Exercicio ();
$Item = $Item->Read ( $_POST ['id'] );
// var_dump($Item);
?>
<section class="row">
	<section class="col-md-12">
		<div class="input-group">
			<div class="input-group-btn dropup">
				<button type="button" class="btn btn-default dropdown-toggle"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Curso <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">           	
<?php
$Curso = new Curso ();
$Curso = $Curso->ReadAll ();
if (empty ( $Curso )) {
	?>
				  	<li><a href="#">Nenhum curso encontrado</a></li>
<?php
} else {
	foreach ( $Curso as $itemRow ) {
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
			<input id="id_curso" type="hidden"
				value="<?php echo $Item['id_curso']?>"> <input type="text"
				class="form-control" id="curso_placeholder" disabled
				placeholder="<?php foreach($Curso as $LinhaCurso){if($Item['id_curso'] === $LinhaCurso['id_curso']){echo $LinhaCurso['nome_curso']; break;}}?>"
				aria-describedby="basic-addon1">
		</div>
		<!-- /input-group -->
	</section>
</section>
<section class="row">
	<section class="col-md-12">
		<div class="input-group">
			<div class="input-group-btn">
				<input type="hidden" id="dt_inicio_exercicio"
					value=<?php echo $Item['dt_inicio_exercicio'];?>>
				<button type="button" class="btn btn-default" aria-haspopup="true"
					id="datepicker1" aria-expanded="false">
					Data de Entrada <span class="caret">
				
				</button>
			</div>
			<input type="text" disabled class="form-control" id="date_display1"
				placeholder=<?php echo $Item['dt_inicio_exercicio'];?>
				aria-describedby="basic-addon1">
		</div>
	</section>
</section>
<section class="row bottom-pad">
	<section class="col-md-12">
		<div class="input-group">
			<div class="input-group-btn">
				<input type="hidden" id="dt_fim_exercicio"
					value=<?php if($Item['dt_fim_exercicio'] == ""){ echo "0000-00-00";} else{ echo $Item['dt_fim_exercicio'];}?>>
				<button type="button" class="btn btn-default" aria-haspopup="true"
					id="datepicker2" aria-expanded="false">
					Data de Término <span class="caret">
				
				</button>
			</div>
			<input type="text" disabled class="form-control" id="date_display2"
				placeholder="<?php echo $Item['dt_fim_exercicio'];?>"
				aria-describedby="basic-addon1">
			<div class="input-group-btn">
				<button type="button" class="btn btn-default" aria-haspopup="true"
					id="efetivar" aria-expanded="false">Efetivar</button>
			</div>
		</div>
	</section>
</section>
<input 
	type="hidden" 
    id="id_docente"
	value=<?php echo $Item['id_docente'];?>
> 
<input 
	type="hidden"
	id="id_exercicio" 
    value=<?php echo $Item['id_exercicio'];?>
>