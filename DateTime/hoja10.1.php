<?php
    echo "<h1>Hoja 10</h1>";

    echo "<br>";echo "<br>";echo "<br>";

    echo "<h3>Ejercicio 1</h3>";
    echo "Fecha actual";
    $actual = new DateTime('now');
    echo "<br>";
    echo $actual->format('Y-m-d');

    echo "<br>";

    echo " Fecha dentro de una semana";
    $semana_siguiente = new DateTime('now');
    $semana_siguiente -> add(new DateInterval('P7D'));
    echo "<br>";
    echo $semana_siguiente->format('Y-m-d');

    setlocale(LC_TIME, 'es_ES');

    $semana_siguiente = new DateTime('now');
    $semana_siguiente->add(new DateInterval('P7D'));
    echo "<br>";
    echo strftime('%A %e de %B de %Y %H:%M:%S %p', $semana_siguiente->getTimestamp());

    echo "<br>";echo "<br>";echo "<br>";

    echo "<h3>Ejercicio 2</h3>";
    echo "Fecha actual";
    echo "<br>";
    $actual = new DateTime('now');
    echo $actual -> format('l');
    echo "<br>";
    echo $actual -> format('l jS \of F Y h:i:s A');
    echo "<br>";
    echo strftime('%A %e de %B de %Y %H:%M:%S %p', $actual->getTimestamp());
    echo "<br>";
    echo $actual -> format('F, j, Y h:i:s A');
    echo "<br>";
    echo $actual -> format('m.d.Y');
    echo "<br>";
    echo $actual -> format('m,d,Y');
    echo "<br>";
    echo $actual -> format('Ymd');
    echo "<br>";
    echo "It is the ".$actual -> format(' jS')." day";
    echo "<br>";
    echo $actual -> format('D M j G:i:s T Y');
    echo "<br>";
    echo $actual -> format('H:m:s \m \e\s\ \m\e\s');
    echo "<br>";
    echo $actual -> format('H:i:s');

    echo "<br>";echo "<br>";echo "<br>";echo "<br>";

    echo "<h3>Ejercicio 3</h3>";
    var_dump(checkdate(2,29,2007));
    echo "<br>";
    var_dump(checkdate(2,29,2008));

    echo "<br>";echo "<br>";echo "<br>";echo "<br>";

    echo "<h3>Ejercicio 4</h3>";
    $hoy = new DateTime('now');
    echo "Hoy es ".$hoy -> format('l');

    echo "<br>";echo "<br>";echo "<br>";echo "<br>";

    echo "<h3>Ejercicio 5</h3>";
    $dia_semana = new DateTime('now');
    $posi_dia = (int)$dia_semana -> format('N');
    $array_dias = Array('green', 'red', 'pruple', 'blue', 'grey', 'orange', 'brown');
    echo "<p style = 'color:$array_dias[$posi_dia];'>dia de la semana </p>";

    echo "<br>";echo "<br>";echo "<br>";

    echo "<h3>Ejercicio 6</h3>";
    $saber_dia = new DateTime('1978-01-12 13:45:00');
    echo $saber_dia -> format('l');

    echo "<br>";echo "<br>";echo "<br>";

    echo "<h3>Ejercicio 7</h3>";
    $comienzo = new DateTime('2009-06-01');
    $nico = new DateTime('2009-06-16');
    $acab = new DateTime('2009-07-01');
    $dif_dura = $comienzo ->diff($acab);
    $dif_final = $nico ->diff($acab);
    echo "Oferta valida del ".$comienzo ->format('d \d\e F \d\e Y')." al ".$acab ->format('d \d\e F \d\e Y');
    echo "<br>";
    echo "Esta oferta valida durante ".$dif_dura ->format('%m')." mes, que comenzo el ".$comienzo ->format('d/m/Y').", finaliza dentro de ".$dif_final ->format('%d')." dias, el ".$acab->format('d/m/Y');

    echo "<br>";echo "<br>";echo "<br>";

    echo "<h3>Ejercicio 8</h3>";
    $mal = new DateTime('28/06/2019');
    $sql = sql($fecha);
    function sql($mal) {
        $bien = new DateTime("$mal");
        $resul = $bien ->format('Y-m-d');
        return $resul;
    }
    echo $sql;
?>
    
