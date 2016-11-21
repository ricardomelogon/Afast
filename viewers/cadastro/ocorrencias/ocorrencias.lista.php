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
			$('#afast_sistema').click();
    	});
		
		$('#Cadastrar').click(function(e) {
			e.preventDefault();
			//alert("Voltar");
			$('#loader').load('cadastro/ocorrencias/ocorrencias.cadastrar.php');
    	});
		
		$('.EditarItem').click(function(e) {
			e.preventDefault();
			if(confirm("Alterações em uma ocorrência modificam todo o histórico relacionado a ela.\nNão é recomendado alterações a não ser que você tenha certeza de que são necessárias.\nDeseja continuar?"))
			{
			var id= $(this).attr('id');
			$('#loader').load('cadastro/ocorrencias/ocorrencias.editar.php',{ id: id});
			}
		});
		
		//Table filters below
			
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
									var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
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
		})			
	});
</script>

<?php
require_once "../../../engine/config.php";
?>

<br>
<ol class="breadcrumb">
	<li><a href="#" id="bread_home">Home</a></li>
	<li><a href="#">Gerenciar Ocorrências</a></li>
	<li class="active">Lista de Dados</li>
</ol>

<div class="container col-md-12">
	<h1>Lista de Ocorrências</h1>
<?php
$Item = new Ocorrencia ();
$Item = $Item->ReadAll ();
// var_dump($Item);
if (empty ( $Item )) {
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
				<h3 class="panel-title">Ocorrencias</h3>
				<div class="pull-right">
					<span class="clickable" id="Voltar"> <i
						class="glyphicon glyphicon-menu-left"></i> Voltar
					</span> <span class="clickable filter" id="Cadastrar"> <i
						class="glyphicon glyphicon-plus"></i> Cadastrar Nova Ocorrência
					</span> <span class="clickable filter" data-toggle="tooltip"
						title="Ativar Filtro" data-container="body"> <i
						class="glyphicon glyphicon-filter"></i> Filtrar
					</span>
				</div>
			</div>
			<div class="panel-body">
				<input type="text" class="form-control" id="dev-table-filter"
					data-action="filter" data-filters="#dev-table"
					placeholder="Filtrar Docentes" />
			</div>
			<table class="table table-hover" id="dev-table">
				<thead>
					<tr>
						<th class="text-left">Tipo</th>
						<th class="text-center">Código</th>
						<th class="text-center">Editar</th>
					</tr>
				</thead>
				<tbody>
<?php
	foreach ( $Item as $itemRow ) {
		// var_dump($itemRow);
		
		?>
                  <tr class="">
						<td class="text-left"><?php echo $itemRow['tipo_ocorrencia']; ?></td>
						<td class="text-center"><?php echo $itemRow['codigo_ocorrencia']; ?></td>
						<td class="text-center EditarItem"
							id="<?php echo $itemRow['id_ocorrencia']; ?>"><span
							class="glyphicon glyphicon-edit" aria-hidden="true"> </span></td>
					</tr>
<?php
	}
	?>
              </tbody>
			</table>
		</div>
	</div>
</div>
<?php
}
?>