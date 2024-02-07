<?php
echo "<h3>count() cuenta las posiciones que hay en el array</h3>";
echo "<br>";
$array = array(1, 2, 3, 4, 5);
echo count($array);
echo "<br>";
echo "<br>";

echo "<h3>array_push() Introduce nuevos valores en el array</h3>";
echo "<br>";
$array = array(1, 2, 3);
array_push($array, 4);
print_r($array);
echo "<br>";
echo "<br>";


echo "<h3>array_key_exists() Comprueba la existencia de un valor dentro del array asociativo</h3>";
echo "<br>";
$array = array('a' => 1, 'b' => 2, 'c' => 3);
if (array_key_exists('b', $array)) {
    echo "La clave 'b' existe en el array";
}
echo "<br>";
echo "<br>";

echo "<h3>array_merge() Junta dos arrays en uno</h3>";
echo "<br>";
$array1 = array('a', 'b', 'c');
$array2 = array(1, 2, 3);
$resultado = array_merge($array1, $array2);
print_r($resultado);
echo "<br>";
echo "<br>";

echo "<h3>sort() Ordena un array</h3>";
echo "<br>";
$array = array(3, 1, 2);
sort($array);
print_r($array);
echo "<br>";
echo "<br>";

echo "<h3>asort() Ordena un array asociativo</h3>";
echo "<br>";
$array = array('c' => 3, 'a' => 1, 'b' => 2);
asort($array);
print_r($array);
echo "<br>";
echo "<br>";

echo "<h3>asort() Comprueba la existencia de un valor dentro del array</h3>";
echo "<br>";
$array = array('a', 'b', 'c');
if (in_array('b', $array)) {
    echo "'b' se encuentra en el array";
}
echo "<br>";
echo "<br>";

echo "<h3>array_filter() Establece un filtro para mostrar el array en este caso solo los pares</h3>";
echo "<br>";
$array = array(1, 2, 3, 4, 5);
$filtrado = array_filter($array, function($valor) {
    return $valor % 2 == 0;
});
print_r($filtrado);
echo "<br>";
echo "<br>";