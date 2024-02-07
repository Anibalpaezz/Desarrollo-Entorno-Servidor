<?php
echo "<h3>strlen Para contar la longitud de la cadena</h3>";
echo $cadena = "Hola Mundo";
echo "<br>";
echo strlen($cadena) . "<br><br>";

echo "<h3>str_replace Para cambiar una palabra por otra en la cadena</h3>";
echo $cadena = "Hola Mundo";
echo "<br>";
echo str_replace("Mundo", "amigo", $cadena) . "<br><br>";

echo "<h3>strpos Te dice en que posicion se encuentra el principio de lo que le pidas en la cadena</h3>";
echo $cadena = "Hola Mundo";
echo "<br>";
echo strpos($cadena, "Mundo") . "<br><br>";

echo "<h3>strcmp Te dice si las dos cadenas que le has pasado son iguales o no</h3>";
echo "Si sale 0 son iguales";
echo "<br>";
echo $cadena1 = "Hola";
echo "<br>";
echo $cadena2 = "Hola";
echo "<br>";
echo strcmp($cadena1, $cadena2);
echo "<br>";
echo $cadena3 = "Hola";
echo "<br>";
echo $cadena4 = "Adios";
echo "<br>";
echo strcmp($cadena3, $cadena4) . "<br><br>";

echo "<h3>sprintf No entiendo lo que hace</h3>";
$numero = 10;
echo sprintf("El número es %d", $numero) . "<br><br>";

echo "<h3>strtolower o strtoupper Para cambiar entre mayusculas y minusculas</h3>";
echo $cadena = "HOLA MUNDO";
echo "->";
echo strtolower($cadena);
echo "<br>";
echo $cadena = "adios mundo";
echo "->";
echo strtoupper($cadena) . "<br><br>";





