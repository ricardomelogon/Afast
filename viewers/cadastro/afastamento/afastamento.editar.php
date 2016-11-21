
<link rel="stylesheet" type="text/css" href="../css/select2.css" />
<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css" />
<script type="text/javascript" src="../js/moment.min.js"></script>
<script type="text/javascript" src="../js/jquery.cascade-select.js"></script>
<script type="text/javascript" src="../js/select2.js"></script>
<script type="text/javascript" src="../js/daterangepicker.js"></script>
<script>
	$(document).ready(function(e) {
		$('#Excluir').hide();

		$('#bread_home').click(function(e) {
			e.preventDefault();
			//alert("breadhome");
			$('#afast_sistema').click();
    	});
		
		$('#Voltar').click(function(e) {
			e.preventDefault();
			//alert("Voltar");
			$('#docenteloader').load('../viewers/cadastro/afastamento/afastamento.listar.php');
    	});
    	
		$('.Voltar').click(function(e) {
			e.preventDefault();
			//alert("Voltar");
			$('#docenteloader').load('../viewers/cadastro/afastamento/afastamento.listar.php');
    	});
		$('#Inserir').click(function(e) {
			e.preventDefault();
			//alert("Voltar");
			$('#docenteloader').load('../viewers/cadastro/afastamento/afastamento.cadastrar.php');
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
					action: 'create'
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
			if(confirm("Alterações em um curso modificam todo o histórico relacionado a ele.\nNão é recomendado alterações a não ser que você tenha certeza de que são necessárias.\nDeseja continuar?"))
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
		(function(){
			'use strict';
			var $ = jQuery;
			$.fn.extend({
				filterTable: function(){
					return this.each(function(){
						$(this).on('keyup', function(e){
							$('.filterTable_no_results').remove();
							var $this = $(this), 
								search = $this.val().toLowerCase(), 
								target = $this.attr('data-filters'), 
								$target = $(target), 
								$rows = $target.find('tbody tr');
								
							if(search == '') {
								$rows.show(); 
							} else {
								$rows.each(function(){
									var $this = $(this);
									$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
								})
								if($target.find('tbody tr:visible').size() === 0) {
									var col_count = $target.find('tr').first().find('td').size();
									var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">Nenhum afastamento encontrado</td></tr>')
									$target.find('tbody').append(no_results);
								}
							}
						});
					});
				}
			});
			$('[data-action="filter"]').filterTable();
		})(jQuery);

		$(function(){
			// attach table filter plugin to inputs
			$('[data-action="filter"]').filterTable();
			
			$('.container').on('click', '.panel-heading span.filter', function(e){
				var $this = $(this), 
					$panel = $this.parents('.panel');
				
				$panel.find('.panel-body').slideToggle();
				if($this.css('display') != 'none') {
					$panel.find('.panel-body input').focus();
				}
			});
			$('[data-toggle="tooltip"]').tooltip();
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
<h2 class="text-center">Novo Afastamento para Docente</h2>

<?php 
$Docente = new Docente();
$Docente = $Docente->Read( $_POST ['id'] );
?>
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
	<section class="col-md-12"> <!-- Selecionar Docente-->	
		<div class="form-group">
		  <label for="id_docente">Docente:</label>
		  <select class="form-control" id="id_docente" disabled>
		  <option class="sel_curso" value="<?php echo $Docente['id_docente']?>"><?php echo $Docente['nome_docente']?></option>
		  </select>
		</div>
	</section><!-- Selecionar Docente-->	
</section> <!-- Primeira Linha -->

<section class="row"> <!-- Segunda Linha -->
	<section class="col-md-3"> <!-- Selecionar Datas-->
		<div class="form-group has-feedback has-feedback-right">
			<input type="hidden" id="dt_inicio_afastamento">
			<input type="hidden" id="dt_fim_afastamento">
			<label class="control-label">Escolha o intervalo de datas</label>
			<i class="form-control-feedback glyphicon glyphicon-calendar"></i>
			<input id="escolhe_data" name="escolhe_data" class="input-mini form-control" type="text"></input>
		</div>
	</section><!-- Selecionar Datas-->
	<section class="col-md-9">  <!-- Selecionar Ocorrência-->
	<div class="form-group idocorr">
		<label for="id_ocorrencia">Ocorrência:</label>
		<select class="form-control" id="id_ocorrencia" style="width: 100%">
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
		<textarea class="form-control" rows="2" id="observ_afastamento"></textarea>
	</section> <!-- Campo de Observação -->
</section> <!-- Terceira Linha-->

<section class="row">
	<section class="col-md-12">
		<div id="id_afastamento" hidden="true"></div>
		<?php
		$Afastamento = new Afastamento();
		$Afastamento = $Afastamento->ReadAllDocente($Docente['id_docente']);
		// var_dump($Item);
		if (empty ( $Afastamento )) {
			?>  
		    	<br>
			<br>
			<h4 class="well text-center">Nenhum dado encontrado.</h4>
		<?php
		} else {
			?>
		  <div class="filterrow">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Últimos Afastamentos Registrados</h3>
						<div class="pull-right">
							<span class="clickable filter Voltar" id="VoltarTabela"> <i
								class="glyphicon glyphicon-menu-left"></i> Voltar
							</span>
							<span class="clickable filter" data-toggle="tooltip"
								title="Ativar Filtro" data-container="body"> <i
								class="glyphicon glyphicon-filter"></i> Filtrar
							</span>
						</div>
					</div>
					<div class="panel-body"> <!-- Corpo Tabela -->
						<input type="text" class="form-control" id="dev-table-filter"
							data-action="filter" data-filters="#dev-table"
							placeholder="Filtrar Ocorrências" />
					</div>
					<table class="table table-hover" id="dev-table">
						<thead><!-- Cabeçalho Tabela -->
							<tr>
								<th class="text-center">Código</th>
								<th class="text-left">Tipo de Afastamento</th>
								<th class="text-center">Data Inicial</th>
								<th class="text-center">Data Final</th>
								<th class="text-center">Observação</th>
							</tr>
						</thead><!-- Cabeçalho Tabela -->
						<tbody>
		<?php
			foreach ( $Afastamento as $afastamentoRow ) {
				// var_dump($afastamentoRow);
				
				?>
		                  <tr class="">
		                  		<td hidden id="<?php echo "observ_af_" . $afastamentoRow['id_afastamento']; ?>"
		                  			value="<?php echo $afastamentoRow['observ_afastamento']; ?>"></td>
		                  		<td hidden id="<?php echo "id_ocorr_" . $afastamentoRow['id_afastamento']; ?>"
		                  			value="<?php echo $afastamentoRow['id_ocorrencia']; ?>"></td>
								<td class="text-center"><?php echo $afastamentoRow['codigo_ocorrencia']; ?></td>
								<td class="text-left"><?php echo $afastamentoRow['tipo_ocorrencia']; ?></td>
								<td class="text-center" id="<?php echo "dt_ini_" . $afastamentoRow['id_afastamento']; ?>"
									value="<?php echo ExibeData($afastamentoRow['dt_inicio_afastamento']); ?>">
									<?php echo ExibeData($afastamentoRow['dt_inicio_afastamento']); ?></td>
								<td class="text-center" id="<?php echo "dt_fim_" . $afastamentoRow['id_afastamento']; ?>"
									value="<?php echo ExibeData($afastamentoRow['dt_fim_afastamento']); ?>">
									<?php echo ExibeData($afastamentoRow['dt_fim_afastamento']); ?></td>
								<td class="text-left EditarItem" id="<?php echo $afastamentoRow['id_afastamento']; ?>">
									<?php echo $afastamentoRow['observ_afastamento']; ?>
								</td>
							</tr>
		<?php
			}
			?>
		              </tbody>
					</table> <!-- Tabela -->
				</div>
			</div>
		</div>
	<?php
	}
	?>
	</section>
</section> <!-- Fecha Container -->

</div> <!-- Fecha Container -->

