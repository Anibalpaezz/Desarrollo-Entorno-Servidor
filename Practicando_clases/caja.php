<?php

/* final class caja extends AnotherClass implements Interface
{
    
} */

class caja {
    private $contenido;

    public function __set($var, $valor) {
        if (property_exists(__CLASS__, $var)) {
            $this -> $ $var = $valor;
        }
        echo "No existe el atributo";
    }

    public function get($var, $valor) {
        if (property_exists(__CLASS__, $var)) {
            return $this -> $ $var = $valor;
        }
        echo "No existe el atributo";
    }

    /* function introduce($cosa) {
        $this -> $contenido = $cosa;
    }

    function muestra_contenido() {
        echo $this -> $contenido;
    } */
}
    $micaja1 = new caja;
    $micaja1 -> introduce("algo");
    $micaja1 -> muestra_contenido();
    echo "<br>";
    $micaja2 = $micaja1;
    $micaja2 -> introduce("hola que tal");
    $micaja2 -> muestra_contenido();
    echo "<br>";

