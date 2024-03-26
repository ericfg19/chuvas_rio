<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- <link rel="stylesheet" href="styles.css"> -->
		<!-- comando para atualizar a página cada 2 minutos -->
		<meta http-equiv="refresh" content="120">
		<title>.:: PHP Chuva Monitor ::.</title>
	</head>
<body>
<?php

//$xml = simplexml_load_file('Chuvas.xml');

$xml = simplexml_load_file('http://alertario.rio.rj.gov.br/upload/xml/Chuvas.xml');

foreach ($xml->estacao as $estacao) {

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
    echo "<br>";
}
?>

</body>
</html>