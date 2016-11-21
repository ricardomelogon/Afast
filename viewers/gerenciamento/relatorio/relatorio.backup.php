
<?php

require_once('../../../engine/config.php');
	
$MesForm = $_POST['mes'];
$curso = $_POST['curso'];

list($mes, $ano)=explode("/", $MesForm);

function fixfirstdate($string, $newmes, $newano)
{
	list($ano, $mes, $dia)=explode("-", $string);
	$flag = false;
	if ($ano < $newano){ 	$ano = $newano;	$flag = true;}
	if ($mes < $newmes){	$mes = $newmes;	$flag = true;}
	if($flag){$dia = '01';}
	$result = $ano."-".$mes."-".$dia;
	return($result);
	
}

function fixlastdate($string, $newmes, $newano)
{
	list($ano, $mes, $dia)=explode("-", $string);
	$flag = false;
	if ($ano > $newano){ 	$ano = $newano;	$flag = true;}
	if ($mes > $newmes){	$mes = $newmes;	$flag = true;}
	if($flag){$dia = date('t',mktime(0, 0, 0, $mes, 1, $ano));}
	$result = $ano."-".$mes."-".$dia;
	return($result);
}

function getquantdays($inicio, $fim)
{
	list($anoinicio, $mesinicio, $diainicio)=explode("-", $inicio);
	list($anofim, $mesfim, $diafim)=explode("-", $fim);
	$result = $diafim - ($diainicio -1);
	return($result);
}

function getlistday($inicio, $fim)
{
	list($anoinicio, $mesinicio, $diainicio)=explode("-", $inicio);
	list($anofim, $mesfim, $diafim)=explode("-", $fim);
	$result = "";
	for($i = $diainicio; $i <= $diafim; $i++)
	{
		$result .= $i."-";
	}
	$offset = strlen($result)-1;
	$result = substr($result,0,$offset);
	return($result);
}


setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>ICT AFAST - Relatório Mensal</title>
    <link rel="stylesheet" media="print" href="../../../css/print.css">
</head>

<body>

<section class="row">
  <section class="col-md-2"></section>
  <section class="col-md-1">
          <img 
              class="img-responsive"
              height="100px"
              width="100px"
              src="../img/logo_brasao_republica.png"
              alt="Brasao"
          >
  </section>

  <section class="col-md-6">
  	<section class="text-center">
    	<h3> MINISTÉRIO DA EDUCAÇÃO </h3>
        <h4><strong> UNIVERSIDADE FEDERAL DOS VALES DO JEQUITINHONHA E MUCURI </strong></h4>
    </section>
  </section>
  
  <section class="col-md-1">
          <img 
              class="img-responsive"
              height="100px"
              width="100px"
              src="../img/logo_ufvjm.gif"
              alt="Logo UFVJM"
           >
  </section>
  <section class="col-md-2"></section>
</section>
<section class="row">
	<section class="text-center">
    	<h3 class="lessmarginbot"> INSTITUTO DE CIÊNCIA DE TECNOLOGIA </h3>
        <h3 class="lessmarginbot lessmargintop"> BOLETIM DE FREQUÊNCIA </h3>
        <h3 class="lessmarginbot lessmargintop"> <?php echo (strtoupper( strftime( "%B" , mktime(0, 0, 0, $mes+1, 0, 0) ) ) ); echo "/"; echo $ano;?> </h3>
    </section>
</section>
<br><br><br>     

<?php
	$Docente = new Docente();
	$Docente = $Docente->ReadAllCurso($curso);
	$Afastamento = new Afastamento();
	$Afastamento = $Afastamento->ReadAllReport($mes, $ano, $curso);
	if(empty($Afastamento)) {}
	else
	{
	  if (count ( $Afastamento ) == count ( $Afastamento, COUNT_RECURSIVE )) {
		  $Afastamento = array (
				  $Afastamento 
		  );
	  }
	  foreach($Afastamento as &$AfastamentoRow)
	  {
		  $AfastamentoRow['dt_inicio_afastamento'] = 
			  fixfirstdate($AfastamentoRow['dt_inicio_afastamento'],$mes,$ano);
		  
		  $AfastamentoRow['dt_fim_afastamento'] = 
			  fixlastdate($AfastamentoRow['dt_fim_afastamento'],$mes,$ano);
	  }
	  //var_dump($Afastamento);
	}
	foreach ($Docente as $DocenteRow)
	{
		$Quantidade = 0;
		$DiasEfetivos = date('t',mktime(0, 0, 0, $mes, 1, $ano));
		?>
        <section class="row">
        <section>
        	<section class="col-md-2"></section>
        	<section class="col-md-8 printcenter">
        		<p class="docenteheader" >
                	<span class="tabspaceright">Servidor(a): 
                    	<strong><?php echo $DocenteRow['nome_docente'];?></strong></span>
                    <span class="tabspaceleft">SIAPE: 
                    	<strong><?php echo $DocenteRow['siape_docente']?></strong></span>
                </p>
                <table class="tablesize">
                  <tr class="simpleborder">
                    <th class="simpleborder rel_ocorrencia"><strong>Ocorrência:</strong></th>
                    <th class="simpleborder rel_descricao"><strong>Descrição:</strong></th>
                    <th class="simpleborder rel_quantidade"><strong>Quantidade:</strong></th>
                    <th class="simpleborder rel_diasdomes"><strong>Dias do Mês:</strong></th>
                  </tr>
                <?php
					foreach($Afastamento as $indice => $AfastamentoRow)
					{
						if($AfastamentoRow['siape_docente'] == $DocenteRow['siape_docente'])
						{
				?>
                  <tr class="simpleborder">
                  	<td class="simpleborder"> <?php echo $AfastamentoRow['codigo_ocorrencia'] ?> </td>
                    <td class="simpleborder"> <?php echo $AfastamentoRow['tipo_ocorrencia']?></td>
                    <td class="simpleborder"> 
				<?php 
					echo  $quantdays = 
			getquantdays($AfastamentoRow['dt_inicio_afastamento'],$AfastamentoRow['dt_fim_afastamento']);
					$Quantidade = $Quantidade + $quantdays;
					unset($Afastamento[$indice]);
				?>
                    </td>
                    <td class="simpleborder">
				 <?php
				 	echo 
			getlistday($AfastamentoRow['dt_inicio_afastamento'],$AfastamentoRow['dt_fim_afastamento']);
                 ?>
                    </td>
                  </tr>
				 <?php
						}
					}
				 ?>
                </table>
                <?php
					$DiasEfetivos = $DiasEfetivos - $Quantidade;
				?>
                <p>
                	<span class="tabspacerightbottom">
                    	<strong>Efetivo: <?php echo $DiasEfetivos; ?>
                        </strong>
                    </span>
                    <span class="tabspaceright">
                    	<strong>Afastamento/Ocorrência: <?php echo $Quantidade; ?>
                        </strong>
                    </span>
                </p>
           		<section class="rel_endline"></section>
            </section>
            <section class="col-md-2"></section>
        </section>
        </section>
		<?php
	}
?>
<section class="col-md-2"></section>
<section class="col-md-8 signaturemargin tablesize printcenter">
	<span class="printdate signaturetop col-md-3"><h4><strong>Em <?php echo date('d-m-Y');?></strong></h4></span>
    <span class="signatureline signaturetop col-md-5"><h4><strong>ENCARREGADO DA FREQUÊNCIA</strong></h4></span>
    <span class="signatureline signaturetop col-md-4"><h4><strong>CHEFE DA SEÇÃO</strong></h4></span>
</section>
<section class="col-md-2"></section>

</body>