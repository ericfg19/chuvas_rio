<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="styles.css">
		<!-- comando para atualizar a página cada 2 minutos -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<meta http-equiv="refresh" content="120">
		<title>.:: Chuva Monitor - Rio de Janeiro ::.</title>
	</head>
<body>
<?php
error_reporting(0);

//$xml = simplexml_load_file('Chuvas.xml');

$xml = simplexml_load_file('http://alertario.rio.rj.gov.br/upload/xml/Chuvas.xml');
if ($xml === false) { 
    echo "Erro ao processar as informações: Link fora do ar!";
    echo '<script class="alerta">
    Swal.fire("LINK FORA DO AR!")
    window.setTimeout("history.go(-1)", 7000);
    </script>';
}

foreach ($xml->estacao as $estacao) {
    echo "<div id='info'>";
    echo "Bairro: " . $estacao['nome'] . "<br>";
    $localizacao = $estacao->localizacao;
    $bacia = $localizacao['bacia'];
    echo "Localização / Bacia: $bacia<br>";
    $chuvas = $estacao->chuvas;
    $mes = $chuvas['mes'];
    $dia = $chuvas['h24'];
    $h12 = $dia / 2 ;
    //$hora = $chuvas['hora'];
    $datahora = strtotime($chuvas['hora']);
    $data = date("d/m/Y", $datahora);
    $hora = date("H:i", $datahora);
    echo "ML / 12hrs: $h12 <br>";
    echo "ML / dia: $dia <br>";
    echo "ML / mês: $mes <br>";
    echo "Data/Hora: $data - $hora<br>";
    echo '</div><br>';
}

?>
</body>
<!-- Clima widget start -->
<div id="footer"><footer><div id="ww_a83b24b8c51b5" v='1.3' loc='id' a='{"t":"ticker","lang":"pt","sl_lpl":1,"ids":[],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"image","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722"}'><a href="https://weatherwidget.org/ru/" id="ww_a83b24b8c51b5_u" target="_blank">Погодный информер погоды для сайта</a></div><script async src="https://app1.weatherwidget.org/js/?id=ww_a83b24b8c51b5"></script></footer></div>
<!-- Clima widget end -->
</html>