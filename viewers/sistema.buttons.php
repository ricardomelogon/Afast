
<script>
	$(document).ready(function(e) {

	  $('#gerenciar_docentes').click(function(e) {
		$('.sectionbtn').fadeOut(600, function(){
			$('#loader').load('../viewers/docentes/docentes.lista.php');
		});
	  });
	  
	  $('#gerar_relatorios').click(function(e) {
		$('.sectionbtn').fadeOut(600, function(){
			$('#loader').load('../viewers/relatorio/relatorio.lista.php?v=1.18');
		});
	  });
	  	
    });
</script>
<div style="display:flex;justify-content:center;align-items:center;">Text Content</div>
<?php
require_once "../engine/config.php";
?>
	<div class="col-md-5 sectionbtn" id="gerenciar_docentes">
    	<div class="col-md-1 sectionstepdiv">
			<div style="display:flex;justify-content:center;align-items:center;">
            	<span class="glyphicon glyphicon-record sectionstepglyph"></span>
			</div>
        </div>
        <div class="col-md-11">
        	<div class="col-md-12 sectionicondiv">
				<span class="glyphicon glyphicon-edit sectionglyph"></span>
            </div>
            <div class="col-md-12 sectionicondiv">
        	<a href="#" class="">Gerenciar Frequência</a>
            </div>
        </div>
	</div>
    <div class="col-md-2 sectiondivider"></div>
    <div class="col-md-5 sectionbtn" id="gerar_relatorios" >
    	<div class="col-md-11">
        	<div class="col-md-12 sectionicondiv">
				<span class="glyphicon glyphicon-print sectionglyph"></span>
            </div>
            <div class="col-md-12 sectionicondiv">
        		<a href="#" class="">Gerar Relatórios</a>
            </div>
        </div> 
        <div class="col-md-1 sectionstepdiv">
        	<div style="display:flex;justify-content:center;align-items:center;">
        		<span class="glyphicon glyphicon-record sectionstepglyph"></span>
            </div>    
        </div>   
	</div>