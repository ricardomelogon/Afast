
<script>
	$(document).ready(function(e) {

	  $('#gerenciar_docentes').click(function(e) {
		$('#loader').css('overflow','hidden');
		$('#loader').animate({left: "-100vw"},600, function(){
			$('#loader').empty();
			$('#loader').css("left", "0vw");
			$('#loader').css('overflow','auto');
			$('#loader').load('../viewers/docentes/docentes.lista.php');
		});
	  });
	  
	  $('#gerar_relatorios').click(function(e) {
		$('#loader').css('overflow','hidden');
		$('#loader').animate({left: "100vw"},600, function(){
			$('#loader').empty();
			$('#loader').css("left", "0vw");
			$('#loader').css('overflow','auto');
			$('#loader').load('../viewers/relatorio/relatorio.lista.php');
		});
	  });
	  	
    });
</script>

<?php
require_once "../engine/config.php";
?>
	<div class="col-md-5 sectionbtn" id="gerenciar_docentes">
    	<div class="col-md-1 sectionstepdiv">
        	<span class="glyphicon glyphicon-chevron-left sectionstepglyph"></span>
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
        	<span class="glyphicon glyphicon-chevron-right sectionstepglyph"></span>
        </div>   
	</div>