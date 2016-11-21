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
		
		$('.EditarItem').click(function(e) {
			e.preventDefault();
			//loader
			var id= $(this).attr('id');
			//alert(id);
			$('#docenteloader').load('cadastro/docentes/docentes.editar.php',{ id: id});
		});
		
		$('.EditarExercicios').click(function(e) {
			e.preventDefault();
			//loader
			var id= $(this).attr('id');
			//alert(id);
			$('#docenteloader').load('cadastro/docentes/docentes.exercicios.php',{ id: id});
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
$Curso = new Curso ();
$Curso = $Curso->Read ( $_POST ['id'] );
?>

<br>
<ol class="breadcrumb">
	<li><a href="#" id="bread_home">Home</a></li>
	<li><a href="#">Gerenciar Docentes</a></li>
	<li><a href="#">Lista de Dados</a></li>
	<li class="active"> <?php echo $Curso['nome_curso']; ?> </li>
</ol>

<div class="container col-md-12">
	<h1>Docentes lotados em <?php echo $Curso['nome_curso']; ?></h1>
<?php
$Item = new Docente ();
$Item = $Item->ReadAllCurso ( $Curso ['id_curso'] );
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
				<h3 class="panel-title">Docentes</h3>
				<div class="pull-right">
					<span class="clickable filter" id="Voltar"> <i
						class="glyphicon glyphicon-menu-left"></i> Voltar
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
						<th class="text-left">Nome</th>
						<th class="text-center">Siape</th>
						<th class="text-center">E-Mail</th>
						<th class="text-center">Efetivo</th>
						<th class="text-center">Editar Dados</th>
						<th class="text-center">Gerenciar Exerícios</th>
					</tr>
				</thead>
				<tbody>
<?php
	foreach ( $Item as $itemRow ) {
		// var_dump($itemRow);
		if (is_null ( $itemRow ['dt_fim_exercicio'] )) {
			?>
                  <tr class="">
						<td class="text-left"><?php echo $itemRow['nome_docente']; ?></td>
						<td class="text-center"><?php echo $itemRow['siape_docente']; ?></td>
						<td class="text-center"><?php echo $itemRow['email_docente']; ?></td>
						<td class="text-center">
<?php
			if ($itemRow ['efetivo_docente'] == 1) {
				echo "Sim";
			} else {
				echo "Não";
			}
			?>
                    </td>
						<td class="text-center EditarItem"
							id="<?php echo $itemRow['id_docente']; ?>"><span
							class="glyphicon glyphicon-edit" aria-hidden="true"> </span></td>
						<td class="text-center EditarExercicios"
							id="<?php echo $itemRow['id_docente']; ?>"><span
							class="glyphicon glyphicon-list-alt" aria-hidden="true"> </span>
						</td>
					</tr>
<?php
		
}
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
