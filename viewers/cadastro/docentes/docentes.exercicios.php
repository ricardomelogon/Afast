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
		

		$('#CadastrarExercicio').click(function(e) {
			e.preventDefault();
			
			var DatasFim = document.getElementsByClassName("dt_fim_exercicio");
			var Test = true;
			for(i = 0; i < DatasFim.length; i++)
			{
				if($(DatasFim[i]).val() === "")
				{
					Test = false;
					break;
				}
			}
			if (!Test)
			{
				alert("Já existe um exercício ativo.");
			}
			else
			{
			var id= $('#Docente_Exercicio_id').val();
			//alert(id);
			$('#docenteloader').load('cadastro/docentes/docentes.exercicio.cadastrar.php', { id: id});
			}
    	});
		
		$('.exercdatepicker').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "pt-BR",
			orientation: "bottom",
			autoclose: true
		});
		
		$('.exercdatepicker').on("changeDate", function() {
    		var Element = $(this).parent();
			Element.children(".dt_fim_exercicio").val(
				Element.children(".exercdatepicker").datepicker('getFormattedDate')
			);
			
			if(confirm("Essa ação vai terminar ou modificar a data de término do exercício desse docente para a data selecionada, deseja prosseguir?")){
			//1 instansciar e recuperar valores dos inputs
			var id_exercicio = Element.children('.id_exercicio').val();
			var id_docente = Element.children('.id_docente').val();
			var id_curso = Element.children('.id_curso').val();
			var dt_inicio_exercicio = Element.children('.dt_inicio_exercicio').val();
			var dt_fim_exercicio = Element.children('.dt_fim_exercicio').val();
			
			
			//2 validar os inputs
			if(id_exercicio === "" || id_docente === "" || id_curso === "" || dt_inicio_exercicio === "" || dt_fim_exercicio === ""){
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
						action: 'end'
				   },
				   error: function() {
						alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
				   },
				   success: function(data) {
						console.log(data);
						if(data === 'true'){
							var id = $("#Docente_Exercicio_id").val();
							alert('Exercício do docente terminado.');
							$('#docenteloader').load('cadastro/docentes/docentes.exercicios.php',{ id: id});
						}
						else{
							alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');	
						}
				   },
				   
				   type: 'POST'
				});		
			}
																								}
		});
		
		$('.EditarItem').click(function(e) {
			e.preventDefault();
			if(confirm("Alterações em um exercício modificam todo o histórico relacionado a ele.\nNão é recomendado alterações a não ser que você tenha certeza de que são necessárias.\nDeseja continuar?"))
			{
			var id = $(this).attr('id');
			$('#docenteloader').load('cadastro/docentes/docentes.exercicios.editar.php',{ id: id});
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
	<li><a href="#">Gerenciar Docentes</a></li>
	<li><a href="#">Menu</a></li>
	<li class="active">Terminar Exercicio</li>
</ol>

<div class="container col-md-12">
	<h1>Terminar ou Ativar Exercícios</h1>
    
<?php
$Docente = new Docente ();
$Docente = $Docente->Read ( $_POST ['id'] );
$Exercicio = new Exercicio ();
$Exercicio = $Exercicio->ReadbyDocente ( $_POST ['id'] );
$Curso = new Curso ();
$Curso = $Curso->ReadAll ();
// var_dump($Docente);
// var_dump ( $Exercicio );
// var_dump($Curso);
?>
	<h3><?php echo $Docente['nome_docente']?></h3>
<?php
if (empty ( $Exercicio )) {
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
				<h3 class="panel-title">Exercicios do(a) docente</h3>
				<div class="pull-right">
					<span class="clickable filter" id="Voltar"> <i
						class="glyphicon glyphicon-menu-left"></i> Voltar
					</span> <span class="clickable" id="CadastrarExercicio"> <i
						class="glyphicon glyphicon-plus"></i> Cadastrar Novo Exercício
					</span> <span class="clickable filter" data-toggle="tooltip"
						title="Ativar Filtro" data-container="body"> <i
						class="glyphicon glyphicon-filter"></i> Filtrar
					</span>
				</div>
			</div>
			<div class="panel-body">
				<input type="text" class="form-control" id="dev-table-filter"
					data-action="filter" data-filters="#dev-table"
					placeholder="Filtrar Exercicios" />
			</div>
			<table class="table table-hover" id="dev-table">
				<thead>
					<tr>
						<th class="text-left">Curso</th>
						<th class="text-center">Data de Inicio</th>
						<th class="text-center">Data de Término</th>
						<th class="text-center">Editar</th>
						<th class="text-center">Desativar</th>
					</tr>
				</thead>
				<tbody>
<?php
	
	if (count ( $Exercicio ) == count ( $Exercicio, COUNT_RECURSIVE )) {
		$Exercicio = array (
				$Exercicio 
		);
	}
	foreach ( $Exercicio as $itemRow ) {
		// var_dump($itemRow);
		?>
                  <tr class="">
						<td class="text-left">
<?php
		foreach ( $Curso as $LinhaCurso ) {
			if ($itemRow ['id_curso'] === $LinhaCurso ['id_curso']) {
				echo $LinhaCurso ['nome_curso'];
				break;
			}
		}
		?>                    
                    </td>
						<td class="text-center">
						<?php echo date("d-m-Y",strtotime($itemRow['dt_inicio_exercicio'])); ?>
                    </td>
						<td class="text-center">
<?php
		if ($itemRow ['dt_fim_exercicio'] === NULL) {
			echo "Exercício Ativo";
		} else {
			echo date ( "d-m-Y", strtotime ( $itemRow ['dt_fim_exercicio'] ) );
		}
		?>
                    </td>
						<td class="text-center EditarItem"
							id="<?php echo $itemRow['id_exercicio']; ?>"><span
							class="glyphicon glyphicon-edit" aria-hidden="true"> </span></td>
						<td class="text-center exercdatepicker DesativarItem"
							title="Clique para escolher a data de término"><span
							class="glyphicon glyphicon-remove-circle" aria-hidden="true"> </span>
						</td>
						<input type="hidden"
							value="<?php echo $itemRow['id_exercicio']; ?>"
							class="id_exercicio">
						<input type="hidden" value="<?php echo $itemRow['id_docente']; ?>"
							class="id_docente">
						<input type="hidden" value="<?php echo $itemRow['id_curso']; ?>"
							class="id_curso">
						<input type="hidden"
							value="<?php echo $itemRow['dt_inicio_exercicio']; ?>"
							class="dt_inicio_exercicio">
						<input type="hidden"
							value="<?php echo $itemRow['dt_fim_exercicio']; ?>"
							class="dt_fim_exercicio">
					</tr>
<?php
	}
	?>
              </tbody>
			</table>
		</div>
	</div>
	<input type="hidden" value="<?php echo $Docente['id_docente']; ?>"
		id="Docente_Exercicio_id">
	<div class="bottom-pad"></div>
</div>
<?php
}
?>

