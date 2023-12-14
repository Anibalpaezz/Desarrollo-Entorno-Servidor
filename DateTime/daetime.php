<?php
    echo "Sumar 10 dias";
    echo "<br>";
    $dias10 = new DateTime('now');
    echo $dias10->format('d-m-Y');
    echo "<br>";
    $dias10 -> add(new DateInterval('P10D'));
    echo "\n".$dias10->format('d-m-Y');
    echo "<br>";
    echo "<br>";

    echo "Sumar 10 meses";
    echo "<br>";
    $dias10 = new DateTime('now');
    echo $dias10->format('d-m-Y');
    echo "<br>";
    $dias10 -> add(new DateInterval('P10M'));
    echo "\n".$dias10->format('d-m-Y');
    echo "<br>";
    echo "<br>";

    echo "Sumar 10 años";
    echo "<br>";
    $dias10 = new DateTime('now');
    echo $dias10->format('d-m-Y');
    echo "<br>";
    $dias10 -> add(new DateInterval('P10Y'));
    echo "\n".$dias10->format('d-m-Y');
    echo "<br>";
    echo "<br>";

    echo "Sumar 10 dias, 10 meses y 10 años";
    echo "<br>";
    $dias10 = new DateTime('now');
    echo $dias10->format('d-m-Y');
    echo "<br>";
    $dias10 -> add(new DateInterval('P10Y10M10D'));
    echo "\n".$dias10->format('d-m-Y');
    echo "<br>";
    echo "<br>";

    echo "Diferencia entre dos fechas";
    echo "<br>";
    $fecha1 = new DateTime('now');
    $fecha2 = new DateTime('2039-08-18');
    $intervalo = $fecha1->diff($fecha2);
    echo "\n".$intervalo->format('%R%a dias');
    echo "<br>";
    echo "<br>";

    echo "Diferencia entre dos fechas";
    echo "<br>";
    $fecha1 = new DateTime('now');
    $fecha2 = new DateTime('1896-08-18');
    $intervalo = $fecha1->diff($fecha2);
    echo "\n".$intervalo->format('%R%a dias');
    echo "<br>";
    echo "<br>";

    $hora -> sub(new DateInterval(''));
    $hora -> modify(new DateInterval(''));

    echo "<br>";
    echo "<br>";
?>