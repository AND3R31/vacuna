<?php
require_once("base_datos/base_datos.php");
$daba = new database();
$con = $daba ->conectar();
session_start();

$fecha=date('Y-m-d');

?>

<?php
    $vali=$con->prepare("SELECT * FROM det_vacuna INNER JOIN mascotas ON det_vacuna.id_mascota = mascotas.doc INNER JOIN enfermeros ON det_vacuna.id_enfermero=enfermeros.doc_d INNER JOIN vacunas ON det_vacuna.id_vacuna=vacunas.id");
    $vali->execute();
    $validar=$vali->fetchAll();

    $v=$con->prepare("SELECT * FROM mascotas INNER JOIN enfermeros ON mascotas.dueño = enfermeros.doc_d WHERE 
    enfermeros.rol=1");
    $v->execute();
    $va=$v->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Vacunas</title>
</head>
<body>
    <a href="index.html"> regresar</a>

<div>
<table>
        <!--El tr nos sirve sirve para crear las filas-->
        <!--El th se crea la cabecera-->
        <thead>
            <tr>
                <th>Documento del dueño</th>
                <th>Nombre del dueño</th>
                <th>Edad</th>
                <th>Nombre de la mascota</th>
                <th>Tipo de mascota</th>
                <th>Enfermero</th>
                <th>Vacuna</th>
                <th>Fecha de vacunacion</th>
                <th>Expiracion de vacuna</th>
                <th>Estado</th>
                
            </tr>
        </thead>

        <?php
        foreach ($validar as $usu) {
            foreach($va as $a){
            //se abre el ciclo con la llave
        ?>
            <!--El td sirve para sirve para crear las columnas-->
            <!--En cada td se va a mostrar los datos de una tabla usando variables por ejemplo: $variable['nombre del campo de la tabla que queremos que se vea']-->
            <tr>
                <td><?= $a['doc_d'] ?></td>
                <td><?= $a['nombre_d'] ?></td>
                <td><?= $a['edad'] ?></td>
                <td><?= $usu['nom_mascota'] ?></td>
                <td><?= $usu['tipo_masc'] ?></td>
                <td><?= $usu['nombre_d'] ?></td>
                <td><?= $usu['nombre_v'] ?></td>
                <td><?= $usu['fecha_vac'] ?></td>
                <td><?= $usu['exp_vac'] ?></td>
                <?php
                    if($fecha > $usu['exp_vac']){
                    ?>    
                        <td style="background-color:red;">hola</td>
                    <?php    
                    }else{
                        ?>
                        <td style="background-color:green;"></td>
                    <?php    
                    }
                ?>

                
                <!--con este metodo GET vamos a poder ver la informacion que estamos enviando-->
            </tr>

        <?php
        }
        } //se cierra el recorrido cerrando la llave
        ?>
    </table>
</div>
    
</body>
</html>