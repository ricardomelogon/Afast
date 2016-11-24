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
			var	dt_inicio_afastamento = $('#dt_inicio_afastamento').val();
			var	dt_fim_afastamento = $('#dt_fim_afastamento').val();
			var	observ_afastamento = $('#observ_afastamento').val();
			var id_ocorrencia = $('#id_ocorrencia').val();
			if ( dt_inicio_afastamento === "" || dt_fim_afastamento === "" || id_ocorrencia === ""){
				return alert('Todos os campos devem ser preenchidos.');
			}
			else{
			$(".cada_docente").each(function(index) {
  				var names = $(this).prev();
  			var	id_docente = $(this).val();
			//2 validar os inputs
			//alert (id_docente);
			
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
					  console.log(data);
					  if(data === 'true'){
						  names.css( "background-color", "lightgreen" );
						  //alert("True");
					  }
					  else{
						 names.css( "background-color", "lightcoral" );
						 //alert("False");
					  }
				 },
				 
				 type: 'POST'
			  		});	
				
				});
				}
			
			
			//3 transferir os dados dos inputs para o arquivo q ira tratar
			
			//4 observar a resposta, e falar pra usuario o que aconteceu
		});

		
	});
</script>

<script type="text/javascript">
	 	
	$("#sel_curso").change(function(){
	    var selcurso = $(this).val();
	    //alert(selcurso);
		$.ajax({
	        type: "POST",
	        url: "cadastro/afastamento/call_docentes_ferias.php",
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
		"timePicker": true,
		"drops": "up",
		"linkedCalendars": false,
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

	$('body').on('focus',".escolhe_data", function(){
	  $('.escolhe_data').on('apply.daterangepicker', function(ev, picker) {
		  var datainicio = $(this).next().val(picker.startDate.format('YYYY-MM-DD'));
		  var datafim = $(this).next().next().val(picker.endDate.format('YYYY-MM-DD'));
		  var from = datainicio.val().split("-");
		  var a = new Date(from[0], from[1] - 1, from[2]);
		  var from = datafim.val().split("-");
		  var b = new Date(from[0], from[1] - 1, from[2]);
		  var _MS_PER_DAY = 1000 * 60 * 60 * 24;
		  var utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
		  var utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());  
		  var dias = Math.floor((utc2 - utc1) / _MS_PER_DAY)+1;
		  var btn = $(this).parent().parent().next().children(".btn");
		  btn.text(dias);
		  var feriastotal = btn.parent().parent().next().children(".feriastotal");
		  feriastotal.text(parseInt(feriastotal.text())+parseInt(btn.text()));
		  
	  });
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
	<li class="active">Lançamento de Férias</li>
</ol>

<br />

<div class="containter well">
<h1 class="text-center">Lançamento de Férias</h1>
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

</div> <!-- Fecha Well -->

<div class="containter well">

  <section class="row"> <!-- Primeira Linha-->
      <section class="col-md-10"> <!-- Lista de Docentes -->
          <label class="control-label">Nome</label>
          <p>LOREM IPSUM DOLOR SIT AMET</p>
      </section> <!-- Lista de Docentes -->
      <section class="col-md-2"> <!-- Lista de Docentes -->
          <label class="control-label">Siape</label>
          <p>1524879</p>
      </section> <!-- Lista de Docentes -->
  </section> <!-- Primeira Linha-->
  <hr class="hrferias">
  <section class="row"><!-- Segunda Linha -->
   <section class="col-md-11">
	<section class="col-md-3"> <!-- Selecionar Datas-->
		<div class="form-group has-feedback has-feedback-right">
    		<label class="control-label">Intervalo 1</label>
    		<i class="form-control-feedback glyphicon glyphicon-calendar"></i>
    <input name="escolhe_data" class="input-mini form-control escolhe_data" type="text">
    <input type="hidden" class="dt_inicio_afastamento" value="<?php echo date("Y-m-d");?>">
    <input type="hidden" class="dt_fim_afastamento" value="<?php echo date("Y-m-d");?>">
		</div>

	</section><!-- Selecionar Datas-->
    <section class="col-md-1"> <!-- Numero de Dias -->
      <label class="control-label">Dias</label>
      <button type="button" class="btn btn-default underbutton" aria-label="Left Align">0
      </button>
    </section> <!-- Numero de Dias -->
    <section class="col-md-3"> <!-- Selecionar Datas-->
		<div class="form-group has-feedback has-feedback-right">
    		<label class="control-label">Intervalo 2</label>
    		<i class="form-control-feedback glyphicon glyphicon-calendar"></i>
    <input name="escolhe_data" class="input-mini form-control escolhe_data" type="text">
    <input type="hidden" class="dt_inicio_afastamento" value="<?php echo date("Y-m-d");?>">
    <input type="hidden" class="dt_fim_afastamento" value="<?php echo date("Y-m-d");?>">
		</div>
	</section><!-- Selecionar Datas-->
    <section class="col-md-1"> <!-- Numero de Dias -->
      <label class="control-label">Dias</label>
      <button type="button" class="btn btn-default underbutton" aria-label="Left Align">0
      </button>
    </section> <!-- Numero de Dias -->
    <section class="col-md-3"> <!-- Selecionar Datas-->
		<div class="form-group has-feedback has-feedback-right">
    		<label class="control-label">Intervalo 3</label>
    		<i class="form-control-feedback glyphicon glyphicon-calendar"></i>
    <input name="escolhe_data" class="input-mini form-control escolhe_data" type="text">
    <input type="hidden" class="dt_inicio_afastamento" value="<?php echo date("Y-m-d");?>">
    <input type="hidden" class="dt_fim_afastamento" value="<?php echo date("Y-m-d");?>">
		</div>
	</section><!-- Selecionar Datas-->
	<section class="col-md-1"> <!-- Numero de Dias -->
      <label class="control-label">Dias</label>
      <button type="button" class="btn btn-default underbutton" aria-label="Left Align">0
      </button>
    </section> <!-- Numero de Dias -->
   </section>
   <section class="col-md-1"> <!-- Numero de Dias -->
      <label class="control-label">Total</label>
      <button type="button" class="btn btn-default underbutton feriastotal" aria-label="Left Align">0
      </button>
      <input type="hidden" class="valorferiastotal">
   </section> <!-- Numero de Dias -->
  </section> <!-- Segunda Linha -->

</div>
