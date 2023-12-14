<?php
    $cadena = $_POST['cadena'];
    $radio = $_POST['radio'];
    $genero = $_POST['genero'];
    $extras = $_POST['extras'];
    foreach ($extras as $extra){
        echo "$extra<BR>\n";
    }
    echo $cadena . " ";
    echo $radio . " ";
    echo $genero;

    $clave = $_POST['clave'];
    echo $clave;

    If ( ! empty($_POST['idiomas'])){
    $idiomas = $_POST['idiomas'];
    foreach ($idiomas as $idioma)
    echo "$idioma<BR>\n";
    }

    $comentario = $_POST['comentario'];
    echo $comentario;

    echo "<br>";
    //array de files  SUBIDA DE UN FICHERO $_files[]['ficheronoticia'];


    $ficheroaux = $_FILES['ficheronoticia']['name'];
    echo $_FILES['ficheronoticia']['name'];
    echo "<br>";
    echo $_FILES['ficheronoticia']['type'];
    echo "<br>";
    echo $_FILES['ficheronoticia']['size'];
    echo "<br>";
    echo $_FILES['ficheronoticia']['tmp_name'];
    echo "<br>";
    echo $_FILES['ficheronoticia']['error'];
    

    if (is_uploaded_file ($_FILES['ficheronoticia']['tmp_name'] )){
    $nombreDirectorio = "$_SERVER[DOCUMENT_ROOT]";
    $nombreFichero = $_FILES['ficheronoticia']['name'];
    $nombreCompleto = $nombreDirectorio.$nombreFichero;
    if (is_dir($nombreDirectorio)){
    $idUnico = time();
    $nombreFichero = $idUnico."-".$nombreFichero;
    $nombreCompleto = $nombreDirectorio.$nombreFichero;
    move_uploaded_file ($_FILES['ficheronoticia']['tmp_name'],$nombreCompleto);
    echo "Fichero subido con el nombre: $nombreFichero<br>";
    }
    else echo 'Directorio definitivo inválido';
    }
    else
    print ("No se ha podido subir el fichero\n");

    echo "imagen";
    echo ""





?>