<?php

require_once('dsw/Connection.php');
use dsw\Connection;

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //"mysql:host=localhost;dbname=$dbname";
        $conn  = new Connection("db", "commercedb", "dsw", "dsw");
        $conn->open();
        if ($conn->errorExists()) {
            printf("Exception cached: %s", $conn->getErrorMessage())    ;
        } else {
            print("Fuck PHP!");
        }
        
        //Finalizada las operaciones de modificación.
        //Se supone que el recolector de basura de PHP (garbage collector) al finalizar un script
        //se encarga de cerrar y destruir el objeto PDO. También detecta si en una conexión persistente, existe ya
        //un objeto PDO a la misma base de datos no creando una nueva instancia. Sin embargo, si asignamos a null la variable
        //que implementa las conexiones, estariamos forzando al garbage collector a liberar la memoria y entre otras cosas
        //cerrar la conexión del PDO.
        $conn = null;
        ?>
    </body>
</html>
