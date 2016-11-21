
<?php

require_once('../../../engine/config.php');
	
$MesForm = $_POST['mes'];
$curso = $_POST['curso'];
$efetivo = $_POST['efetivo'];
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

function diasefetivos($start,$end,$mes,$ano)
{
	$daysmonth = date('t',mktime(0, 0, 0, $mes, 1, $ano));
	
	$thismonthstart = mktime(0, 0, 0, $mes, 1, $ano);
	$thismonthend = mktime(0, 0, 0, $mes, $daysmonth, $ano);
	
	list($anoinit, $mesinit, $diainit)=explode("-", $start);
	$startdate = mktime(0, 0, 0, $mesinit, $diainit, $anoinit);
	
	if(!($end == NULL))
	{
		list($anofim, $mesfim, $diafim)=explode("-", $end);
		$enddate = mktime(0, 0, 0, $mesfim, $diafim, $anofim);
	}
	else 
	{
		$enddate = mktime(0, 0, 0, $mes, $daysmonth, $ano);
	}
	
	if($startdate > $thismonthstart) {$thismonthstart = $startdate;}
	if($enddate < $thismonthend) {$thismonthend = $enddate;}
	
	$result = date('d',$thismonthend) - date('d',$thismonthstart);
	return($result) +1;
	
}

function fixbystart($afastdate, $startdate)
{
	list($anoafast, $mesafast, $diaafast)=explode("-", $afastdate);
	list($anostart, $messtart, $diastart)=explode("-", $startdate);
	$newstartdate = mktime(0, 0, 0, $messtart, $diastart, $anostart);
	$newafastdate = mktime(0, 0, 0, $mesafast, $diaafast, $anoafast);
	if ($newafastdate < $newstartdate)
	{
		$newafastdate = $newstartdate;
	}
	return date('Y-m-d',$newafastdate); 
}
function fixbyend($afastdate, $enddate)
{
	if(!($enddate == NULL))
	{
	  list($anoafast, $mesafast, $diaafast)=explode("-", $afastdate);
	  list($anoend, $mesend, $diaend)=explode("-", $enddate);
	  $newenddate = mktime(0, 0, 0, $mesend, $diaend, $anoend);
	  $newafastdate = mktime(0, 0, 0, $mesafast, $diaafast, $anoafast);
	  if ($newafastdate > $newenddate)
	  {
		  $newafastdate = $newenddate;
	  }
	  return date('Y-m-d',$newafastdate);
	}
	else
	{
		return $afastdate;
	}   

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
    <link rel="stylesheet" media="print" href="../css/print.css">
</head>

<body>

<section class="navprintmargin2"></section>
<section class="row headmargin">
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

  <section class="col-md-6 nopadding">
  	<section class="text-center">
    	<h3> MINISTÉRIO DA EDUCAÇÃO </h3>
        <h5><strong> UNIVERSIDADE FEDERAL DOS VALES DO JEQUITINHONHA E MUCURI </strong></h5>
    </section>
  </section>
  
  <section class="col-md-1">
          <img 
              class="img-responsive"
              height="100px"
              width="100px"
              src="../img/logo_ufvjm.png"
              alt="Logo UFVJM"
           >
  </section>
  <section class="col-md-2"></section>
</section>
<?php
	$Cursonome = new Curso();
	$Cursonome = $Cursonome->Read($curso);
?>
<section class="row">
	<section class="text-center">
    	<h3 class="lessmarginbot"> INSTITUTO DE CIÊNCIA DE TECNOLOGIA </h3>
        <h4 class="lessmarginbot lessmargintop"> BOLETIM DE FREQUÊNCIA - <?php echo $Cursonome['nome_curso']; ?> </h4>
        <h3 class="lessmarginbot lessmargintop"> <?php echo (strtoupper( strftime( "%B" , mktime(0, 0, 0, $mes+1, 0, 0) ) ) ); echo "/"; echo $ano;?> </h3>
    </section>
</section>
<br><br><br>     

<?php
	$Docente = new Docente();
	$Docente = $Docente->ReadAllReport($ano."-".$mes, $curso, $efetivo);
	//var_dump($Docente);
	$Afastamento = new Afastamento();
	$Afastamento = $Afastamento->ReadAllReport($ano."-".$mes, $curso);
	//var_dump($Afastamento);
	if(empty($Afastamento)) {}
	else
	{
	  if (count ( $Afastamento ) == count ( $Afastamento, COUNT_RECURSIVE )) 
	  {
		  $Afastamento = array ($Afastamento);
	  }
	  foreach($Afastamento as &$FixAfastamentoRow)
	  {
		  $FixAfastamentoRow['dt_inicio_afastamento'] = 
			  fixfirstdate($FixAfastamentoRow['dt_inicio_afastamento'],$mes,$ano);
		  
		  $FixAfastamentoRow['dt_fim_afastamento'] = 
			  fixlastdate($FixAfastamentoRow['dt_fim_afastamento'],$mes,$ano);
	  }
	  //var_dump($Afastamento);
	}
	foreach ($Docente as $DocenteRow)
	{
		$Quantidade = 0;
		$DiasEfetivos = 
		diasefetivos($DocenteRow['dt_inicio_exercicio'],$DocenteRow['dt_fim_exercicio'],$mes,$ano);
		$Obervs = array();
		$Obsindex = 0;
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
					//var_dump($DocenteRow);
					foreach($Afastamento as $indice => &$AfastamentoRow)
					{	
						if($AfastamentoRow['siape_docente'] == $DocenteRow['siape_docente'])
						{
							//var_dump($AfastamentoRow);
		$AfastamentoRow['dt_inicio_afastamento'] =
		fixbystart($AfastamentoRow['dt_inicio_afastamento'],$DocenteRow['dt_inicio_exercicio']);
		$AfastamentoRow['dt_fim_afastamento'] =
		fixbyend($AfastamentoRow['dt_fim_afastamento'],$DocenteRow['dt_fim_exercicio']);
				?>
                  <tr class="simpleborder">
                  	<td class="simpleborder"> <?php echo $AfastamentoRow['codigo_ocorrencia'] ?> </td>
                    <td class="simpleborder"> <?php echo $AfastamentoRow['tipo_ocorrencia']?></td>
                    <td class="simpleborder"> 
				<?php 
		echo $quantdays = 
		getquantdays($AfastamentoRow['dt_inicio_afastamento'],$AfastamentoRow['dt_fim_afastamento']);
					$Quantidade = $Quantidade + $quantdays;
					if(empty($AfastamentoRow['observ_afastamento'])){}
					else 
					{
		$Obervs[$Obsindex] = 
		array($AfastamentoRow['codigo_ocorrencia'], $AfastamentoRow['observ_afastamento']);
		$Obsindex++; 
					}
					unset($Afastamento[$indice]);
				?>
                    </td>
                    <td class="simpleborder">
				 <?php
		echo getlistday($AfastamentoRow['dt_inicio_afastamento'],$AfastamentoRow['dt_fim_afastamento']);
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
					if(!empty($Obervs))
					{
					  if (count ( $Obervs ) == count ( $Obervs, COUNT_RECURSIVE )) 
					  {
						  $Obervs = array ($Obervs);
					  }
				?>
                <p class="paragmargin">
                	<strong>Observações:</strong>
                    <br>
					<?php
					foreach($Obervs as $ObservRow)
                    {
                        echo $ObservRow['0']."\t".$ObservRow['1'];
					?>
                    <br>
                    <?php	
                    }
                    ?>
                	<br>
                </p>
              	<?php 
					}
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