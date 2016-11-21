
<link rel="stylesheet" type="text/css" href="../css/select2.css" />
<link rel="stylesheet" type="text/css" href="../css/boostrap-datepicker3.css" />
<script type="text/javascript" src="../js/moment.min.js"></script>
<script type="text/javascript" src="../js/jquery.cascade-select.js"></script>
<script type="text/javascript" src="../js/select2.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.pt-BR.js"></script>
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
		
		$('#Gerar').click(function(e) {
			e.preventDefault();
			var curso = $('#curso').val();
			var mes = $('#datepicker').val();
			var efetivo = $('#efetivo').val();
			$('#loader').empty();
			$('#printloader').load('gerenciamento/relatorio/relatorio.php',{mes: mes, curso: curso, efetivo:efetivo});			
		});

		
	});
</script>

<script type="text/javascript">
	 	
	$("#sel_curso").change(function(){
	    var selcurso = $(this).val();
	    $.ajax({
	        type: "POST",
	        url: "cadastro/afastamento/call_docentes.php?selcurso="+selcurso,
	        dataType: "text",
	        success: function(res){
	            $("#id_docente").empty();
	            $("#id_docente").append(res);
	        }
	    });
	});

	$('#datepicker').datepicker({
		format: "mm/yyyy",
		startView: "year", 
		minViewMode: "months",
		language: 'pt-BR',
	})

</script>

<?php
require_once "../../../engine/config.php";
?>

<br>
<ol class="breadcrumb">
	<li><a href="#" id="bread_home">Home</a></li>
	<li class="active">Gerar Relatórios</li>
</ol>

<br />

<div class="containter well table-overflow">
<h1 class="text-center">Gerar Relatórios</h1>
<br />
<br />
<section class="row"> <!-- Menu de Voltar -->
	<section class="col-md-12 text-left">
		<section class="btn-group" role="group">
			<button type="button" class="btn btn-info" id="Voltar">
				<span class="glyphicon glyphicon-menu-left"></span>Voltar
			</button>
		</section>
	</section>
</section> <!-- Menu de Voltar -->
<br />
<section class="row"><!-- Primeira Linha -->
	<section class="col-md-2"> <!-- Selecionar Datas-->
		<div class="form-group has-feedback has-feedback-right">
			<label for="startdate" class="control-label">Escolha o mês:</label>
            <i class="form-control-feedback glyphicon glyphicon-calendar"></i>
			<input id="datepicker" name="mes" class="date-picker input-mini form-control" ></input> 
		</div>
	</section><!-- Selecionar Datas-->
    <section class="col-md-2">  <!-- Selecionar Efetivo-->
	<div class="form-group">
		<div class="form-group">
		  <label for="efetivo">Efetivo:</label>
		  <select class="form-control" id="efetivo">
		  <option value=""> -- Selecione -- </option>
		    <option value="1">Sim</option>
            <option value="0">Não</option>
		  </select>
		</div>
	</div>
	</section> <!-- Selecionar Efetivo -->
    <input type="hidden" id="efetivoinput"> 
	<section class="col-md-8">  <!-- Selecionar Curso-->
	<div class="form-group">
		<div class="form-group">
		  <label for="curso">Selecionar Curso:</label>
		  <select class="form-control" id="curso">
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
	</div>
	</section> <!-- Selecionar Curso-->
</section> <!-- Primeira Linha -->

<section class="row"> <!-- Segunda Linha -->
    <section class="col-md-12 text-right">
        <section class="btn-group" role="group">
                <button type="button" class="btn btn-success" id="Gerar">
                    <span class="glyphicon glyphicon-menu"></span>Gerar Relatório
                </button>
        </section>
    </section>
</section> <!-- Segunda Linha-->
</div> <!-- Fecha Well -->

