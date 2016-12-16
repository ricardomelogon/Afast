<?php
require_once('../../engine/config.php');
$IdDocente = $_POST['iddocente'];
$MesAnoAfastamento = $_POST['filtra_mes'];
//var_dump($MesAfastamento);
$MesAnoAfastamento = explode ( '/', $MesAnoAfastamento);
$MesAfastamento = $MesAnoAfastamento[0];
$AnoAfastamento = $MesAnoAfastamento[1];
$StartDiaAfastamento = 1;
$EndDiaAfastamento = cal_days_in_month(CAL_GREGORIAN,$MesAfastamento,$AnoAfastamento);

$StartData = $AnoAfastamento.'-'.$MesAfastamento.'-'.$StartDiaAfastamento;
$EndData = $AnoAfastamento.'-'.$MesAfastamento.'-'.$EndDiaAfastamento;

?>
<script type="text/javascript">


$(".EditarItem").click(function (e){
	e.preventDefault();
	var id = $(this).attr('id');
	$('#escolhe_data').data('daterangepicker').setStartDate($('#dt_ini_'+id).attr('value'));
	$('#escolhe_data').data('daterangepicker').setEndDate($('#dt_fim_'+id).attr('value'));
	$('#dt_inicio_afastamento').val($('#escolhe_data').data('daterangepicker').startDate.format('YYYY-MM-DD'));
	$('#dt_fim_afastamento').val($('#escolhe_data').data('daterangepicker').endDate.format('YYYY-MM-DD'));
	$("#escolhe_data").prop('disabled', false);
	$('#id_ocorrencia').val($('#id_ocorr_'+id).attr('value'));
	$('#id_ocorrencia').trigger('change.select2');
	$("#id_ocorrencia").prop('disabled', false);
	$('#observ_afastamento').val($('#observ_af_'+id).attr('value'));
	$('#id_afastamento').val($(this).attr('id'));
	$('#Excluir').show();
	$("#DetalhesAfastamento").show();
	$("#AjudaEditarAfastamento").hide();
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

	$('#VoltarTabela').click(function(e) {
		e.preventDefault();
		//alert("Voltar");
		$('#docenteloader').load('../viewers/afastamento/afastamento.listar.php');
	}); 

	$('#Inserir').click(function(e) {
		e.preventDefault();
			var id= $('#id_docente').val();
			//alert(id);
			$('#docenteloader').load('afastamento/afastamento.editar.php',{ id: id});
	});
})
</script>
<section class="col-md-12">
<div id="id_afastamento" hidden="true"></div>
<?php
$Afastamento = new Afastamento();
$Afastamento = $Afastamento->ReadAllOverlaps($IdDocente, $StartData, $EndData);
// var_dump($Item);
if (empty ( $Afastamento )) {
	?>
		    	<br>
			<br>
			<h4 class="well text-center" id="NenhumDado">Nenhum dado encontrado.</h4>
		<?php
		} else {
			?>
		  <div class="filterrow">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Afastamentos</h3>
						<div class="pull-right">
							<span class="clickable filter Voltar" id="VoltarTabela"> <i
								class="glyphicon glyphicon-menu-left"></i> Voltar
							</span> <span class="clickable filter" id="Inserir"> <i
								class="glyphicon glyphicon-plus"></i> Inserir Afastamento para o Docente</span>
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
								<th class="text-center">Editar</th>
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
								<td class="text-center EditarItem" id="<?php echo $afastamentoRow['id_afastamento']; ?>">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"> </span>
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
