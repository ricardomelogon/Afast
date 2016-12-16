
<link rel="stylesheet" type="text/css" href="../css/select2.css" />
<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css" />
<script type="text/javascript" src="../js/moment.min.js"></script>
<script type="text/javascript" src="../js/jquery.cascade-select.js"></script>
<script type="text/javascript" src="../js/select2.js"></script>
<script type="text/javascript" src="../js/daterangepicker.js"></script>
<script>
	$(document).ready(function(e) {

		$('#bread_home').click(function(e) {
			e.preventDefault();
			$('#afast_sistema').click();
    	});
		
		$("body").on('click', '.Salvarferias', function(){
			var workId = $(this).attr('id').split('-');
			workId = workId[1];
			var ano_ferias = $('#DataAno-'+workId).val();
			var id_afastamento = $('#idAfastamento-'+workId).val();
			(function(ano_ferias, id_afastamento, workId){  
				$.ajax({
					url: '../engine/controllers/ferias.php',
					data: {
						id_ferias : null,
						ano_ferias : ano_ferias,
						id_afastamento : id_afastamento,
						dt_inicio_afastamento : null,
						dt_fim_afastamento : null,
						observ_afastamento : null,
						id_ocorrencia : null,
						id_docente : null,
						action: 'createsingle'
					},
					error: function() {
						alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
					},
					success: function(data) {
						console.log(data);
						if(data === 'true'){
							alert('Ano adicionado com sucesso.');
							$('#linhaDocente-'+workId).hide();
						}
						else{
							$('#linhaDocente-'+workId).css( "background-color", "lightcoral" );
						}
					}, //Sucesso Ajax2
					type: 'POST'
				}); //Ajax2
			})(ano_ferias, id_afastamento, workId); //Ajax2 Função
		});

	
	
		$("#sel_curso").change(function(){
			var selcurso = $(this).val();
			//alert(selcurso);
			$.ajax({
				type: "POST",
				url: "afastamento/call_editar_ferias.php",
				data: {selcurso: selcurso},
				dataType: "text",
				success: function(res){
					$("#id_docente").empty();
					$("#id_docente").append(res);
				}
			});
		});
		
		$("body").on('focus', '.filtra_ano', function() {
		  $(this).datepicker( {
			  format: " yyyy",
			  viewMode: "years", 
			  minViewMode: "years",
		  });
		});

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
	<li class="active">Editar Férias Marcadas</li>
</ol>

<div class="containter well table-overflow">
	<h2 class="text-center">Editar Férias Marcadas</h2>
    <br>
    <section class="row"><!-- Primeira Linha -->
	<section class="col-md-12">  <!-- Selecionar Curso -->
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
</section> <!-- Primeira Linha -->
<section class="row"> <!-- Segunda Linha-->
	<section class="col-md-12"> <!-- Lista de Docentes -->
		<label for="docentetable">Docentes:</label>
		<table class="table table-hover" id="docentetable">
            <thead>
                <tr>
                    <th class="text-left">Nome</th>
                    <th class="text-left">Data de Início</th>
                    <th class="text-left">Data de Término</th>
                    <th class="text-left">Ano das Férias</th>
                    <th class="text-left">Salvar</th>
                </tr>
            </thead>
            <tbody id="id_docente">
          	</tbody>
        </table>
	</section> <!-- Lista de Docentes -->
</section> <!-- Segunda Linha-->
</div>
































