
<link rel="stylesheet" type="text/css" href="../css/select2.css" />
<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css" />
<script type="text/javascript" src="../js/moment.min.js"></script>
<script type="text/javascript" src="../js/jquery.cascade-select.js"></script>
<script type="text/javascript" src="../js/select2.js"></script>
<script type="text/javascript" src="../js/daterangepicker.js"></script>
<script>
	$(document).ready(function(e) {
		$('#Excluir').hide();
		$('#DetalhesAfastamento').hide();
		$('#AjudaEditarAfastamento').hide();

		var DataAtual = new Date();
		console.log(DataAtual.getMonth()+1);
		var MesAno = (DataAtual.getMonth()+1)+'/'+DataAtual.getFullYear();
		$('#filtra_mes').val(MesAno);
		

		$('#bread_home').click(function(e) {
			e.preventDefault();
			//alert("breadhome");
			$('#afast_sistema').click();
    	});
		/*bootbox.alert('<br /><div class="alert alert-danger"><strong>Atenção!</strong><p>Este sistema ainda não controla múltiplos afastamentos em uma mesma data.</p></div>');*/
		
		$('#Voltar').click(function(e) {
			e.preventDefault();
			//alert("Voltar");
			$('#loader').load('../viewers/cadastro/docentes/docentes.lista.php');
    	});
    	
		$('.Voltar').click(function(e) {
			e.preventDefault();
			//alert("Voltar");
			$('#loader').load('../viewers/cadastro/ocorrencias/ocorrencias.lista.php');
    	});
		
		$('#Salvar').click(function(e) {
			e.preventDefault();
			var	id_afastamento = $('#id_afastamento').val();
			var	dt_inicio_afastamento = $('#dt_inicio_afastamento').val();
			var	dt_fim_afastamento = $('#dt_fim_afastamento').val();
			var	observ_afastamento = $('#observ_afastamento').val();
			var id_ocorrencia = $('#id_ocorrencia').val();
			var	id_docente = $('#id_docente').val();
			//console.log($('#dt_inicio_afastamento').val());
			//console.log($('#dt_fim_afastamento').val());
			//console.log($('#observ_afastamento').val());
			//console.log($('#id_ocorrencia').val());
			//console.log($('#id_docente').val());

			//2 validar os inputs
			if ( dt_inicio_afastamento === "" || dt_fim_afastamento === "" || id_ocorrencia === ""  || id_docente === ""){
				return alert('Todos os campos devem ser preenchidos.');
			}
			else{
			  $.ajax({
				 url: '../engine/controllers/afastamento.php',
				 data: {
					id_afastamento  : id_afastamento,
					dt_inicio_afastamento : dt_inicio_afastamento,
					dt_fim_afastamento : dt_fim_afastamento,
					observ_afastamento : observ_afastamento,
					id_ocorrencia : id_ocorrencia,
					id_docente : id_docente,
					action: 'update'
				 },
				 error: function() {
					  alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
				 },
				 success: function(data) {
					  console.log(data);
					  if(data === 'true'){
						  alert('Afastamento alterado com sucesso');
						  $('#docenteloader').load('../viewers/cadastro/afastamento/afastamento.listar.php');
					  }
					  else{
						  alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');	
					  }
				 },
				 
				 type: 'POST'
			  		});	
				}
		});

		$('#Excluir').click(function(e) {
			e.preventDefault();
			if(confirm("Alterações em um Afastamento modificam todo o histórico relacionado a ele.\nNão é recomendado alterações a não ser que você tenha certeza de que são necessárias.\nDeseja continuar?"))
			{
				var	id_afastamento = $('#id_afastamento').val();
				$.ajax({
					url: '../engine/controllers/afastamento.php',
					data: {
					id_afastamento  : id_afastamento,
					dt_inicio_afastamento : null,
					dt_fim_afastamento : null,
					observ_afastamento : null,
					id_ocorrencia : null,
					id_docente : null,
					action: 'delete'
				},
				error: function() {
					alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
				},
				success: function(data) {
					console.log(data);
					if(data === 'true'){
						alert('Afastamento excluído com sucesso');
						$('#docenteloader').load('../viewers/cadastro/afastamento/afastamento.listar.php');
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

<script type="text/javascript">
	$('#escolhe_data').daterangepicker({
	    "showDropdowns": false,
	    "autoApply": true,
	    "locale": {
	        "format": "DD/MM/YYYY",
	        "separator": " - ",
	        "applyLabel": "Aplicar",
	        "cancelLabel": "Cancelar",
	        "fromLabel": "De",
	        "toLabel": "Até",
	        "customRangeLabel": true,
	        "weekLabel": "S",
	        "daysOfWeek": ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
	        "monthNames": ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
	        "firstDay": 1
	    },
	    "alwaysShowCalendars": true
	},
	function(start, end, label) {
	  //console.log($('#escolhe_data').data());
	});
	$('#escolhe_data').on('apply.daterangepicker', function(ev, picker) {
		$('#dt_inicio_afastamento').val(picker.startDate.format('YYYY-MM-DD'));
		$('#dt_fim_afastamento').val(picker.endDate.format('YYYY-MM-DD'));
	});
	$("#id_ocorrencia").select2({
		language: "pt-BR",
		placeholder: "Selecione a ocorrência para editar"
	});

	
	$("#sel_curso").change(function(){
	    var selcurso = $(this).val();
		    $.ajax({
				url: 'cadastro/afastamento/call_docentes.php',
				data: {selcurso : selcurso},
			success: function(data) {
	            $("#id_docente").empty();
	            $("#id_docente").append(data);
				},
				type: 'POST'
			});
	});

	$("#id_docente").change(function(){
	    var iddocente = $(this).val();
	    var filtra_mes = $('#filtra_mes').val();
	    $.ajax({
	        url: 'cadastro/afastamento/call.afastamento.lista.php',
	        data: {iddocente : iddocente, filtra_mes : filtra_mes},
	        success: function(data){
	            $("#LoaderAfastamento").empty();
	            $("#AjudaEditarAfastamento").show();
	            $("#LoaderAfastamento").append(data);
	        },
	    	type: 'POST'
	    });
		$('#Excluir').hide();
		$('#DetalhesAfastamento').hide();
		$('#AjudaEditarAfastamento').hide();
	});

	$('#filtra_mes').datepicker({
		format: "mm/yyyy",
		startView: "year", 
		minViewMode: "months",
		language: 'pt-BR',
	})
	$("#filtra_mes").change(function(){
	    var iddocente = $("#id_docente").val();
	    var filtra_mes = $(this).val();
	    $.ajax({
	        url: 'cadastro/afastamento/call.afastamento.lista.php',
	        data: {iddocente : iddocente, filtra_mes : filtra_mes},
	        success: function(data){
	            $("#LoaderAfastamento").empty();
	            $("#AjudaEditarAfastamento").show();
	            $("#LoaderAfastamento").append(data);
	        },
	    	type: 'POST'
	    });
		$('#Excluir').hide();
		$('#DetalhesAfastamento').hide();
		$('#AjudaEditarAfastamento').hide();
	});
</script>

<?php
require_once "../../../engine/config.php";
?>

<br>
<ol class="breadcrumb">
	<li><a href="#" id="bread_home">Home</a></li>
	<li><a href="#">Gerenciar Afastamentos</a></li>
	<li><a href="#">Lista de Dados</a></li>
	<li class="active">Editar Afastamentos</li>
</ol>

<div class="container col-md-12">
<h2 class="text-center">Editar Afastamento</h2>
<section class="row"> <!-- Menu de Salvar/Excluir/Voltar -->
	<section class="col-md-12 text-left" aria-label="...">
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-info" id="Voltar">
				<span class="glyphicon glyphicon-menu-left"></span>Voltar
			</button>
			<button type="button" class="btn btn btn-danger" id="Excluir">
				<span class="glyphicon glyphicon-remove"></span>Excluir
			</button>
			<button type="button" class="btn btn-success" id="Salvar">
				<span class="glyphicon glyphicon-save"></span>Salvar
			</button>
		</div>
	</section>
</section> <!-- Menu de Salvar/Excluir/Voltar -->
<br />

<section class="row"><!-- Primeira Linha -->
	<section class="col-md-3">  <!-- Selecionar Curso -->
		<div class="form-group">
		  <label for="sel_curso">Filtrar por Curso:</label>
		  <select class="form-control" id="sel_curso">
		  <option value=""> -- Selecione -- </option>
		    <?php 
		    $Curso = new Curso();
		    $Curso = $Curso->ReadAll();
		    if(empty($Curso)){
		    ?>
		    	<option>Nenhum curso encontrado</option>
		    <?php
          		}
    			else{
    			foreach($Curso as $cursoRow){
			    ?>
		    <option value="<?php echo $cursoRow['id_curso']?>"><?php echo $cursoRow['nome_curso']?></option>
		    <?php
    				}
    			}
			    ?>
		  </select>
		</div>
	</section> <!-- Selecionar Curso -->
	<section class="col-md-7"> <!-- Selecionar Docente-->	
		<div class="form-group">
		  <label for="id_docente">Selecionar Docente:</label>
		  <select class="form-control" id="id_docente">
		  <option class="sel_curso" value=""> -- Selecione um Curso -- </option>
		  </select>
		</div>
	</section><!-- Selecionar Docente-->
	<section class="col-md-2"> <!-- Selecionar Mês-->
		<div class="form-group has-feedback has-feedback-right">
			<label for="startdate" class="control-label">Escolha o mês:</label>
            <i class="form-control-feedback glyphicon glyphicon-calendar"></i>
			<input id="filtra_mes" name="filtra_mes" class="date-picker input-mini form-control filtra_mes" ></input> 
		</div>
	</section><!-- Selecionar Mês-->	
</section> <!-- Primeira Linha -->	
<div class="container col-md-12" id="DetalhesAfastamento">
<section class="row"> <!-- Segunda Linha -->
	<section class="col-md-3"> <!-- Selecionar Datas-->
		<div class="form-group has-feedback has-feedback-right">
			<input type="hidden" id="dt_inicio_afastamento">
			<input type="hidden" id="dt_fim_afastamento">
			<label class="control-label">Escolha o intervalo de datas</label>
			<i class="form-control-feedback glyphicon glyphicon-calendar"></i>
			<input id="escolhe_data" name="escolhe_data" class="input-mini form-control" type="text" disabled="disabled"></input>
		</div>
	</section><!-- Selecionar Datas-->
	<section class="col-md-9">  <!-- Selecionar Ocorrência-->
	<div class="form-group idocorr">
		<label for="id_ocorrencia">Ocorrência:</label>
		<select class="form-control" id="id_ocorrencia" style="width: 100%" disabled="disabled">
		<option></option>
		<?php 
		    $Ocorrencia = new Ocorrencia();
		    $Ocorrencia = $Ocorrencia->ReadAll();
		    if(empty($Ocorrencia)){
		    ?>
		    	<option>Nenhum curso encontrado</option>
		    <?php
          		}
    			else{
    			foreach($Ocorrencia as $ocorrenciaRow){
			    ?>
		    <option value="<?php echo $ocorrenciaRow['id_ocorrencia']?>"><?php
		    echo $ocorrenciaRow['codigo_ocorrencia']." - ".$ocorrenciaRow['tipo_ocorrencia']
		    ?></option>
		    <?php
    				}
    			}
			    ?>
		</select>
	</div>
	</section> <!-- Selecionar Ocorrência-->
</section> <!-- Segunda Linha-->
<section class="row"> <!-- Terceira Linha-->
	<section class="col-md-12"> <!-- Campo de Observação -->
		<label for="observ_afastamento">Observação:</label>
		<textarea class="form-control" rows="2" id="observ_afastamento" maxlength="195"></textarea>
	</section> <!-- Campo de Observação -->
</section> <!-- Terceira Linha-->
</div>
	<div class="col-md-12" id="AjudaEditarAfastamento">
		<div class="alert alert-info">Clique em <strong>Editar</strong> para selecionar um <strong>Afastamento</strong></div>
	</div>
<section class="row" id="LoaderAfastamento">
	<div class="col-md-12">
	<div class="alert alert-info">Selecione <strong>Curso</strong> e <strong>Docente</strong> para listar os Afastamentos</div>
	</div>
</section> <!-- Fecha Container -->

</div> <!-- Fecha Container -->

