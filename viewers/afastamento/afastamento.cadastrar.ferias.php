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
		  	var contagemDiasTotal = 0;
		  	$('.feriastotal').each(function(index) {
				if($(this).val() == 45 || $(this).val() == 0){}
				else{contagemDiasTotal++;}
		  	});
		  	if(contagemDiasTotal != 0){
		 		alert("Todo docente deve ter exatamente 45 dias de férias no total.")
		  	}
		  	else{
				$(".cada_docente").each(function(index) {
					count = $(this).children('.segundalinha').children('.col-md-11').children('.feriasid').val();
					var id_docente = $('#docenteid-'+count).val();
					var ano_ferias = $('#filtra_ano').val();
					for (i = 1; i <= 3; i++) {
						var dt_inicio_afastamento = $('#dt_inicio_afastamento-'+i+'-'+count).val();
						var dt_fim_afastamento = $('#dt_fim_afastamento-'+i+'-'+count).val();
						var id_afastamento = $('#id_afastamento-'+i+'-'+count).val();
						if ( dt_inicio_afastamento === "" || dt_fim_afastamento === ""){}
						else{
						  	var closure = $('#docentedata-'+i+'-'+count);
						  	var docenteNome = $('#DocenteNome-'+count).text();
						  	(function(closure, docenteNome, i, dt_inicio_afastamento, dt_fim_afastamento, id_docente, ano_ferias, id_afastamento){
								var defineOverlap;
								var defineAddress;
								var defineAction;
								//alert(id_afastamento);
								if(id_afastamento === ""){
									defineOverlap = 'overlap';
									defineAddress = '../engine/controllers/ferias.php';
									defineAction = 'create';
									id_afastamento = null;
									//alert('sem id');

								}
								else{
									defineOverlap = 'overlapupdate';
									defineAddress = '../engine/controllers/afastamento.php';
									defineAction = 'update';
									//alert('com id');

								}
								$.ajax({
									url: '../engine/controllers/afastamento.php',
									type: 'POST',
									data: {
										id_afastamento  : id_afastamento,
										dt_inicio_afastamento : dt_inicio_afastamento,
										dt_fim_afastamento : dt_fim_afastamento,
										observ_afastamento : null,
										id_ocorrencia : 37,
										id_docente : id_docente,
										action: defineOverlap
									},
									success: function(data) {
										if (data == "true"){proceedOverlap = true;}
										else{
											var proceedOverlap = confirm("O Intervalo "+i+" de férias do docente "+docenteNome+" coincide com afastamentos já existentes. Deseja continuar?");
										} 
										if (proceedOverlap) {
										  	(function(dt_inicio_afastamento, dt_fim_afastamento, id_docente, ano_ferias, id_afastamento, defineAddress, defineAction){  
												$.ajax({
													url: defineAddress,
													data: {
														id_ferias : null,
														ano_ferias : ano_ferias,
														id_afastamento  : id_afastamento,
														dt_inicio_afastamento : dt_inicio_afastamento,
														dt_fim_afastamento : dt_fim_afastamento,
														observ_afastamento : null,
														id_ocorrencia : 37,
														id_docente : id_docente,
														action: defineAction
													},
													error: function() {
														alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
													},
													success: function(data) {
														//console.log(data);
														if(data === 'true'){
															closure.css( "background-color", "lightgreen" );
														}
														else{
															closure.css( "background-color", "lightcoral" );
														}
													}, //Sucesso Ajax2
													type: 'POST'
												}); //Ajax2
										  	})(dt_inicio_afastamento, dt_fim_afastamento, id_docente, ano_ferias, id_afastamento, defineAddress, defineAction); //Ajax2 Função
										} //If sobreposição
									} //Sucesso Ajax1
								}); //Ajax1
						  	})(closure, docenteNome, i, dt_inicio_afastamento, dt_fim_afastamento, id_docente, ano_ferias, id_afastamento); //Ajax1 Função
						} // Else não está vazio
					} //Cada Afastamento - For  
				}); // Cada Docente
		  	} //Else
		}); //Salvar
		
	}); // Document Ready
</script>

<script type="text/javascript">
	 	
	$("#sel_curso").change(function(){
	    var selcurso = $(this).val();
		var selano = $('#filtra_ano').val();
	    if(selcurso != "" && selano != ""){
		  $.ajax({
			  type: "POST",
			  url: "afastamento/call_docentes_ferias.php",
			  data: {selcurso: selcurso, selano: selano},
			  dataType: "text",
			  success: function(res){
				  $("#docentelista").empty();
				  $("#docentelista").append(res);
			  }
		  });
		}
	});
	
	$("body").on('focus', '.escolhe_data', function() {
		$(this).daterangepicker
		({
	    showDropdowns: true,
		"timePicker": true,
		"drops": "up",
		"linkedCalendars": false,
		autoUpdateInput: false,
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
		function(start, end, label) 
		{
	  //console.log($('#escolhe_data').data());

		}).on('apply.daterangepicker', function(ev, picker) {
		  $(this).val(picker.startDate.format('DD/MM/YYYY') + " - " + picker.endDate.format('DD/MM/YYYY'));	
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
		  var thisdateid = $(this).prev().val();
		  var feriasid = $(this).parent().parent().parent().children('.feriasid').val();
		  //alert(thisdateid);
		  //alert(feriasid);
		  
		  var btn = $('#btnvalor'+'-'+thisdateid+'-'+feriasid);
		  btn.val(dias);
		  btn.prev().text(dias);
		  var btn1val = parseInt($('#btnvalor-1-'+feriasid).val());
		  var btn2val = parseInt($('#btnvalor-2-'+feriasid).val());
		  var btn3val = parseInt($('#btnvalor-3-'+feriasid).val());
		  var total = $('#valorferiastotal-'+feriasid).val(btn1val+btn2val+btn3val);
		  total.prev().text(total.val());
			
			});
	});
	
	$("#filtra_ano").datepicker( {
    format: " yyyy",
    viewMode: "years", 
    minViewMode: "years",
	});
	
	$("#filtra_ano").change(function(){
		$("#sel_curso").trigger('change');	
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
	<li class="active">Lançamento de Férias</li>
</ol>

<br />

<div class="containter well">
<h2 class="text-center">Lançamento de Férias</h2>
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
	<section class="col-md-8">  <!-- Selecionar Curso -->
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
    <section class="col-md-4"> <!-- Selecionar Ano-->
		<div class="form-group has-feedback has-feedback-right">
			<label for="startdate" class="control-label">Escolha o ano:</label>
            <i class="form-control-feedback glyphicon glyphicon-calendar"></i>
			<input id="filtra_ano" name="filtra_ano" class="date-picker input-mini form-control filtra_ano"></input> 
		</div>
	</section><!-- Selecionar Ano-->
    
</section> <!-- Primeira Linha -->

</div> <!-- Fecha Well -->

<section id="docentelista"> <!-- Docentes -->

</section> <!-- Docentes -->