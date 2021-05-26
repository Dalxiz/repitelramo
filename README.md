# Proyecto de sistema para Repi Telramo Electronics
Para que el proyeto funcione correctamente, se debe clonar el repositorio manteniendo el nombre de "repitelramo" como carpeta principal del proyecto dentro de 'htdocs' o 'www' de XAMPP o WAMP respectivamente.\
\
Además, se debe crear o pegar un archivo llamado parametrosBD.php en el directorio de "persitencia" con los datos de conexión a la BBDD correspondiente.\
\
Un ejemplo de estructura de parametrosBD.php es el siguente:
```php
<?php
    $host = 'localhost';
    $nombreBaseDatos = 'factura';
    $usuario = 'root';
    $password = '123';
?>
```
