
<link rel="stylesheet" type="text/css" href="../css/select2.css?v=1.18" />
<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css?v=1.18" />
<script type="text/javascript" src="../js/moment.min.js?v=1.18"></script>
<script type="text/javascript" src="../js/jquery.cascade-select.js?v=1.18"></script>
<script type="text/javascript" src="../js/select2.js?v=1.18"></script>
<script type="text/javascript" src="../js/daterangepicker.js?v=1.18"></script>
<script>
	$(document).ready(function(e) {

		$('#bread_home').click(function(e) {
			e.preventDefault();
			$('#afast_sistema').click();
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
					var s = document.createElement("script");
					s.type = "text/javascript";
					s.src = "../js/viewers/afastamento/afastamento.editar.anoferias.js";
					$("#id_docente").append(s);
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
		    <option value="<?php echo $cursoRow['id_curso'];?>"><?php echo $cursoRow['nome_curso'];?></option>
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
<div class="bottom-pad"></div>































