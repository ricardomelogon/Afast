
<link rel="stylesheet" type="text/css" href="../css/select2.css?v=1.18" />
<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css?v=1.18" />
<script type="text/javascript" src="../js/moment.min.js?v=1.18"></script>
<script type="text/javascript" src="../js/jquery.cascade-select.js?v=1.18"></script>
<script type="text/javascript" src="../js/select2.js?v=1.18"></script>
<script type="text/javascript" src="../js/daterangepicker.js?v=1.18"></script>
<script>
	$(document).ready(function(e) {
		//$('#dt_inicio_afastamento').val(moment().format('L'));
		//$('#dt_fim_afastamento').val(moment().format('L'));
		/*bootbox.alert('<br /><div class="alert alert-danger"><strong>Atenção!</strong><p>Este sistema ainda não controla múltiplos afastamentos em uma mesma data.</p></div>');*/

		$('#bread_home').click(function(e) {
			e.preventDefault();
			//alert("breadhome");
			$('#afast_sistema').click();
    	});
		
		$('#Voltar').click(function(e) {
			e.preventDefault();
			//alert("Voltar");
			$('#afast_sistema').click();
    	});
		
		$('#Salvar').click(function(e) {
			e.preventDefault();
			var	id_afastamento = $('#id_afastamento').val();
			var	dt_inicio_afastamento = $('#dt_inicio_afastamento').val();
			var	dt_fim_afastamento = $('#dt_fim_afastamento').val();
			var	observ_afastamento = $('#observ_afastamento').val();
			var id_ocorrencia = $('#id_ocorrencia').val();
			var	id_docente = $('#id_docente').val();
			if ( dt_inicio_afastamento === "" || dt_fim_afastamento === "" || id_ocorrencia === ""  || id_docente === ""){
				return alert('Todos os campos devem ser preenchidos.');
			}
			else{
				(function(dt_inicio_afastamento, dt_fim_afastamento, id_docente, observ_afastamento, id_ocorrencia){
					$.ajax({
						url: '../engine/controllers/afastamento.php',
						type: 'POST',
						data: {
							id_afastamento  : null,
							dt_inicio_afastamento : dt_inicio_afastamento,
							dt_fim_afastamento : dt_fim_afastamento,
							observ_afastamento : observ_afastamento,
							id_ocorrencia : id_ocorrencia,
							id_docente : id_docente,
							action: 'overlap'
						},
						success: function(data) {
							if (data == "true"){proceedOverlap = true;}
							else{
								var proceedOverlap = confirm("O afastamento coincide com afastamentos já existentes. Deseja continuar?");
							} 
							if (proceedOverlap) {
								(function(dt_inicio_afastamento, dt_fim_afastamento, id_docente, observ_afastamento, id_ocorrencia){  
									$.ajax({
										url: '../engine/controllers/afastamento.php',
										data: {
											id_afastamento  : null,
											dt_inicio_afastamento : dt_inicio_afastamento,
											dt_fim_afastamento : dt_fim_afastamento,
											observ_afastamento : observ_afastamento,
											id_ocorrencia : id_ocorrencia,
											id_docente : id_docente,
											action: 'create'
										},
										error: function() {
											alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
										},
										success: function(data) {
											if(data === 'true'){
											  alert('Afastamento inserido com sucesso');
											  $('#docenteloader').load('../viewers/afastamento/afastamento.listar.php');
											}
											else{
											  alert('Erro ao inserir dados.');  
											}
										}, //Sucesso Ajax2
										type: 'POST'
									}); //Ajax2
								})(dt_inicio_afastamento, dt_fim_afastamento, id_docente, observ_afastamento, id_ocorrencia); //Ajax2 Função
							} //If sobreposição
						} //Sucesso Ajax1
					}); //Ajax1
				})(dt_inicio_afastamento, dt_fim_afastamento, id_docente, observ_afastamento, id_ocorrencia); //Ajax1 Função
			}
		});
		
	});
</script>

