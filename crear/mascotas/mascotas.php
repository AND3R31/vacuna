<?php
require_once("../../base_datos/base_datos.php");
$daba = new database();
$con = $daba ->conectar();
session_start();

$consultaa=$con->prepare("SELECT * FROM enfermeros Where rol = 1 ");
    $consultaa->execute();
    $conn=$consultaa->fetch();

    $con_enfer=$con->prepare("SELECT * FROM enfermeros Where rol = 2");
    $con_enfer->execute();
    $con_e=$con_enfer->fetch();

    $con1_enfer=$con->prepare("SELECT * FROM vacunas");
    $con1_enfer->execute();
    $con1_e=$con1_enfer->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regfistro de mascotas</title>
</head>
<body>
    <div>
        <div>
            <form method="post" name="formulario" action="re_masc.php">

                
                <h2>Crear mascota</h2>              

                <div>
                    <select name="mas" id="mas">
                    <option>Seleccione el dueño</option>
                    <?php
                    do {
                    ?>
                    <option value="<?php echo ($conn['doc_d']) ?>"> <?php echo ($conn['nombre_d']) ?> </option> 
                    <?php
                    } while ($conn = $consultaa->fetch());
                    ?>
                    </select>
                </div>

                <div>
                    <label>Nombre de la mascota</label>
                    <input type="text" id="mascota" name="mascota" placeholder="Ingrese el nombre de la mascota" >
                </div>

                <div>
                    <label>Tipo de mascota</label>
                    <input type="text" id="ti_mascota" name="ti_mascota" placeholder="Ingrese el tipo de mascota que usted tiene">
                </div>

                <div>
                    <label>Seleccione el enfermero asigando</label><br>
                    <select name="enf" id="enf">
                    <option>Seleccione el enfermero</option>
                    <?php
                    do {
                    ?>
                    <option value="<?php echo ($con_e['doc_d']) ?>"> <?php echo ($con_e['nombre_d']) ?></option> 
                    <?php
                    } while ($con_e = $con_enfer->fetch());
                    ?>
                    </select>
                </div>

                <div>
                    <label>Seleccione la vacuna</label><br>
                    <select name="vac" id="vac">
                    <option>Seleccione la vacuna</option>
                    <?php
                    do {
                    ?>
                    <option value="<?php echo ($con1_e['id']) ?>"><?php echo ($con1_e['nombre_v']) ?> </option> 
                    <?php
                    } while ($con1_e = $con1_enfer->fetch());
                    ?>
                    </select>
                </div>

                <input type="submit">
                <input type="hidden" id="aceptar" name="aceptar" value="formulario">

                
            </form>

            <a href="../../index.html">regresar</a>
            
    </div>
</body>
</html>