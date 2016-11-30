
<link rel="stylesheet" type="text/css" href="../css/select2.css" />
<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css" />
<script type="text/javascript" src="../js/moment.min.js"></script>
<script type="text/javascript" src="../js/jquery.cascade-select.js"></script>
<script type="text/javascript" src="../js/select2.js"></script>
<script type="text/javascript" src="../js/daterangepicker.js"></script>
<script>
	$(document).ready(function(e) {
		//$('#dt_inicio_afastamento').val(moment().format('L'));
		//$('#dt_fim_afastamento').val(moment().format('L'));
		/*bootbox.alert('<br /><div class="alert alert-danger"><strong>Atenção!</strong><p>Este sistema ainda não controla múltiplos afastamentos em uma mesma data.</p></div>');*/

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
          var dt_inicio_afastamento = $('#dt_inicio_afastamento').val();
          var dt_fim_afastamento = $('#dt_fim_afastamento').val();
          var observ_afastamento = $('#observ_afastamento').val();
          var id_ocorrencia = $('#id_ocorrencia').val();
          if ( dt_inicio_afastamento === "" || dt_fim_afastamento === "" || id_ocorrencia === ""){
            return alert('Todos os campos devem ser preenchidos.');
          }
          else{
            $(".cada_docente").each(function(index) {
              var names = $(this).prev();
              var id_docente = $(this).val();
              var nomeSerie = names.children('.nomeSerie').text();
              (function(names, nomeSerie, dt_inicio_afastamento, dt_fim_afastamento, id_docente, observ_afastamento, id_ocorrencia){
                $.ajax({
                  url: '../engine/controllers/afastamento.php',
                  type: 'POST',
                  data: {
                    id_afastamento  : null,
                    dt_inicio_afastamento : dt_inicio_afastamento,
                    dt_fim_afastamento : dt_fim_afastamento,
                    observ_afastamento : observ_afastamento,
                    id_ocorrencia : id_ocorrencia,
                    id_docente : id_docente,
                    action: 'overlap'
                  },
                  success: function(data) {
                    if (data == "true"){proceedOverlap = true;}
                    else{
                    var proceedOverlap = confirm("O afastamento do docente "+nomeSerie+" coincide com afastamentos já existentes. Deseja continuar?");
                    } 
                    if (proceedOverlap) {
                      (function(names, dt_inicio_afastamento, dt_fim_afastamento, id_docente, observ_afastamento, id_ocorrencia){  
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
                            //console.log(data);
                            if(data === 'true'){
                              names.css( "background-color", "lightgreen" );
                            }
                            else{
                             names.css( "background-color", "lightcoral" );
                            }
                          }, //Sucesso Ajax2
                          type: 'POST'
                        }); //Ajax2
                      })(names, dt_inicio_afastamento, dt_fim_afastamento, id_docente, observ_afastamento, id_ocorrencia); //Ajax2 Função
                    } //If sobreposição
                  } //Sucesso Ajax1
                }); //Ajax1
              })(names, nomeSerie, dt_inicio_afastamento, dt_fim_afastamento, id_docente, observ_afastamento, id_ocorrencia); //Ajax1 Função
            }); // Cada Docente
          } //Else dados colocados
        }); // Salvar

	}); //Document Ready
</script>

<script type="text/javascript">
	 	
	$("#sel_curso").change(function(){
	    var selcurso = $(this).val();
	    //alert(selcurso);
		$.ajax({
	        type: "POST",
	        url: "cadastro/afastamento/call_docentes_serie.php",
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
	    autoApply: true,
	    autoUpdateInput: true,
		"timePicker": true,
		"drops": "up",
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

	$('#escolhe_data').on('apply.daterangepicker', function(ev, picker) {
		$('#dt_inicio_afastamento').val(picker.startDate.format('YYYY-MM-DD'));
		$('#dt_fim_afastamento').val(picker.endDate.format('YYYY-MM-DD'));
	});
	$("#id_ocorrencia").select2({
		  language: "pt-BR",
		  placeholder: "Digite para buscar a ocorrência"
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
	<li class="active">Inserir Afastamentos em Série</li>
</ol>

<br />

<div class="containter well table-overflow">
<h1 class="text-center">Inserir Afastamento em Série</h1>
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

<section class="row"><!-- Segunda Linha -->
	<section class="col-md-12"> <!-- Selecionar Datas-->
		<div class="form-group has-feedback has-feedback-right">
			<input type="hidden" id="dt_inicio_afastamento" value="<?php echo date("Y-m-d");?>">
			<input type="hidden" id="dt_fim_afastamento" value="<?php echo date("Y-m-d");?>">
			<label class="control-label">Escolha o intervalo de datas</label>
			<i class="form-control-feedback glyphicon glyphicon-calendar"></i>
			<input id="escolhe_data" name="escolhe_data" class="input-mini form-control" type="text">
		</div>
	</section><!-- Selecionar Datas-->	
</section> <!-- Segunda Linha -->

<section class="row"> <!-- Terceira Linha -->
	<section class="col-md-12">  <!-- Selecionar Ocorrência-->
	<div class="form-group">
		<label for="id_ocorrencia">Selecionar a Ocorrência:</label>
		<select class="form-control" id="id_ocorrencia" style="width: 100%">
		<option value=""> -- Selecione -- </option>
		<?php 
		    $Ocorrencia = new Ocorrencia();
		    $Ocorrencia = $Ocorrencia->ReadAll();
		    if(empty($Ocorrencia)){
		    ?>
		    	<option>Nenhuma Ocorrência Encontrada</option>
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
</section> <!-- Terceira Linha-->

<section class="row"> <!-- Terceira Linha-->
	<section class="col-md-12"> <!-- Campo de Observação -->
		<label for="observ_afastamento">Observação:</label>
		<textarea class="form-control" rows="2" id="observ_afastamento" maxlength="195"></textarea>
	</section> <!-- Campo de Observação -->
</section> <!-- Terceira Linha-->

<section class="row"> <!-- Quarta Linha-->
	<section class="col-md-12"> <!-- Lista de Docentes -->
		<label for="docentetable">Docentes:</label>
		<table class="table table-hover" id="docentetable">
            <thead>
                <tr>
                    <th class="text-left">Nome</th>
                    <th class="text-left">Siape</th>
                </tr>
            </thead>
            <tbody id="id_docente">
          	</tbody>
        </table>
	</section> <!-- Lista de Docentes -->
</section> <!-- Quarta Linha-->

</div> <!-- Fecha Well -->