<script type="text/javascript">
	 	
	$("#sel_curso").change(function(){
	    var selcurso = $(this).val();
	    $.ajax({
	        type: "POST",
	        url: "afastamento/call_docentes.php",
			data: {selcurso: selcurso},
	        dataType: "text",
	        success: function(res){
	            $("#id_docente").empty();
	            $("#id_docente").append(res);
	        }
	    });
	});


	$('input[name="escolhe_data"]').daterangepicker({
	    showDropdowns: true,
	    autoApply: true,
	    autoUpdateInput: true,
		"timePicker": true,
		"drops": "up",
	    locale: {
	        "format": "DD/MM/YYYY",
	        "separator": " - ",
	        "applyLabel": "Aplicar",
	        "cancelLabel": "Cancelar",
	        "fromLabel": "De",
	        "toLabel": "Até",
	        "customRangeLabel": "Outro",
	        "weekLabel": "S",
	        "daysOfWeek": ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
	        "monthNames": ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
	        "firstDay": 1
	    },
	    alwaysShowCalendars: true
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
		  placeholder: "Digite para buscar a ocorrência"
	});

</script>

<?php
require_once "../../engine/config.php";
?>

<br>
<ol class="breadcrumb">
	<li><a href="#" id="bread_home">Home</a></li>
	<li><a href="#">Gerenciar Afastamentos</a></li>
	<li><a href="#">Lista de Dados</a></li>
	<li class="active">Inserir Afastamentos</li>
</ol>

<br />

<div class="containter well table-overflow">
<h2 class="text-center">Inserir Afastamento</h2>
<br />
<br />
<section class="row"> <!-- Menu de Salvar/Voltar -->
	<section class="col-md-12 text-left">
		<section class="btn-group" role="group">
			<button type="button" class="btn btn-info" id="Voltar">
				<span class="glyphicon glyphicon-menu-left"></span>Voltar
			</button>
			<button type="button" class="btn btn-success" id="Salvar">
				<span class="glyphicon glyphicon-save" aria-hidden="true"></span>Salvar
			</button>
		</section>
	</section>
</section> <!-- Menu de Salvar/Voltar -->
<br />
<section class="row"><!-- Primeira Linha -->
	<section class="col-md-4">  <!-- Selecionar Curso -->
		<div class="form-group">
		  <label for="sel_curso">Selecionar Curso:</label>
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
	<section class="col-md-8"> <!-- Selecionar Docente-->	
		<div class="form-group">
		  <label for="id_docente">Selecionar Docente:</label>
		  <select class="form-control" id="id_docente">
		  <option class="sel_curso" value=""> -- Selecione um Curso -- </option>
		  </select>
		</div>
	</section><!-- Selecionar Docente-->	
</section> <!-- Primeira Linha -->

<section class="row"> <!-- Segunda Linha -->
	<section class="col-md-4"> <!-- Selecionar Datas-->
		<div class="form-group has-feedback has-feedback-right">
			<input type="hidden" id="dt_inicio_afastamento" value="<?php echo date("Y-m-d");?>">
			<input type="hidden" id="dt_fim_afastamento" value="<?php echo date("Y-m-d");?>">
			<label class="control-label">Escolha o intervalo de datas</label>
			<i class="form-control-feedback glyphicon glyphicon-calendar"></i>
			<input id="escolhe_data" name="escolhe_data" class="input-mini form-control" type="text">
		</div>
	</section><!-- Selecionar Datas-->
	<section class="col-md-8">  <!-- Selecionar Ocorrência-->
	<div class="form-group">
		<label for="id_ocorrencia">Selecionar a Ocorrência:</label>
        <section>
		<select class="form-control" id="id_ocorrencia" style="width: 100%">
		<option value=""> -- Selecione -- </option>
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
        </section>
	</div>
	</section> <!-- Selecionar Ocorrência-->
</section> <!-- Segunda Linha-->

<section class="row"> <!-- Terceira Linha-->
	<section class="col-md-12"> <!-- Campo de Observação -->
		<label for="observ_afastamento">Observação:</label>
		<textarea class="form-control" rows="2" id="observ_afastamento" maxlength="195"></textarea>
	</section> <!-- Campo de Observação -->
</section> <!-- Terceira Linha-->
</div> <!-- Fecha Well -->

